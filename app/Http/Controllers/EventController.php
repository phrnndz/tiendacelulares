<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Event;
use Auth;
use Alert;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Alert::message('Robots are working!');
        $events = Event::where('status','<>', 4)->paginate(15);
        

        return view('dashboard.eventos.index', compact('events'));
        
    }

    public function create()
    {

        return view('dashboard.eventos.create');
        
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'description'   => 'required',
            'date'          => 'required',
            'status'        => 'required',
            'photo'         => 'image|nullable|max:1999'
        ])->validate();
       

        $slug = Str::slug(strtolower($request->name), '-');

        if($request->hasFile('photo')){
            // $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('photo')->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // $path = $request->file('photo')->storeAs('storage', $fileNameToStore);

            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('img/eventos'), $imageName);


        }
        else{
            $imageName = null;
        }

        // return $request;

        $event = new Event;
        $event->name = ucwords(strtolower($request->name));
        $event->slug = $slug;
        $event->description = $request->description;
        $event->price = $request->price;
        $event->date = $request->date;
        $event->status = $request->status;
        $event->photo = $imageName;
        $event->save();

        alert()->success('Agregado Correctamente.', 'Correcto');
        return redirect()->route('evento.index');
        

    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('dashboard.eventos.edit',compact('event'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // dd($request);

        Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'status'        => 'required',
            'photo'         => 'image|nullable|max:1999'
        ])->validate();
        $Event = Event::find($id);
       

        if($request->hasFile('photo')){
            // $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('photo')->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // $path = $request->file('photo')->storeAs('storage', $fileNameToStore);
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('img/eventos'), $imageName);
        }
        else{
            // si no hay file, entonces tomar el mismo valor que ya tiene
            if(strlen($Event->photo)>2){
                $imageName = $Event->photo;
            }else{
                $imageName = null;
            }
        }


        $slug = Str::slug(strtolower($request->name), '-');
        $Event->name = ucwords(strtolower($request->name));
        // $Event->slug = $slug;
        $Event->description = $request->description;
        $Event->price = $request->price;
        $Event->status = $request->status;
        $Event->photo = $imageName;
        $Event->save();

        alert()->success('Actualizado Correctamente.', 'Correcto');
        return redirect()->route('evento.index');

    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Event = Event::find($id);
        $Event->status =4;
        $Event->save();
  
        alert()->success('Se Borró el Registro Correctamente.', 'Correcto');
        return redirect()->route('evento.index');
    }
}
