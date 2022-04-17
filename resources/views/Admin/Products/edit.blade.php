@extends('layouts/adminHead')
@section('content')
    <form action="/admin/products/{{ $product->id }}" method="post" class="width100" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-main-container">

        <div class="form-container scale-09 ">
                <h1 class="title">Edit Product</h1>
                <hr>
                <h3><label for="image">Main image</label></h3>
                <input
                type="file"
                class="file-input"
                name="image">
                <h3><label for="images[]">Additional images</label></h3>
                <input
                type="file"
                class="file-input"
                multiple
                name="images[]">
                <input
                type="text"
                class="text-input"
                name="name"
                value={{ $product->name }}
                placeholder="product name...">
                
                {{-- <input
                type="text"
                class="text-input"
                value="{{ $product->description }}"
                name="description"
                placeholder="description name..."> --}}
                
                <textarea 
                style="height: 100px"
                class="text-input"
                name="description"
                cols="30"
                rows="10"
                placeholder="description . . .">{{ $product->description }}</textarea>
                <input
                type="text"
                class="text-input"
                name="price"
                value={{ $product->price }}
                placeholder="price...">
                
                <input
                type="text"
                class="text-input"
                name="quantity"
                value={{ $product->quantity }}
                placeholder="Quantity...">
               <div class="flex-row">
                <div class="is-featured">
                    <label for="available">available</label>
                    <input
                    type="checkbox" 
                    @if ($product->available)
                        checked
                    @endif
                    name="available">
                </div>

               <div class="is-featured">
                   <label for="featured">featured</label>
                   <input
                   type="checkbox" 
                   @if ($product->featured)
                       checked
                   @endif
                   name="featured">
               </div>
               </div> 
                <select name="category_id" class="select" id="category">          
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
                    {{-- <span class="btn" id="addImagebtn">Add new image</span> --}}
                 <button class="btn" type="submit">Submit</button>
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
