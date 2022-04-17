<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->desc }}</h2>
    <h2>{{ $product->price }}</h2>
    <h2>{{ $product->quantity }}</h2>
    <h2>{{ $product->available }}</h2>
    @forelse ($product->images as $image )
    {{-- @dd(asset('storage.images.products'. $image->image)) --}}
      <img src="{{ asset('storage/images/products/' . $image->image) }}" alt="">
      <form action="{{ asset('/products/deleteProductimage/' .$image->id) }}"  method="POST" class="pt-3">
        @csrf
        @method('delete')
        <button type="submit"
        class="border-b-2 pb-2 border-dotted italic text-red-500">
        Delete &rarr;</button>
    </form>
    @empty
    @endforelse

    <form action="{{ asset('/products/storeproductimages/' .$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input
        type="file"
        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
        name="image">
        <button type="submit">Submit</button>
    </form>

       
    <br>
    @if ($errors->any())
    <div class="w-4/8 m-auto text-center">
        @foreach ($errors->all() as $error)                   
        <li class="text-red-500 list-none">
                {{ $error }}
            </li>
        @endforeach
    </div>
    
@endif
</body>
</html>