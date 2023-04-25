<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class SmartPhonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Home";
        $products = Product::get();
        // Tự động thêm thuộc tính cate_name vào trong đối tượng sản phẩm dựa vào cate_id
        foreach($products as $product){
            $category = Category::find($product->cate_id);
            $product->cate_name = $category->name;
            // echo $product->cate_name;
        }
        // dd($products);
        return view('product.read', compact('pageTitle', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = Category::get();
        $pageTitle = 'Add Product';
        return view('product.create', compact('cate', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    protected function storeImage(Request $request) {
        $path = $request->file('image')->store('public/images');
        return substr($path, strlen('public/'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:products|max:100',
            'cate_id' => 'required',
            'image' => 'required'
        ]);
        $imageUrl = $this->storeImage($request);
        Product::create([
            'name' => $request['name'],
            'color' => $request['color'],
            'storage' => $request['storage'],
            'image' => $imageUrl,
            'cate_id' => $request['cate_id'],
        ]);
        return redirect('/');
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
        $cate = Category::get();
        $product = Product::find($id);
        $pageTitle = 'Edit Product';
        return view('product.update', compact('product', 'pageTitle', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:100',
            'cate_id' => 'required',
        ]);
        // TH không cập nhật ảnh, giữ nguyên ảnh cũ
        (!$request->file('image')) ? $imageUrl = Product::find($product->id)->image : $imageUrl = $this->storeImage($request);
        // echo $imageUrl;
        $product->fill([
            'name' => $request['name'],
            'color' => $request['color'],
            'storage' => $request['storage'],
            'image' => $imageUrl,
            'cate_id' => $request['cate_id'],
        ])->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {   
        $product->delete();
        return redirect('/');
    }
}
