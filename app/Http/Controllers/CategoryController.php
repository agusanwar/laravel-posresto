<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // get user paginate 10
         $categories = DB::table('categories')
         ->when($request->input('name'), function ($query, $name){
             return $query->where('name', 'like', '%' . $name . '%')
                 ->orWhere('email', 'like', '%' . $name . '%');
         })
         ->paginate(5);
     return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.create');
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
            'image' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

         // store product request
         $categories = new Category();
         $categories->name= $request->name;
         $categories->desc= $request->desc;
         $categories->save();
         
          // save image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs(('public/categories' . $categories->id. '.' . $image->getClientOriginalExtension()));
            $categories->image = 'storage/categories' . $categories->id . '.' . $image->getClientOriginalExtension();
            $categories->save();
        }

        return Redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::findOrFail($id);
        return view('pages.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         // validasi requuest
         $request->validate([
            'name' => 'required',
            // 'image' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        // store product request
        $categories = Category::find($id);
        $categories->name= $request->name;
        $categories->desc= $request->desc;
        $categories->save();

        // save image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categories', $categories->id . '.' . $image->getClientOriginalExtension());
            $categories->image = 'storage/categories' . $categories->id . '.' . $image->getClientOriginalExtension();
            $categories->save();
        }

        return Redirect()->route('categories.index')->with('success', 'Update Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Delete Category Successfully');
    }
}
