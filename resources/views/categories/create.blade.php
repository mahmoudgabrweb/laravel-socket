@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Category</div>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
                @endif
                <div class="card-body">
                    <form action="{{ url('categories') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="category_name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Category logo</label>
                            <input type="file" name="category_logo" class="" />
                        </div>                  
                        <input type="submit" value="Save !" class="btn btn-block btn-info" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
