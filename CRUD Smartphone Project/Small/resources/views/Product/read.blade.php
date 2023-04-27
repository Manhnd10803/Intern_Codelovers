@extends('index')
@section('content')
    <div class="container">
        <a href="/"><h3 class="text-center">Product Manager</h3></a>
        <br>
        <form action="/search/product" method="get">
            {{-- @csrf --}}
            @method('POST')
            <div class="formSearch">
                <input type="text" class="form-control" name="keyword" placeholder="Product name...">
                <select name="cate_id" id="" class="form-select">
                    <option value="">--Select--</option>
                    @foreach ($cate as $item)
                        <option value="{{ $item->idCate }}">{{ $item->cateName }}</option>
                    @endforeach
                </select>
                <input type="submit" value="Search" class="btn btn-outline-primary">
            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Image</th>
                <th>Color</th>
                <th>Storage</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($products as $item)
                <tr>
                    <td>{{ $item->productName }}</td>
                    <td><img src="{{ asset('storage/'.$item->productImage) }}" alt="" width="60px"></td>
                    <td>{{ $item->productColor }}</td>
                    <td>{{ $item->productStorage }}</td>
                    <td>{{ $item->cateName }}</td>
                    <td>
                        <form action="{{ route('product.destroy', $item->idProduct) }}" method="POST">
                            <a href="{{ route('product.edit', $item->idProduct) }}"><button type="button" class="btn btn-warning">Update</button></a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content: space-between">
            <a href="{{ route('product.create') }}"><button type="button" class="btn btn-primary">Add</button></a>
            <div style="margin-right: 10%">{{ $products->links() }}</div>
        </div>
    </div>
@endsection