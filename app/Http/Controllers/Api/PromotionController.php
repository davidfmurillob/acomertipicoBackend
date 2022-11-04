<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Validated;

class PromotionController extends Controller
{
    
    public function index()
    {
        return response()->json([
            Promotion::all(),
        ],200);
    }

    
    public function store(Request $request)
    {
        // $request->validate([
        //     //'title' => 'required',
        //     'image' => 'required',
        //     'ends' => 'required'
        // ]);


        $add = new Promotion($request->all());
        $file =$request->image->store("public/images");

        $add->image = $file;
        $add->save();

        return response()->json([
            'message' =>  'oK',
            'info' =>  'El registro fue satisfactorio',
            'data'=> $add,
        ], 201);
    }

    
    public function show($id)
    {
        return response()->json([
            Promotion::find($id),
        ],202);
    }

    
    public function update(Request $request, $id)
    {
        $record = Promotion::find($id);
        $record->update($request->all());
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
