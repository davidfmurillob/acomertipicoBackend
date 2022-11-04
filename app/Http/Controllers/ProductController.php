<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();

        // return response()->json([
        //     'products' => $products,
        // ], 200);

        $products = Product::orderBy('nombre_producto' ,'DESC')->get();
        return response()->json([
            "product" => $products
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
        $products = new Product();
        $products->nombre_producto = $request ->nombre_producto;
        $products->descripcion_producto = $request ->descripcion_producto;
        $products->precio_producto = $request ->precio_producto;
        $products->establishment_id = $request ->establishment_id;
        $products->category_id = $request ->category_id;

        $products->save();

        return response()->json([

            'message' => 'Success',
            'info' => 'Registro Exitoso',
            'products' => $products,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
