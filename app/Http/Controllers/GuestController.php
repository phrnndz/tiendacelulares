<?php

namespace App\Http\Controllers;
use App\Product;
// use App\Event;
// use App\Currency;
// use App\PaymentPlatform;
use App\Payment;
use App\Order;
use App\Category;
// use App\LandingSubmodule;
use App\Notification;

// use App\Subscriber;
// use App\Landing;
use MercadoPago;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;



class GuestController extends Controller
{
    public function __construct()
    {
        // MercadoPago\SDK::setClientId(config('services.mercadopago.client_id'));
        // MercadoPago\SDK::setClientSecret(config('services.mercadopago.client_secret')); // On Sandbox
        // MercadoPago\SDK::setAccessToken('APP_USR-6588866596068053-041607-428a530760073a99a1f2d19b0812a5b6-491494389'); //este es el del examen
        MercadoPago\SDK::setAccessToken('TEST-2816301191036834-011423-ed87b9b8332afc2400e2b4c42e17dc2a-34105505'); //este es mio
    }

    public function index()
    {
        $products = Product::where('status', 1)
                    ->take(8)
                    ->get();
        return view('guest.index', compact('products'));
    }

    public function categoria($categoria)
    {
        $data = DB::select('
			SELECT 
                id
            FROM categories
            WHERE nombre="'.$categoria.'"');
        $categoryId = $data[0]->id;
        
        $items = Product::where([
            ['status', '=', '1'],
            ['category_id','=', $categoryId]
                                ])->get();
        // dd()
        return view('guest.products', compact('items','categoria'));
    }




    public function singleproducto($slug)
    {
        // busca prodcuto con ese slug
        $product = Product::where('slug', $slug)->first();
        //checar que el objeto de eloquent no este vacio y si esta vacio redireccionar
        if(count((array)$product)){
            //checar que producto no este en otro estatus diferente a activo
            if($product->status == 1){
                $products = Product::where('status', 1)
                        ->inRandomOrder()
                        ->limit(2) // here is yours limit
                        ->get();         
                return view('guest.producto', compact('product','products'));
            }else{
                // el producto esta en otro estaus
                return redirect('/');
            }
        }else{
            // eeloquent esta vacio
            return redirect('/');
        }
        
    }




    public function cart()
    {
        $products = Product::where('status', 1)
                    ->inRandomOrder()
                    ->limit(2) // here is yours limit
                    ->get();
        return view('guest.cart',compact('products'));
    }

    public function checkout(Request $request)
    {
        // 5031755734530604  CVV: 123  Vencimiento: 11/25
        Validator::make($request->all(), [
            'nombre'          => 'required|max:255',
            'email'           => 'required|email',
            'telefono'           => 'required',
            'calle'           => 'required',
            'numerointerior'           => 'required',
            'cp'           => 'required',
        ])->validate();

        // Crea un objeto de preferencia
        $name               =strtoupper($request->nombre);
        $email              =$request->email;
        $telefono           =$request->telefono;
        $calle              =$request->calle;
        $numerointerior     =$request->numerointerior;
        $cp                 =$request->cp;




        $cestaTotal = array();
        $codigoventa =self::codigoventa();
        // dd($codigoventa);
        $total = 0;
        $cart = session()->get('cart');
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }




        $preference = new MercadoPago\Preference();

        // de los items
        foreach($cart as $article){
            $item = new MercadoPago\Item();
            $item->id = 1234;
            $item->title = $article['name'];
            $item->picture_url =  "http://tiendacelulares.herokuapp.com/img/1588210603.jpg";
            $item->quantity = $article['quantity'];
            $item->description = "Dispositivo móvil de Tienda e-commerce";
            $item->unit_price = $article['price'];
            $cestaTotal = array_merge($cestaTotal,array($item));
        }
        $preference->items = $cestaTotal;

        //del comprador
        $payer = new MercadoPago\Payer();
        $payer->name = $name;
        $payer->email = $email;
        $payer->phone = array(
            "area_code" => "",
            "number" => $telefono
        );
        $payer->address = array(
            "street_name" => $calle,
            "street_number" => $numerointerior,
            "zip_code" => $cp,
        );
        $preference->payer = $payer;


        $preference->back_urls = array(
            "success" => "http://tiendacelulares.herokuapp.com/checkout/success",
            "failure" => "http://tiendacelulares.herokuapp.com/checkout/failure",
            "pending" => "http://tiendacelulares.herokuapp.com/checkout/pending"
        );

        $preference->notification_url="http://tiendacelulares.herokuapp.com/checkout/notifications";
        $preference->auto_return = "all";
        $preference->external_reference=  $codigoventa;
        $preference->payment_methods = array(
            "excluded_payment_methods" => array(
                array(

                    "id" => "atm",
                )
            ),
            "excluded_payment_types" => array(
                array(
                    "id" => "amex",

                )
            ),
            "installments"=> 6

        );
        
        $preference->save();
        // dd($preference);
       // se guarda el pago en espera que cambie el estatus
        $payment = new Payment;
        $payment->codigo =  $codigoventa;
        $payment->amount = $total;
        $payment->name = $name;
        $payment->email = $email;
        $payment->estatus = 'checkout';
        $payment->save();
        foreach($cart as $article){
            $order = new Order;
            $order->payment_codigo  = $codigoventa;
            $order->product_id      = $article['id'];
            // $order->product_id      = 1234;
            $order->quantity        = $article['quantity'];
            $order->price           = $article['price'];
            $order->save();
        }
        return view('guest.checkout')->with('preference',$preference)
                                     ->with('name',$name)
                                     ->with('email',$email)
                                     ->with('telefono',$telefono)
                                     ->with('calle',$calle)
                                     ->with('numerointerior',$numerointerior)
                                     ->with('cp',$cp)
                                     ->with('totalenviado',$total);
    }




