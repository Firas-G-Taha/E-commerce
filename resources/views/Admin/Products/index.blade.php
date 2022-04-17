
@extends('layouts.adminHead')
@section('content')
    <div class="main-container">
        
            @foreach ($products as $product)
            <div class="second-container">
                 
                <img src="{{ asset('storage/images/products/' .$product->image) }}" alt="image of product">
                 
                <h1 class="category-title">
                        {{ $product->name }}
                    </h1>
                    <div class="p-q">
                        <p >Price: {{ $product->price }}</p>
                        <p >quantity: {{ $product->quantity }}</p>
                    </div>
                    <div class="c-s">
                        <p >category: {{ $product->category->title }}</p>
                        <p >subcategory: {{ $product->subcategory->title }}</p>
                    </div>
                <p class="">
                     Available: 
                     @if ($product->available)
                        <span style="color:green">Yes</span>
                     @else
                        <span style="color:red">No</span>
                     @endif    
                </p>
                <div class="edit-delete">
                    {{-- <a href="categories/delete/{{ $product->id }}" class="delete btn">
                        Delete
                    </a> --}}
                    <form action="/admin/products/{{ $product->id }}" method="POST" class="">
                        @csrf
                        @method('delete')
                        <button type="submit"
                        class="delete btn">
                        Delete </button>    
                    </form>
                    <a href="/admin/products/{{ $product->id }}/edit" class="edit btn">
                        Edit
                    </a>    
                </div>
             </div>
            {{-- </div> --}}
                
            @endforeach

            <a 
            href="/admin/products/create"
            class="new-category btn">
                Add a new product
            </a>
        </div>
        <div class="bg-blue-100">
            {{-- {{ $categoroes->links() }} --}}

        </div>

    </div>

    @endsection