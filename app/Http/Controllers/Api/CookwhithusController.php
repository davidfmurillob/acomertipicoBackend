<?php

namespace App\Http\Controllers\Api;

use App\Models\Cookwithus;
use App\Models\Establishment;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class CookwhithusController extends Controller
{
    
    public function index()
    {
        $Cookwithus = Cookwithus::all();

        return response()->json([
            'message' =>  'success',
            'info' =>  'Listar Registros',
            'Registros'=> $Cookwithus,
        ], 205);
    }

    
    public function store(Request $request)
    {
        $client = new Cookwithus();
        $client->email = $request->email;
        $client->telephone = $request->telephone;
        $client->id_product = $request->id_product;
        $client->save();

            return response()->json([
                'status' => 200,
                'message' =>  'oK',
                'info' =>  'El registro fue satisfactorio',
                'Registro'=> $client,
            ], 200);
    }


    public function show($id)
    {
        $cook = Cookwithus::find($id);
        return response()->json([
            'data' => $cook
        ],202);
    }

    
    public function update(Request $request, $id)
    {
        $record = Cookwithus::find($id);
        $record->update($request->all());
        return response()->json([
            'message' => 204,
            'info' => 'Actualizacion exitosa',
            'data' => $record
        ]);
    }


    public function destroy($id)
    {
        $record = Cookwithus::findorfail($id);
        $record->delete($id);

        return response()->json([
            'status' => 200,
            'message' => 'Registro eliminado',
            'info' => 'Accion exitosa',
            'data' => $record
        ]);
    }
}
