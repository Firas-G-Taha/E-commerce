@extends('layouts.adminhead')
@section('content')
    <div class="main-container">
            @foreach ($subcategories as $subcategory)
            <div class="second-container">
                    <img src="{{ asset('storage/images/subCategories/' .$subcategory->image) }}" alt="imaage of Category">
                <h1 class="category-title">
                        {{ $subcategory->title }}
                </h1>
                <p>
                    Category: {{ $subcategory->category->title }}    
                </p>
                <div class="edit-delete">
                    <a href="/admin/subcategories/delete/{{ $subcategory->id }}" class="delete btn">
                        Delete
                    </a>
                    <a href="/admin/subcategories/{{ $subcategory->id }}/edit" class="edit btn">
                        Edit
                    </a>    
                </div>
             </div>
                
            @endforeach

            <a 
            href="/admin/subcategories/create"
            class="new-category btn">
                Add a new subcategory
            </a>
        </div>
        

    </div>
@endsection