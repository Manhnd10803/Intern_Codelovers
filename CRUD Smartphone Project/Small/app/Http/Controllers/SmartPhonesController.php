<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SmartPhonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Home";
        $products = DB::table('products')->join('categories', 'products.cate_id', '=', 'categories.idCate')->orderBy('idProduct')->paginate(6);
        $cate = Category::get();
        return view('product.read', compact('pageTitle', 'products', 'cate'));
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
        $path = $request->file('productImage')->store('public/images');
        return substr($path, strlen('public/'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'bail|required|unique:products|max:100',
            'cate_id' => 'required',
            'productImage' => 'required|mimes:jpg,jpeg,png,gif|max:2048'
        ],
        // Quy định hiển thị thông báo lỗi
        // [
        //     'productImage.mimes' => 'Chỉ nhập ảnh',
        //     'productImage.max' => 'Ảnh tối đa 2MB'
        // ]
    );
        $imageUrl = $this->storeImage($request);
        $post = Product::create([
            'productName' => $request['productName'],
            'productColor' => $request['productColor'],
            'productStorage' => $request['productStorage'],
            'productImage' => $imageUrl,
            'cate_id' => $request['cate_id'],
        ]);
        if($post instanceof Model){
            toastr()->success('Data has been added successfully!');
            return redirect()->route('product.index');
        }
        return redirect()->back();
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
    public function edit(string $idProduct)
    {
        $cate = Category::get();
        // $product = Product::find( $productId, $idProduct);
        $product = DB::table('products')->where('idProduct', '=', $idProduct)->first();
        $pageTitle = 'Edit Product';
        // dd($product);
        return view('product.update', compact('product', 'pageTitle', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productName' => 'required|max:100',
            'cate_id' => 'required',
            'productImage' => 'mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        // Có upload ảnh mới thì mới update đường dẫn ảnh
        if($request->file('productImage')){
            $imageUrl = $this->storeImage($request);
            $product->productImage = $imageUrl;
        }

        $product->productName = $request->productName;
        $product->productColor = $request->productColor;
        $product->productStorage = $request->productStorage;
        $product->cate_id = $request->cate_id;
        // dd($product);
        $product->save();
        // toastr()->success('Updated','Sửa thành công '. $request->productName);
        toastr()->success('Data has been updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {   
        $product->delete();
        toastr()->success('Data has been deleted successfully!');
        return redirect()->route('product.index');
    }

    public function search(Request $request){
        $pageTitle = "Serach";
        if($request->keyword != null && $request->cate_id != null){
            $cate = Category::get();
            $products = DB::table('products')->join('categories', 'products.cate_id', '=', 'categories.idCate')->where('cate_id', '=', $request->cate_id)->where('productName', 'like', "%".$request->keyword."%")->paginate(6);
        }else if($request->keyword != null && $request->cate_id == null){
            $cate = Category::get();
            $products = DB::table('products')->join('categories', 'products.cate_id', '=', 'categories.idCate')->where('productName', 'like', "%".$request->keyword."%")->paginate(6);
        }else if($request->keyword == null && $request->cate_id != null){
            $cate = Category::get();
            $products = DB::table('products')->join('categories', 'products.cate_id', '=', 'categories.idCate')->where('cate_id', '=', $request->cate_id)->paginate(6);
        }else if($request->keyword == null && $request->cate_id == null){
            $products = DB::table('products')->join('categories', 'products.cate_id', '=', 'categories.idCate')->orderBy('idProduct')->paginate(6);
            $cate = Category::get();
        }
        return view('product.read', compact('pageTitle', 'products', 'cate'));
    }

}
