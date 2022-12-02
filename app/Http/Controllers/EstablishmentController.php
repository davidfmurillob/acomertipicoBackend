<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Product;


class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishment = Establishment::all();

        return response()->json([

            'message' => 'success',
            'info' => 'Listado de Establecimientos',
            'establishment' => $establishment,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $establishment = new Establishment();
        $establishment->nombre_establecimiento = $request -> nombre_establecimiento;
        $establishment->direccion_establecimiento = $request -> direccion_establecimiento;
        $establishment->telefono_establecimiento = $request->telefono_establecimiento;
        $establishment->descripcion = $request->descripcion;
        // $file = $request->file('imagen')->store('public/Establecimiento');
        $establishment->imagen = $request->imagen;

        $establishment->ubicacion =$request->ubicacion;

        $establishment->save();

        return response()->json([
            //linea MUY NECESARIA en todos los crud agregada por david
            'status' => 200,
            'message' => 'Registro exitoso',
            'info' => 'Establecimiento creado',
            'establishment' => $establishment,
        ], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        $product = Product::select('nombre_producto', 'descripcion_producto', 'precio_producto')
        ->join('establishments', 'products.establishment_id', '=' , 'establishments.id')
        ->where('establishments.id', $establishment->id)
        ->get();

        return response()->json([

            'product' => $product,
            'establishment' => $establishment,
        ], 200);

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

        $establishment = Establishment::find($id);
        $establishment->nombre_establecimiento = $request ->nombre_establecimiento;
        $establishment->direccion_establecimiento = $request -> direccion_establecimiento;
        $establishment->telefono_establecimiento = $request->telefono_establecimiento;
        $establishment->descripcion = $request->descripcion;
        $establishment->imagen = $request->imagen;
        //Faltaba ubicacion, agregado por david 

        $establishment->ubicacion =$request->ubicacion;


        $establishment->save();

        return response()->json([

            'message' => 'Actualizacion exitoso',
            'info' => 'Registro actualizado',
            'establishment' => $establishment,
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Establishment::findOrfail($id);
        $record->delete();

        return response()->json([
            'message' => 204,
            'info' => 'Registro Eliminado',
        ]);
    }
}
