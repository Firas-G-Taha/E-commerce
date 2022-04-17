@extends('layouts.adminHead')
@section('content')
    <div class="form-main-container">
        <form action="/admin/categories" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-container">
                <h1> Create Category</h1>
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
                placeholder="Category name..."
                >

                
                <textarea 
                style="height: 100px"
                class="text-input"
                name="description"
                cols="30"
                rows="10"
                placeholder="description . . ."></textarea>
                
                <div class="is-featured">
                    <label for="important">Is Featured</label>
                    <input
                    type="checkbox"
                    name="important">    
                </div>
                <button
                type="submit" class=" btn">
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