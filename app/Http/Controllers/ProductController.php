<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Cache\Store;

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
        $products->establishment_name = $request ->establishment_name;
        $products->category_name = $request ->category_name;

        // 
        // /* Agregar imagen al producto */

        // $files = $request->file('imagen_producto');
        // $fileName = " ";
        // foreach ($files as $file) {
        //     $new_name = rand().'.'.$file->getClientOriginalName();
        //     $file->move(storage_path('app/public/products'),$new_name);
        //     $fileName = $fileName.$new_name.", ";
        // }
        // // return response()->json($fileName);

        // $products->imagen_producto = $fileName;
        
        //imagen puesta por david
        $file = $request->file('imagen_producto')->store('public/Productos');
        $products->imagen_producto = $file;
        //revisar el products save
        $products->save();

        return response()->json([
            'status' => 200,
            'message' => 'Producto registrado',
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
        $products = Product::find($id);
        $products->nombre_producto = $request ->nombre_producto;
        $products->descripcion_producto = $request ->descripcion_producto;
        $products->precio_producto = $request ->precio_producto;
        $products->establishment_id = $request ->establishment_id;
        $products->category_id = $request ->category_id;
        $products->establishment_name = $request ->establishment_name;
        $products->category_name = $request ->category_name;
        // $products->category_id = $request ->category_id;

         /* Agregar imagenes al producto */

        $files = $request->file('imagen_producto');
        $fileName = " ";
        foreach ($files as $file) {
            $new_name = rand().'.'.$file->getClientOriginalName();
            $file->move(storage_path('app/public/products'),$new_name);
            $fileName = $fileName.$new_name.", ";
        }
        // return response()->json($fileName);

        $products->imagen_producto = $fileName;
        $products->save();

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'info' => 'Registro Exitoso',
            'products' => $products,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::findOrfail($id);
        $products->delete();

        return response()->json([
            'message' => 204,
            'info' => 'Registro Eliminado',
        ]);
    }
}
