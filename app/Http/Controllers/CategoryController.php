<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title    = "Product Category";
        $category     = Category::latest()->get();
        return view('category.list',compact('title','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title    = "Add Product Category";
        $action   = route('category.store');
        $btn_name  = 'Create';
        return view('category.add',compact('title','action','btn_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $inputs = $request->all();
        Category::create($inputs);
         return redirect()->route('category.index')->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $row     = Category::find($id);
        $title    = 'Edit Category';
        $action   = route('category.update',$id);
        $btn_name  = 'Update';
        return view('category.add',compact('title','row','action','btn_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $row     = Category::find($id);
        $inputs = $request->all();
        $row->fill($inputs)->save();
        return redirect()->route('category.index')->with('success','Updated successfully..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
    public function delete(string $id)
    {
        //
        Category::where('id', $id)->delete();
        return redirect()->route('category.index')->with('success','Deleted successfully.');
    }
    
}
