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
            'sucess' => 'Listado Registros',
            'data' => $data
        ],200);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $add = new Promotion();
            $add->name = $request->name;
            $add->description = $request ->description;
            $file = $request->file('image')->store('public/promotion');
            $add->image = $file;
            $add->ends = $request ->ends;
            $add->save();

            return response()->json([
                'message' =>  'oK',
                'info' =>  'Nuevo Registro!!',
                'data'=> $add,
            ], 201);
        }

        // $add = new Promotion($request->all());
        // $file =$request->image->store("public/images");

        // $add->image = $file;
        // $add->save();

    }

    
    public function show($id)
    {
        $query =Promotion::find($id);
        return response()->json([
            data => $query
        ],202);
    }

    
    public function update(Request $request, $id)
    {
        $record = Promotion::find($id);
        $record->name = $request->name;
        $record->description = $request ->description;
        $record->image = $file;
        $file = $request->file('image')->store('public/promotion');
        $record->ends = $request ->ends;
        $record->save();
        return response()->json([
            'message' => 204,
            'info' => 'Actualizacion exitosa',
            'data' => $record
        ]);
    }

    
    public function destroy($id)
    {
        $record = Promotion::findOrfail($id);
        $record->delete();

        return response()->json([
            'message' => 204,
            'info' => 'Registro Eliminado',
        ]);
    }
}
