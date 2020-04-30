<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Support\Facades\Validator;
use Alert;
use DataTables;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        

        // Alert::message('Robots are working!');
        // return'hola';        
        // dd($payments);
        if ($request->ajax()) {
            // $data = DB::table('payments')
            // ->leftJoin('notifications', 'payments.merchant_order_id', '=', 'notifications.mercadopago_id')
            // ->select([  'payments.codigo',
            //             'payments.name',
            //             'payments.email',
            //             'payments.quantity',
            //             'payments.amount',
            //             'payments.collection_id',
            //             'payments.collection_status',
            //             'payments.payment_type',
            //             'payments.merchant_order_id',
            //             'payments.preference_id',
            //             'payments.estatus',
            //             'payments.created_at',
            //             'payments.updated_at',
            //             'notifications.mercadopago_id',
            //             'notifications.mercadopago_topic'
            //         ]);

            $data = Payment::select('payments.codigo',
                                    'payments.name',
                                    'payments.email',
                                    'payments.quantity',
                                    'payments.amount',
                                    'payments.collection_id',
                                    'payments.collection_status',
                                    'payments.payment_type',
                                    'payments.merchant_order_id',
                                    'payments.preference_id',
                                    'payments.estatus',
                                    'payments.created_at',
                                    'payments.updated_at',
                                    'notifications.mercadopago_id',
                                    'notifications.mercadopago_topic')
                    ->leftjoin('notifications', 'payments.merchant_order_id', '=', 'notifications.mercadopago_id')
                    ->get();
    
            // return $data;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
     
                            return $btn;
                    })
                    ->editColumn('updated_at', function ($data) {
                        return $data->updated_at->diffForHumans();
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('dashboard.payment.index');
        
    }


   

 





    
}
