@extends('index')
@section('content')
    <div class="container">
        <h3 class="text-center">Edit Product</h3>
        <form action="{{ route('product.update', $product->id) }}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Color</label>
            <select name="color" id="" class="form-select">
                <option value="Black" @selected($product->color == 'Black')>Black</option>
                <option value="White" @selected($product->color == 'White')>White</option>
                <option value="Gold" @selected($product->color == 'Gold')>Gold</option>
            </select>
            <label for="">Storage</label>
            <select name="storage" id="" class="form-select">
                <option value="64gb" @selected($product->storage == '64gb')>64gb</option>
                <option value="128gb" @selected($product->storage == '128gb')>128gb</option>
                <option value="256gb" @selected($product->storage == '256gb')>256gb</option>
                <option value="512gb" @selected($product->storage == '512gb')>512gb</option>
                <option value="1tb" @selected($product->storage == '1tb')>1tb</option>
            </select>
            <label for="">Category</label>
            <select name="cate_id" id="" class="form-select">
                <option value="">--Select--</option>
                @foreach ($cate as $item)
                    <option value="{{ $item->id }}" @selected($product->cate_id == $item->id)>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('cate_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Image</label>
            <div class="">
                <img src="{{ asset('storage/'.$product->image) }}" alt="" width="300px">
            </div>
            <input type="file" class="form-control" name="image" accept="image/*">
            <input type="submit"class="btn btn-outline-primary" value="Add">
        </form>
    </div>
@endsection