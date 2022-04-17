@extends('layouts/head')
@section('content')

<div class="subcategory-selector-container">
        <p>SUBCATEGORIES</p>
        <input type="text" name="" id="category_id" value="{{ $category->id }}" hidden>
        <select name="chosen_subCategory" id="chosen_subCategory" class="subcategory-selector select">
            <option value="all">ALL</option>
            @foreach ($category->subcategories as $subcategory)
                <option value="{{ $subcategory->title }}">{{ $subcategory->title }}</option>
            
            @endforeach
        </select>
    </div>
    <div class="products-container">
        
        @foreach ($products as $product)
            
        <div class="product-container">
                <a href="/product/{{ $product->id }}">
                    <img src="{{ asset('/storage/images/products/'.$product->image) }}" alt="category image">
                </a>
                <div class="product-text">
                    <h1>{{ $product->name }}</h1>
                    <div class="flex-row gap25px">
                        <p>price: {{ $product->price }}$</p>
                        <p>quantity: {{ $product->quantity }}</p>
                    </div>
                </div>
                {{-- <input type="number" value={{ $product->cartQuantity }} id="product{{ $loop->iteration }}" class="product" name='' max = {{ $product->quantity }} min=0> --}}
                <form action="{{ asset('addToCart/'.$product->id) }}" method="post" class="input-button width100" >
                    @csrf
                    <input type="number"  value=1 name='quantity' min=0 max={{ $product->quantity }} class="text-input width100px">
                    <input type='number'  value={{ $product->price }} name='price' hidden>

                    <button type="submit" class="form-btn ">Add To Cart</button>
                </form>
                
            </div>
        @endforeach
    </div>
    <script src="/js/category.js"></script>
@endsection