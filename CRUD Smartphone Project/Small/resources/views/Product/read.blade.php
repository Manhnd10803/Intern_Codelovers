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
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset('storage/'.$item->image) }}" alt="" width="60px"></td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->storage }}</td>
                    <td>{{ $item->cate_name }}</td>
                    <td>
                        <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                            <a href="{{ route('product.edit', $item->id) }}"><button type="button" class="btn btn-warning">Update</button></a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('product.create') }}"><button type="button" class="btn btn-primary">Add</button></a>
    </div>
@endsection