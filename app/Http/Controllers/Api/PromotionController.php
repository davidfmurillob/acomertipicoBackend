<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{

    public function index()
    {
        $data = Promotion::all();
        return response()->json([
            'status' => 200,
            'sucess' => 'Listado Registros',
            'data' => $data
        ],200);
    }


    public function store(Request $request)
    {
            $add = new Promotion();
            $add->name = $request->name;
            $add->description = $request ->description;
            // $file = $request->file('image')->store('public/Promociones');
            $add->image = $request->image;
            $add->ends = $request ->ends;
            $add->save();

            return response()->json([
                'status' => 200,
                'message' =>  'oK',
                'info' =>  'Nuevo Registro!!',
                'data'=> $add,
            ], 200);
        // $add = new Promotion($request->all());
        // $file =$request->image->store("public/images");

        // $add->image = $file;
        // $add->save();

    }


    public function show($id)
    {
        $query =Promotion::find($id);
        return response()->json([
            'data' => $query
        ],202);
    }


    public function update(Request $request, $id)
    {
        $record = Promotion::find($id);
        $record->name = $request->name;
        $record->description = $request ->description;
        $record->image = $request->image;
        $record->ends = $request ->ends;
        $record->save();
        return response()->json([
            'status' => 200,
            'message' => 'Registro Actualizado!!',
            'info' => 'Actualizacion exitosa',
            'data' => $record
        ]);
    }


    public function destroy($id)
    {
        $record = Promotion::findOrFail($id);
        $record->delete();

        return response()->json([
            'starus' => 200,
            'message' => 'Todo esta ok',
            'info' => 'Registro Eliminado',
        ]);
    }
}
