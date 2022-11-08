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
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'telephone' => 'required',
        ]);


        if(!$validator->fails()) {
            $client = new Cookwithus($request->all());
            $client->save();

            return response()->json([
                'message' =>  'oK',
                'info' =>  'El registro fue satisfactorio',
                'Registro'=> $client,
            ], 201);
        }else{
            return 400;
        }
        // https://dejuniorasenior.com/laravel-8-enlace-de-almacenamiento-storage-link-no-funciona-en-produccion/
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
        $Cookwithus = Cookwithus::findorfail($id);
        $Cookwithus->delete($id);

        return 204;
    }
}
