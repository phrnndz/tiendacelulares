<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Subscriber;
use App\Product;
use App\Module;
use App\Submodule;
use App\Subtheme;
use App\Category;
use App\Modality;
use Response;
use Auth;
use Alert;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Alert::message('Robots are working!');
        // return'hola';
        $products = Product::where('status','<>', 4)->orderBy('status', 'asc')->paginate(15);
        

        return view('dashboard.inventario.index', compact('products'));
        
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.inventario.create')->with('categories', $categories);
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            // 'goal'          => 'required',
            'price'         => 'required|numeric',
            'status'        => 'required',
            'categoria'     => 'required',
            // 'made_for'      => 'required',
            // 'place'         => 'required',
            'date'          => 'required',
            'photo'         => 'image|nullable|max:1999',
        ]);

        // dd($request->modules);


        if ($validator->fails()) {
            return redirect('inventario/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $slug = Str::slug(strtolower($request->name), '-');
        if(Product::where('slug', $slug)->exists()){
            $slug = $slug.'-'.uniqid();
        }
        
        

        if($request->hasFile('photo')){
            // $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('photo')->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // $path = $request->file('photo')->storeAs('storage', $fileNameToStore);

            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('img'), $imageName);


        }
        else{
            $imageName = null;
        }

        // return $request;

        $product = new Product;
        $product->name = ucwords(strtolower($request->name));
        $product->slug = $slug;
        $product->goal = $request->goal;
        $product->place = $request->place;
        $product->date = $request->date;
        $product->made_for = $request->made_for;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->category_id = $request->categoria;
        $product->photo = $imageName;
        $product->save();

        alert()->success('Agregado Correctamente.', 'Correcto');
        return redirect()->route('inventario.index');
        

    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('dashboard.inventario.edit',compact('product','categories'));
    }

   
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            // 'goal'          => 'required',
            'price'         => 'required|numeric',
            'status'        => 'required',
            'categoria'     => 'required',
            // 'made_for'      => 'required',
            // 'place'         => 'required',
            'date'          => 'required',
            'photo'         => 'image|nullable|max:1999'
        ]);
        

        if ($validator->fails()) {
            return redirect('inventario/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = Product::find($id);
       

        if($request->hasFile('photo')){
            // $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('photo')->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // $path = $request->file('photo')->storeAs('storage', $fileNameToStore);
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('img'), $imageName);
        }
        else{
            // si no hay file, entonces tomar el mismo valor que ya tiene
            if(strlen($product->photo)>2){
                $imageName = $product->photo;
            }else{
                $imageName = null;
            }
        }


        $slug = Str::slug(strtolower($request->name), '-');
        $product->name = $request->name;
        // $product->slug = $slug;
        $product->goal = $request->goal;
        $product->place = $request->place;
        $product->date = $request->date;
        $product->made_for = $request->made_for;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->category_id = $request->categoria;
        $product->photo = $imageName;
        $product->save();

        alert()->success('Actualizado Correctamente.', 'Correcto');
        return redirect()->route('inventario.index');

    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status =4;
        $product->save();
  
        alert()->success('Se Borró el Registro Correctamente.', 'Correcto');
        return redirect()->route('inventario.index');
    }


    // // MÓDULOS
    // public function module($id)
    // {
    //     $product = Product::find($id);
    //     return view('dashboard.inventario.module',compact('product'));
    // }
    // public function addmodule(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_product'     => 'required',
    //         'name'          => 'required',
    //     ]);
    //     $product = Product::findOrFail($request->id_product);
    //     $module = new Module([
    //             'name'=> $request->name,
    //             'duration'=>$request->duration
    //     ]);
    //     $product->module()->save($module);
    //     return redirect('inventario/'.$product->id.'/module');

    // }
    // public function deletemodule(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'id_module'     => 'required',
    //     ]);
    //     Module::destroy($request->id_module);
    //     return redirect()->route('inventario.index');
    // }
    // public function updatemodule(Request  $request){
    //     //post new submodule and themes
    //     try{
    //         $validator = Validator::make($request->all(), [
    //             'id_module'     => 'required',
    //             'name'          => 'required',
    //             'arrayThemes'   => 'required',
    //         ]);

    //         $submodule = new Submodule;
    //         $submodule->name = $request->name;
    //         $submodule->module_id = $request->id_module;
    //         $submodule->save();

    //         if (isset($request->arrayThemes)) {   
    //             foreach($request->arrayThemes as $name){
    //                 $subtheme = new Subtheme(['name'=> $name]);
    //                 $submodule->subtheme()->save($subtheme);
    //             }
    //         }

    //     } catch (Exception $e) {
    //         return Response::json ( array (             
    //             'errors' => $e
    //         ),403);  
    //     }

    //     return Response::json(200);

    // }
    // public function updatetitlemodule(Request  $request){
    //     //post new title for the module

    //     $validator = Validator::make($request->all(), [
    //         'id_module'     => 'required',
    //         'name'          => 'required',
    //     ]);

    //     $module = Module::find($request->id_module);
    //     $module->name = $request->name;
    //     $module->save();

    //     return redirect('inventario/'.$module->product_id.'/module');



    // }

    
    // // SUBMODULOS
    // public function updatesubmodule(Request  $request){
    //     //post new submodule and themes
    //     // return 'hola';
    //     try{
    //         $validator = Validator::make($request->all(), [
    //             'id_submodule'     => 'required',
    //             'arraySubthemes'   => 'required',
    //         ]);

    //         // $submodule = new Submodule;
    //         $submodule = Submodule::findOrFail($request->id_submodule);
    //         if (isset($request->arraySubthemes)) {   
    //             foreach($request->arraySubthemes as $name){
    //                 $subtheme = new Subtheme(['name'=> $name]);
    //                 // dd($subtheme);

    //                 $submodule->subtheme()->save($subtheme);
    //             }
    //         }

    //     } catch (Exception $e) {
    //         return Response::json ( array (             
    //             'errors' => $e
    //         ),403);  
    //     }

    //     return Response::json(200);

    // }
    // public function deletesubmodule(Request $request){
    //     try{
    //         $validator = Validator::make($request->all(), [
    //             'id_submodule'     => 'required',
    //         ]);

    //         // $submodule = new Submodule;
    //         Submodule::destroy($request->id_submodule);
            
    //     } catch (Exception $e) {
    //         return Response::json ( array (             
    //             'errors' => $e
    //         ),403);  
    //     }

    //     return Response::json(200);
    // }
    // public function updatetitlesubmodule(Request  $request){
    //     //post new title for the submodule
    //     $validator = Validator::make($request->all(), [
    //         'id_submodule'     => 'required',
    //         'name'          => 'required',
    //     ]);
    //     // actualiza nombre
    //     $submodule = Submodule::find($request->id_submodule);
    //     $submodule->name = $request->name;
    //     $submodule->save();
    //     //Obtener de nuevo el idproducto para retornar a la url correcta
    //     // por alguna razon eloquent me regresa otro id cuando uso modelos ¿?
    //     $module = Module::find($submodule->module_id);
    //     return redirect('inventario/'.$module->product_id.'/module');



    // }
    // public function obtenersubmodulos($idmodule){
    //     $module = Module::find($idmodule);
    //     $submodulos = $module->submodule;
    //     return $submodulos;
    // }

    // // SUBTEMAS
    // public function deletesubtheme(Request $request){
    //     try{
    //         $validator = Validator::make($request->all(), [
    //             'id_subtheme'     => 'required',
    //         ]);

    //         // $submodule = new Submodule;
    //         Subtheme::destroy($request->id_subtheme);
            
    //     } catch (Exception $e) {
    //         return Response::json ( array (             
    //             'errors' => $e
    //         ),403);  
    //     }

    //     return Response::json(200);
    // }
    // public function obtenersubtemas($idsubmodule){
    //     $submodule = Submodule::find($idsubmodule);
    //     $subtemas = $submodule->subtheme;
    //     return $subtemas;
    // }
    // public function updatetitlesubtheme(Request  $request){
    //     // dd($request);
    //     $validator = Validator::make($request->all(), [
    //         'id_subtheme'     => 'required',
    //         'name'          => 'required',
    //     ]);
    //     // actualiza nombre
    //     $theme = Subtheme::find($request->id_subtheme);
    //     $theme->name = $request->name;
    //     $theme->save();
    //     //Obtener de nuevo el idproducto para retornar a la url correcta
    //     // por alguna razon eloquent me regresa otro id cuando uso modelos ¿?
    //     $submodule = Submodule::find($theme->submodule_id);
    //     $module = Module::find($submodule->module_id);
    //     return redirect('inventario/'.$module->product_id.'/module');
    // }

}
