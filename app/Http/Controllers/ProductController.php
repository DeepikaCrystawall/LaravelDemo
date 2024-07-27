<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title    = "Products";
        $products     = Product::with('category')->paginate(10);
        
        return view('products.list',compact('title','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title    = "Add Product";
        $action   = route('products.store');
        $category = Category::get();
        $btn_name  = 'Create';
        return view('products.add',compact('title','action','btn_name','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $image = $request->file('image');
        
        $destinationPathThumbnail = public_path('uploads/products/small');
        $imageName = time().'.'.$image->extension();
        $img = Image::read($image->path());
        $img->resize(500, 350, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);
     
        $destinationPath = public_path('/uploads/products');
        $image->move($destinationPath, $imageName);
       
        $inputs = $request->all();
        $inputs['image'] = $imageName;
        Product::create($inputs);
        return redirect()->route('products.index')->with('success','User created successfully.');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $row     = Product::find($id);
        $title    = 'Edit Product';
        $action   = route('products.update',$id);
        $category = Category::get();
        $btn_name  = 'Update';
        return view('products.add',compact('title','row','action','btn_name','category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $row     = Product::find($id);
        $inputs = $request->all();
        $row->fill($inputs)->save();
        return redirect()->route('products.index')->with('success','Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    public function delete(string $id)
    {
        //
        Product::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success','Deleted successfully.');
    }
}
