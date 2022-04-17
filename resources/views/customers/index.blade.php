@extends('layouts.head')
@section('content')

<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    @forelse ($products as $index => $product)
    <div class="mySlides fade">
      <div class="numbertext">{{ $index }}/{{ $products->count() }}</div>
      <a href="/product/{{ $product->id }}">
        <img src="{{ asset('/storage/images/products/'.$product->image) }}" style="width:100%">
      </a>
        <div class="slideshow-text" style="color: #333"><h3>
          {{$product->description }}
        </h3></div>
      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
        
    @empty
    
    <h1 class="error-msg">Ther's No Featured Products</h1>
    @endforelse
  </div>
    
<div class="e-container">
    @forelse ($categories as $category)
    
    
    <div class="category">
        <div class="category-image-a">
            <a href="/category/{{ $category->id }}">
            <img 
            class="category-image"
            src="{{asset('/storage/images/categories/'.$category->image)}}"
             alt="category image">

            </a>
        </div>
        <div class="category-text">
            <h1>{{ $category->title }}</h1>
            <p>{{ $category->description   }}</p>
        </div>
    </div>
    @empty
    <h1 class="error-msg">THERE IS NO CATEGORIES</h1>
    @endforelse
    <br>
</div>

<script src="/js/e-commerce.js"></script>

@endsection