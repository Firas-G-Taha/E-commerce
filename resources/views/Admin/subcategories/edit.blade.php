@extends('layouts/adminHead')
@section('content')
    <div class="form-main-container">
        <form action="{{ asset('/admin/subcategories/' .$subcategory->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-container gap25px">
                <h1> Update {{ $subcategory->title }}</h1>
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
                value = {{ $subcategory->title }}>
                
                <select name="category_id" id="" class="select">
                       @forelse ($categories as $category)
                       <option value="{{ $category->id }}">{{ $category->title }}</option>
                           
                       @empty
                           
                       @endforelse
                </select>
                <button
                type="submit" class=" form-btn">
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