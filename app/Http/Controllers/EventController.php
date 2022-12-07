<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::all();

        return response()->json([
            "message" => "Lista de eventos",
            "status" => 200,
            "event" => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->nombre = $request ->nombre;
        $event->fecha = $request ->fecha;
        $event->hora = $request ->hora;
        $event->direccion = $request ->direccion;

        $event->save();

        return response()->json([
            "status" => 200,
            "message" => "Evento creado con exito",
            "event" => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event =  Event::find($id);
        $event->nombre = $request ->nombre;
        $event->fecha = $request ->fecha;
        $event->hora = $request ->hora;
        $event->direccion = $request ->direccion;

        $event->save();

        return response()->json([
            "status" => 200,
            "message" => "Evento Actualizado con exito",
            "event" => $event

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrfail($id);
        $event->delete();

        return response()->json([
            'message' => 204,
            'info' => 'Registro Eliminado',
        ]);
    }
}
