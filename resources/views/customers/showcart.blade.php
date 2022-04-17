@extends('layouts/head')
@section('content')
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
@if($products->count()>0)
<div class="products">
        <div class="product exc">
            <h3></h3>  
            <div></div> 
            <h3>Unit price</h3>
            <h3>Quantity</h3>
            <h3>Sub total</h3>
        </div>
    @endif
        <br>
        <div class="main-container">

            @forelse ($products as $product)
                <div class="product">
                    <img src="{{ asset('/storage/images/products/' . $product->image) }}" alt="" style="width : 200px; border-radius:50%">
                    <div style="width: 100px">
                        <h1 style="color: darkcyan">{{ $product->name }}</h1>
                    </div>
                    <p class="price{{ $loop->iteration }} price" id="{{ $product->price }}">{{ $product->price }}$</p>
                    <div class="number-button" >
                        <input type="text" name=""  value="{{ $product->id }}" class="product_id{{ $loop->iteration }}" hidden>
                        <input type="text" name=""  value="{{ Auth::user()->id }}"  class="user_id{{ $loop->iteration }}" hidden>
                        <input type="number" value={{ $product->quantity }} class='product_quantity' hidden>
                        <input type="number" value={{ $product->cartQuantity }} id="product{{ $loop->iteration }}" class="cart_quantity product select" style="width:100px" name='quantity' max = {{ $product->quantity }} min=1>
                    </div>
                    <h2 style="color : red" class="sub_total{{ $loop->iteration }}">{{ $product->price * $product->cartQuantity }}$</h2>
                    <a href="/customers/deleteFromCart/{{ $product->id }}" class="btn delete">delete</a>
                </div>
                @empty
                <h1 class="error-msg">Cart's empty</h1>
                @endforelse
                @if($products->count()>0)
                 <h1 class="total" style="color:red"></h1>
                <div class="checkout-container">
                    <a href="/customers/checkout" class="btn" >Check Out</a>
                </div>
                @endif
            </div>
        </div>

<script src="{{ asset('js/main.js') }}"></script>

@endsection