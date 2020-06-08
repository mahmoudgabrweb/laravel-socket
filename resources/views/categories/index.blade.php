@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Categories</div>

                <div class="card-body">
                    <a href="{{ url('categories/create') }}">Create New</a>
                    <table class="table table-bordered" id="categories-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->price }}</td>
                                <td>
                                    <a href="{{ url('categories/'.$category->id) }}">View</a> / 
                                    <a href="{{ url('categories/'.$category->id.'/edit') }}">Edit</a> / 
                                    <a href="{{ url('categories/'.$category->id) }}" onclick="event.preventDefault();
                                                document.getElementById('category_delete_{{$category->id}}').submit();">Delete</a>
                                    <form id="category_delete_{{$category->id}}" action="{{ url('categories/'.$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection