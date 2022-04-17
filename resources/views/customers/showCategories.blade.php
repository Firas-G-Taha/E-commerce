@extends('layouts/head')
@section('content')
<div class="main-container">
    @forelse ($categories as $category)
            <div class="second-container">
                    <a href="/category/{{ $category->id }} " style="width:50%">
                    <img
                    class="qw"
                    style="width:100%"
                    src="{{asset('/storage/images/categories/'.$category->image)}}"
                    alt="category image">
    
                    </a>
              
                <div class="category-text">
                    <h1>{{ $category->title }}</h1>
                    <p>{{ $category->description }}</p>
                </div>
            </div>
    @empty
        <h1 style="color:red">THERE IS NO CATEGORIES</h1>
    @endforelse
</div>

@endsection