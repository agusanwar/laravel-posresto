<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
   {
       //   $product = Product::paginate(10);
        $product = Product::all();
        //load categpry
        $product->load('category');
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ], 200);
   }
}
