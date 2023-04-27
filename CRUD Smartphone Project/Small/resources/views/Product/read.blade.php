@extends('index')
@section('content')
    <div class="container">
        <h3 class="text-center">Product Manager</h3>
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