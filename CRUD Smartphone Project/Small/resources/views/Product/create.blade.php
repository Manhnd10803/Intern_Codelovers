@extends('index')
@section('content')
    <div class="container">
        <h3 class="text-center">Add Product</h3>
        <form action="{{ route('product.store') }}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="">Name</label>
            <input type="text" class="form-control" name="name">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Color</label>
            <select name="color" id="" class="form-select">
                <option value="Black">Black</option>
                <option value="White">White</option>
                <option value="Gold">Gold</option>
            </select>
            <label for="">Storage</label>
            <select name="storage" id="" class="form-select">
                <option value="64gb">64gb</option>
                <option value="128gb">128gb</option>
                <option value="256gb">256gb</option>
                <option value="512gb">512gb</option>
                <option value="1tb">1tb</option>
            </select>
            <label for="">Category</label>
            <select name="cate_id" id="" class="form-select">
                <option value="">--Select--</option>
                @foreach ($cate as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('cate_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="">Image</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input type="submit"class="btn btn-outline-primary" value="Add">
        </form>
    </div>
@endsection