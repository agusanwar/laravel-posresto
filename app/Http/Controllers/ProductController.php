<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // get user paginate 10
        // $products = DB::table('products')
        //     ->when($request->input('name'), function ($query, $name){
        //         return $query->where('name', 'like', '%' . $name . '%')
        //             ->orWhere('email', 'like', '%' . $name . '%');
        //     })
        //     ->paginate(7);
        $products = Product::paginate(7);
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi requuest
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);

        // store product request
        $products = new Product();
        $products->name= $request->name;
        $products->desc= $request->desc;
        $products->price= $request->price;
        $products->category_id= $request->category_id;
        $products->stock= $request->stock;
        $products->status= $request->status;
        $products->is_favorite= $request->is_favorite;
        $products->save();

        // save image
        if($request->image){
            $image = $request->file('image');
            $image->storeAs('public/products', $products->id . '.' . $image->extension());
            $products->image = 'storage/products/' . $products->id . '.' . $image->extension();
            $products->save();
        }

        return Redirect()->route('products.index')->with('success', 'Product Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return view('pages.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);
        // get table categories
        $categories = DB::table('categories')->get();
        return view('pages.products.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validasi requuest
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);

        // store product request
        $products = Product::find($id);
        $products->name= $request->name;
        $products->desc= $request->desc;
        $products->price= $request->price;
        $products->category_id= $request->category_id;
        $products->stock= $request->stock;
        $products->status= $request->status;
        $products->is_favorite= $request->is_favorite;
        $products->save();

        // save image
        if($request->image){
            $image = $request->file('image');
            $image->storeAs('public/products', $products->id . '.' . $image->extension());
            $products->image = 'storage/products/' . $products->id . '.' . $image->extension();
            $products->save();
        }

        return Redirect()->route('products.index')->with('success', 'Update Product Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect()->route('products.index')->with('success', 'Delete Product Successfully');
    }
}