    public function success(Request $request){
        $paymentUpdate = Payment::find($request->external_reference);
        $paymentUpdate->estatus               = $request->collection_status;
        $paymentUpdate->collection_id         = $request->collection_id;
        $paymentUpdate->collection_status     = $request->collection_status;
        $paymentUpdate->payment_type          = $request->payment_type;
        $paymentUpdate->merchant_order_id     = $request->merchant_order_id;
        $paymentUpdate->preference_id         = $request->preference_id;
        $paymentUpdate->save();
        $items= DB::select('
            SELECT 
                orders.payment_codigo,
                orders.quantity,
                orders.price,
                products.name
            FROM 
            orders
            INNER JOIN products  ON orders.product_id = products.id
            WHERE orders.payment_codigo="'.$paymentUpdate->codigo.'"');
        DB::disconnect('produccion');

        $data = array(
            'reference'             => $paymentUpdate->codigo,
            'name'                  => $paymentUpdate->name, 
            'dateForHumans'         => $this->obtenerFechaEnLetra($paymentUpdate->updated_at), 
            'email'                 => $paymentUpdate->email, 
            'amount'                => $paymentUpdate->amount,
            'merchant_order_id'     => $paymentUpdate->merchant_order_id,
            'items'                 => $items
        );

        session()->forget('cart');
        return view('guest._checkout.success')
                ->with('codigo', $paymentUpdate->codigo)
                ->with('payment_type', $paymentUpdate->payment_type)
                ->with('preference_id', $paymentUpdate->preference_id)
                ->with('merchant_order_id', $paymentUpdate->merchant_order_id)
                ->with('amount', $paymentUpdate->amount)
                ->with('name',   $paymentUpdate->name);

    }


    public function failure(Request $request){
        $paymentUpdate = Payment::find($request->external_reference);
        if($request->collection_status != null){
            $paymentUpdate->estatus               = $request->collection_status;
        }else{
            $paymentUpdate->estatus               = "canceled";
        }
        $paymentUpdate->save();
        return view('guest._checkout.failure');

    }
    public function pending(Request $request){
        $paymentUpdate = Payment::find($request->external_reference);
        $paymentUpdate->estatus               = $request->collection_status;
        $paymentUpdate->collection_id         = $request->collection_id;
        $paymentUpdate->collection_status     = $request->collection_status;
        $paymentUpdate->payment_type          = $request->payment_type;
        $paymentUpdate->merchant_order_id     = $request->merchant_order_id;
        $paymentUpdate->preference_id         = $request->preference_id;
        $paymentUpdate->save();
        $items= DB::select('
            SELECT 
                orders.payment_codigo,
                orders.quantity,
                orders.price,
                products.name
            FROM 
            orders
            INNER JOIN products  ON orders.product_id = products.id
            WHERE orders.payment_codigo="'.$paymentUpdate->codigo.'"');
        DB::disconnect('produccion');
        $data = array(
            'reference'             => $paymentUpdate->codigo,
            'name'                  => $paymentUpdate->name, 
            'dateForHumans'         => $this->obtenerFechaEnLetra($paymentUpdate->updated_at), 
            'email'                 => $paymentUpdate->email, 
            'amount'                => $paymentUpdate->amount,
            'merchant_order_id'     => $paymentUpdate->merchant_order_id,
            'items'                 => $items
        );

        $to_email = $paymentUpdate->email;
        Mail::send('guest.email.pending', $data, function($message) use ($to_email) {
            $message->to($to_email);
            $message->subject('Pendiente de pago en Formación Politica');
            $message->from('formacionycomunicacionpolitica@gmail.com', 'Formación Política');
        });

        session()->forget('cart');
        return view('guest._checkout.pending')
                ->with('codigo', $paymentUpdate->codigo)
                ->with('amount', $paymentUpdate->amount)
                ->with('name',   $paymentUpdate->name);

    }


    // esta funcion/ruta es la registrada en mercadopago para que se comuniquen los servidores
    // tan solo guarda lo que mercadopago envia e intenta ejecutar el resto del codigo, si no solo contesta un 200
    public function notifications(Request $request){
        if ( ! isset($request->id, $request->topic) || ! ctype_digit($request->id)) {
            return \Response::json(['Not Found!'], 404);
        }
        $notificacion = new Notification;
        $notificacion->mercadopago_topic    = $request->topic;
        $notificacion->mercadopago_id       = $request->id;
        $notificacion->save();
        try {
            $this->getInfoNotifications($request->id, $request->topic);
            // dd($data);

        } catch (\Exception $e) {
            print_r('Error al ejecutar getInfoNotifications():   '. $e->getMessage());
            // Log::debug('Error al ejecutar getInfoNotifications():   '. $e->getMessage());
        }
        return \Response::json(['HTTP/1.1 200 OK'], 200);
    }



    public function getInfoNotifications($id, $topic){
        
        $merchant_order = null;
        switch($topic) {
            case "payment":
                $payment = MercadoPago\Payment::find_by_id($id);
                // Get the payment and the corresponding merchant_order reported by the IPN.
                $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
                break;
            case "merchant_order":
                $merchant_order = MercadoPago\MerchantOrder::find_by_id($id);
                break;
        }
        $paid_amount = 0;
        foreach ($merchant_order->payments as $payment) {
            if ($payment['status'] == 'approved'){
                $paid_amount += $payment['transaction_amount'];
            }
        }

        // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
        if($paid_amount >= $merchant_order->total_amount){
            if (count($merchant_order->shipments)>0) { // The merchant_order has shipments
                if($merchant_order->shipments[0]->status == "ready_to_ship") {
                    // Log::debug('Totally paid. Print the label and release your item.');
                    $paymentUpdate = Payment::find($merchant_order->external_reference);
                    $paymentUpdate->estatus               = $merchant_order->order_status;
                    $paymentUpdate->save();
                    return;
                    // return ("Totally paid. Print the label and release your item.");

                }
            } else { // The merchant_order don't has any shipments
                // Log::debug('Totally paid. Release your item');
                $paymentUpdate = Payment::find($merchant_order->external_reference);
                $paymentUpdate->estatus               = $merchant_order->order_status;
                $paymentUpdate->save();
                return;

                // return ("Totally paid. Release your item.");
            }
        } else {
            // Log::debug('Not paid yet. Do not release your item.');
            $paymentUpdate = Payment::find($merchant_order->external_reference);
            $paymentUpdate->estatus               = $merchant_order->order_status;
            $paymentUpdate->save();
            return;
            // return ("Not paid yet. Do not release your item.");
        }
      
    }






    // Con este metodo se obtiene un codigo de venta, codicionado a repetirse si el codigo ya existe.
    public function codigoventa(){
        // $id= 'ABCD1234';
        $id = strtoupper(str_random(6));
        $validator = Validator::make(['codigo'=>$id],['codigo'=>'unique:payments,codigo']);
        if($validator->fails()){
             return $this->codigoventa();
        }
        return $id;
   }


   public function generatepdf ($reference){
    //    return 'hola';
        $payment = Payment::find($reference);
        $items= DB::select('
            SELECT 
                orders.payment_codigo,
                orders.quantity,
                orders.price,
                products.name
            FROM 
            orders
            INNER JOIN products  ON orders.product_id = products.id
            WHERE orders.payment_codigo="'.$reference.'"');
        DB::disconnect('produccion');

        $data = array(
            'reference'             => $reference,
            'name'                  => $payment->name, 
            'dateForHumans'         => $this->obtenerFechaEnLetra($payment->updated_at), 
            'email'                 => $payment->email, 
            'amount'                => $payment->amount,
            'merchant_order_id'     => $payment->merchant_order_id,
            'items'                 => $items
        );






        // dd($data);
        $pdf = PDF::loadView('guest.pdf.success', $data);
        return $pdf->stream();
    }

    private function  obtenerFechaEnLetra($fecha){
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $num.' de '.$mes.' del '.$anno;
    }



    // 
    // 
    // 
    //  LANDING PAGES
    public function showlandingpage($slug){
        // busca prodcuto con ese slug
        $landing = Landing::where('slug', $slug)->first();
        //checar que el objeto de eloquent no este vacio y si esta vacio redireccionar
        if(count((array)$landing)){
            //checar que producto no este en otro estatus diferente a activo
            if($landing->status == 1){  
                // dd($landing->teacher);
                // dd($landing->video);
                return view('guest.landingpage', compact('landing'));
            }else{
                // el producto esta en otro estaus
                return redirect('/');
            }
        }else{
            // eeloquent esta vacio
            return redirect('/');
        }
        
    }


    public function obtenersubtemas(){
        $submodule = LandingSubmodule::find(1);
        $subtemas = $submodule->subtheme;
        return $subtemas;
    }



    // public function redirect_mp(Request $request){
        //ACASO M DEVUELVE COSAS DIFERENTES CUANDO ES MODAL Y EXTERNO ??????
        // dd($request);
    //     [
    //    'estatus'               => $request->collection_status,
    //    'collection_id'         => $request->collection_id,
    //    'collection_status'     => $request->collection_status,
    //    'payment_type'          => $request->payment_type,
    //    'merchant_order_id'     => $request->merchant_order_id,
    //    'preference_id'         => $request->preference_id
    //    ]
    // dd($request);
    //     switch($request->payment_status){
    //         case 'pending':
    //             return redirect()->action("GuestController@pending", [
    //                 'estatus'               => $request->collection_status,
    //                 'collection_id'         => $request->collection_id,
    //                 'collection_status'     => $request->collection_status,
    //                 'payment_type'          => $request->payment_type,
    //                 'merchant_order_id'     => $request->merchant_order_id,
    //                 'preference_id'         => $request->preference_id,
    //                 'external_reference'    => $request->external_reference
    //                 ]);
    //             break;
    //         case 'approved':
    //             return redirect()->action("GuestController@success", [
    //                 'estatus'               => $request->collection_status,
    //                 'collection_id'         => $request->collection_id,
    //                 'collection_status'     => $request->collection_status,
    //                 'payment_type'          => $request->payment_type,
    //                 'merchant_order_id'     => $request->merchant_order_id,
    //                 'preference_id'         => $request->preference_id,
    //                 'external_reference'    => $request->external_reference

    //                 ]);
    //             break;
    //         case 'failure':
    //             return redirect()->action("GuestController@failure", [
    //                 'estatus'               => $request->collection_status,
    //                 'collection_id'         => $request->collection_id,
    //                 'collection_status'     => $request->collection_status,
    //                 'payment_type'          => $request->payment_type,
    //                 'merchant_order_id'     => $request->merchant_order_id,
    //                 'preference_id'         => $request->preference_id,
    //                 'external_reference'    => $request->external_reference

    //                 ]);
    //             break;


    //     }
    // }

}
