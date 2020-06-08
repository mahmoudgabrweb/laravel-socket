@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category details</div>
                <div>
                    <span><b>Category name</b></span>
                    <span>{{ $category->category_name }}</span>
                </div>      
                <div>
                    <span><b>Category price</b></span>
                    <span>{{ $category->price }}</span>
                </div>      
                <div>
                    <span><b>Category logo</b></span>
                    <span><img src="{{ url('app/'.$category->category_logo) }}" style="width: 80px;height: 80px;" /></span>
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection
