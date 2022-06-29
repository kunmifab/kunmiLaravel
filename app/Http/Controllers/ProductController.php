<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('product.index', ['products' => $products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'description' => 'string|nullable|max:255',
            'image' => 'file|nullable|mimes:jpg,jpeg,png',
            'quantity' => 'numeric|required|min:0'
        ]);


        $product = new Product();
        if (($request->file('image')) !=null){
            $image_path = $request->file('image')->storePublicly('products');

            move_uploaded_file($image_path, public_path('image'));
            //$image_path->move(public_path('image'));
            $product->image_path = $image_path;
        }
        $product->name = Str::title($request->name);
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();
        return redirect('/product');

    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('product.edit', ['product'=> $product]);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'description' => 'string|nullable|max:255',
            'image' => 'file|nullable|mimes:jpg,jpeg,png',
            'quantity' => 'numeric|required|min:0'
        ]);


        $product = Product::findOrFail($id);
        if (($request->file('image')) !=null){
            if(($product->image_path) != null ){
                Storage::delete($product->image_path);
                $image_path = $request->file('image')->storePublicly('products');
                move_uploaded_file($image_path, public_path('image'));
                $product->image_path = $image_path;
            }



        }
        $product->name = Str::title($request->name);
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();
        return redirect()->route('show_product', ['slug'=> $product->slug]);
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
        $product = Product::findOrFail($id);

        Storage::delete($product->image_path);
        $product -> delete();

        return redirect('/product');
    }
}
