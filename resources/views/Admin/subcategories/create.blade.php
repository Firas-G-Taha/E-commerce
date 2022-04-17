@extends('layouts.adminhead')
@section('content')
<div class="form-main-container">
    <form action="/admin/subcategories" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <h1> SubCategory</h1>
            <input
            type="file"
            class="file-input"
            name="image">
            <input
            type="text"
            class="text-input"
            name="title"
            placeholder="Subcategory name...">
            <select name="category_id" class="select">          
            @forelse ($categories as $category)
            <option value="{{ $category->id }}" >{{ $category->title }}</option>
            @empty
            <option value="#">No Categories</option>
            @endforelse  
            </select>
             <button
                type="submit" class="btn">
                Submit
            </button>
    
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
    </form>

</div>    
@endsection