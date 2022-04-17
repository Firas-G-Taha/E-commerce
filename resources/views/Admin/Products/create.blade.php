@extends('layouts/adminHead')
@section('content')
    <div class="form-main-container">

        <form action="/admin/products" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-container scale-09 ">
                <h1 class="title">Create Product</h1>
                <hr>
                <input
                type="file"
                class="input-image"
                name="image">

                <input
                type="text"
                class="input-text"
                name="name"
                placeholder="product name...">
                
                <textarea 
                style="height: 100px"
                class="text-input"
                name="description"
                cols="30"
                rows="10"
                placeholder="description . . ."></textarea>

                <input
                type="text"
                class="input-text"
                name="price"
                placeholder="price...">
                
                <input
                type="text"
                class="input-text"
                name="quantity"
                placeholder="Quantity...">
               <div class="flex-row">
                <div class="is-featured">
                    <label for="available">available</label>
                    <input
                    type="checkbox"
                    name="available">
                </div>

               <div class="is-featured">
                   <label for="featured">featured</label>
                   <input
                   type="checkbox"
                   name="featured">
               </div>
               </div> 
                <select name="category_id" class="category-selector select" id="category">          
                @forelse ($categories as $category)
                {{---------------------image----------------------}}
                <option value="{{ $category->id }}" >{{ $category->title }}</option>
                @empty
                <option value="#">No Categories</option>
                @endforelse  
                </select>
                <select name="sub_category_id" id="sub_category" class="select ">          
                @forelse ($subCategories as $subCategory)
                {{---------------------image----------------------}}
                <option value="{{ $subCategory->id }}" >{{ $subCategory->title }}</option>
                @empty
                <option value="#">No Sub Categories</option>
                @endforelse  
                </select>
                 <button
                 class="btn"
                type="submit" class="">
                Submit
                </button>
            
            </form>
    </div>
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
        
        <script src="{{ asset('js/products.js') }}"></script>
@endsection