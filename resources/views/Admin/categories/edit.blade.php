@extends('layouts.adminHead')
@section('content')
    <div class="form-main-container">
        <form action="{{ asset('admin/categories/' .$category->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-container">
                <h1> Update {{ $category->title }}</h1>
                <hr>
                <input
                type="file"
                class="file-input"
                value=""
                name="image">
                <input
                type="text"
                class="text-input"
                name="title"
                value = {{ $category->title }}
                >
                <div class="is-featured">
                    <label for="important">Is Featured</label>
                    <input
                    type="checkbox"
                    name="important"
                    @if($category->important)
                    checked
                    @endif>    
                </div>
                <button
                type="submit" class="btn">
                Submit
                </button>
            </div>
            @if ($errors->any())
            <div class="w-4/8 m-auto text-center">
                @foreach ($errors->all() as $error)                   
                <li class="text-red-500 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </div>
            
     @endif
    </div>
    @endsection
