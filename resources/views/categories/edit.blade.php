@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Category</div>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
                @endif
                <div class="card-body">
                    <form action="{{ url('categories/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" />
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $category->price }}" />
                        </div>
                        <div class="form-group">
                            <label>Old category logo</label>
                            <img src="{{ url('app/'.$category->category_logo) }}" style="width: 40px;height: 40px;" />
                        </div>
                        <div class="form-group">
                            <label>Category logo</label>
                            <input type="file" name="category_logo" class="" />
                        </div>                  
                        <input type="submit" value="Update !" class="btn btn-block btn-info" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
