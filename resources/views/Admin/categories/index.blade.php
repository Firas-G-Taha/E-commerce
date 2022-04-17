@extends('layouts.adminHead')
@section('content')
    <div class="main-container">
        
            @foreach ($categories as $category)
            <div class="second-container">
                    {{-- <form action="/categories/{{ $category->id }}" method="POST" class="pt-3">
                        @csrf
                        @method('delete')
                        <button type="submit"
                        class="border-
                        b-2 pb-2 border-dotted italic text-red-500">
                        Delete </button>
                    </form> --}}
                    <img src="{{ asset('storage/images/categories/' .$category->image) }}" alt="image of Category">
                 
                    
               
                <h1 class="category-title">
                    <a href="/categories/{{ $category->id }}">
                        {{ $category->title }}
                    </a>  
                </h1>
                <p class="">
                     Important: 
                     @if ($category->important)
                        <span style="color:green">Yes</span>
                     @else
                        <span style="color:red">No</span>
                     @endif    
                </p>
                <div class="edit-delete">
                    <a href="/admin/categories/delete/{{ $category->id }}" class="delete btn">
                        Delete
                    </a>
                    <a href="categories/{{ $category->id }}/edit" class="edit btn">
                        Edit
                    </a>    
                </div>
             </div>
            {{-- </div> --}}
                
            @endforeach

            <a 
            href="/admin/categories/create"
            class="new-category btn">
                Add a new category
            </a>
        </div>
        <div class="bg-blue-100">
            {{-- {{ $categoroes->links() }} --}}

        </div>

    </div>
@endsection