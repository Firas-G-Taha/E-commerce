@extends('layouts.head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@section('content')
<div class="main-container">
    @if ($product !== null)
        <div class="productpage-container">
            <div class="product-image">
                <img id="show" src="{{ asset('/storage/images/products/'.$product->image) }}" alt="product image">
            </div>
            <div class="product-info">
                <div class="inner-info">
                    <h1>{{ $product->name }}</h1>

                    <div class="price-quantity">
                        <p>Price: {{ $product->price }}</p>
                        <p>Quantity: {{ $product->quantity }}</p>
                    </div>
                    
                    <p class="description">{{ $product->description }}</p>   
                </div>
                <form action="/addToCart/{{ $product->id }}" method="post" class="btn-input">
                    @csrf
                    <button type="submit" class="btn">ADD TO CART</button>
                    <input class="select width100px" type="number" name="quantity" value = 1  min = 1 max = {{ $product->quantity }} >
                    <input type="number" name="price" value={{ $product->price }} hidden >
                </form>
            </div>
        </div>
        <div class="product-images">
            <div class="product_image_slider" style="background-image:url({{ asset('/storage/images/products/'.$product->image) }})"></div>
            @forelse ($product->images as $image)
                <div class="product_image_slider" style="background-image:url({{ asset('/storage/images/products/'.$image->image) }})"></div>
            @empty
            
            @endforelse
        </div>    
        @else
        <h1 style="color: red">There's no such product</h1>
    @endif
</div>  

{{-- <div class="productpage-container">

            <div class="product-image">
                <img src="{{ asset('/storage/images/products/'.$product->image) }}" alt="product image">
            </div>
            <div class="product-info">
                <div class="inner-info">
                    <h1>{{ $product->name }}</h1>

                    <div class="price-quantity">
                        <p>Price: {{ $product->price }}</p>
                        <p>Quantity: {{ $product->quantity }}</p>
                    </div>
                    
                    <p class="description">{{ $product->description }}</p>   
                </div>
                <form action="" class="btn-input">
                    <button type="submit" class="btn">ADD TO CART</button>
                    <input type="number"  value = 0  min = 0 max = {{ $product->quantity }} >
                </form>
            </div>
        </div> --}}

        {{-- <div class="product-images">
            @forelse ($product->images as $image)
                <div class="product_image_slider" style="background-image:url({{ asset('/storage/images/products/'.$image->image) }})"></div>
            @empty
                
            @endforelse
        </div> --}}


        <script>
            $(document).ready(function(){
                let imgs = document.querySelectorAll('.product_image_slider');
                console.log(imgs);
                for(let i=0;i<imgs.length;i++){
                    // alert("ll");
                    imgs[i].addEventListener('click',function(e){
                        // e.target.style.backgroundImage.substring(3,e.target.style.backgroundImage.length-1);
                        // alert(e.target.style.backgroundImage.substring(5,e.target.style.backgroundImage.length-2));
                        console.log(e.target);
                        document.querySelector('#show').src = e.target.style.backgroundImage.substring(5,e.target.style.backgroundImage.length-2);
                    });
                }
            });
        </script>
@endsection