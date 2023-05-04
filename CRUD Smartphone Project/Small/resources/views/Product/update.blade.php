@extends('index')
@section('content')
    <div class="container">
        <h3 class="text-center">Edit Product</h3>
        <form action="{{ route('product.update', $product->idProduct) }}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="">Name</label>
            <input type="text" class="form-control" name="productName" value="{{ $product->productName }}">
            @error('productName')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Color</label>
            <select name="productColor" id="" class="form-select">
                <option value="Black" @selected($product->productColor == 'Black')>Black</option>
                <option value="White" @selected($product->productColor == 'White')>White</option>
                <option value="Gold" @selected($product->productColor == 'Gold')>Gold</option>
            </select>
            <label for="">Storage</label>
            <select name="productStorage" id="" class="form-select">
                <option value="64gb" @selected($product->productStorage == '64gb')>64gb</option>
                <option value="128gb" @selected($product->productStorage == '128gb')>128gb</option>
                <option value="256gb" @selected($product->productStorage == '256gb')>256gb</option>
                <option value="512gb" @selected($product->productStorage == '512gb')>512gb</option>
                <option value="1tb" @selected($product->productStorage == '1tb')>1tb</option>
            </select>
            <label for="">Category</label>
            <select name="cate_id" id="" class="form-select">
                <option value="">--Select--</option>
                @foreach ($cate as $item)
                    <option value="{{ $item->idCate }}" @selected($product->cate_id == $item->idCate)>{{ $item->cateName }}</option>
                @endforeach
            </select>
            @error('cate_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Image</label>
            <div class="">
                <img src="{{ asset('storage/'.$product->productImage) }}" alt="" width="300px">
            </div>
            <input type="file" class="form-control" name="productImage">
            @error('productImage')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input type="submit"class="btn btn-outline-warning" value="Update">
        </form>
    </div>
@endsection