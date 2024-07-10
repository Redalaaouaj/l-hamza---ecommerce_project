@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 m-2 text-sm font-normal bg-green-500 border text-emerald-100 rounded-xl border-emerald-600" role="alert">
  <span class="mr-2 font-semibold">{{session('success')}}</span>
</div>
@endif

<div class="max-w-2xl mx-auto">

  <div id="default-carousel" class="relative" data-carousel="static">

    <div class="relative h-56 my-3 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">

      <div class="duration-700 ease-in-out " data-carousel-item>
        <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl ">Primer Slide</span>
        <img src="{{asset('/banner1.jpg')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>

      <div class="duration-700 ease-in-out " data-carousel-item>
        <img src="{{asset('/banner2.jpg')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>

      <div class="duration-700 ease-in-out " data-carousel-item>
        <img src="{{asset('/banner3.jpg')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>
    </div>


    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>

    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span class="hidden">Anterior</span>
      </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 0 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="hidden">Siguiente</span>
      </span>
    </button>
  </div>
  <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</div>

<!-- <div class="grid w-full h-24 my-5 bg-stone-100">
  <div>
    <label for="">Categories</label>
    <input type="checkbox">
  </div>

</div> -->


<div class="m-12">
<h3 class="w-full rounded-md bg-orange-600 px-5 py-2.5 text-center text-xl font-bold text-white">Last Products</h3>
  <div class="grid gap-4 md:grid-cols-4 ">
    <div class="flex flex-col w-full max-w-xs h-96 mt-16 p-5 overflow-hidden bg-orange-300 borderborder-gray-100 rounded-xl shadow-md group">
      @php
      $categoriesIds = request()->input('categories') ?? [];
      @endphp
      <form>
      <h3 class="font-semibold mb-3">Filter By Category:</h3>
      @foreach($categories as $category)
      <div class="flex items-center mb-2">
        <input @checked(in_array($category->id, $categoriesIds)) type="checkbox" name="categories[]"
        value="{{$category->id}}" class="form-checkbox h-4 w-4 text-orange-600 focus:outline-none focus:ring-1 focus:ring-orange-600 transition duration-150 ease-in-out">
        <label class="ml-2 text-gray-900">{{$category->name}}</label>
      </div>
      @endforeach
      <h3 class="font-semibold my-2">Pricing:</h3>
      <div class="flex items-center flex-col">
        <div>
          <label for="min">Min:</label>
          <input type="number" min="{{$prices['minPrice']}}" max="{{$prices['maxPrice']}}" value="{{request()->input('min')}}" name="min" id="min" class="rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-600 transition duration-150 ease-in-out"/>
        </div>
        <div>
          <label for="max">Max:</label>
          <input type="number" min="{{$prices['minPrice']}}" max="{{$prices['maxPrice']}}" value="{{request()->input('max')}}" name="max" id="max" class="rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-600 transition duration-150 ease-in-out">
        </div>
      </div>
      <div class="flex items-center m-2">
      <x-primary-button type="submit" class="bg-blue-700 hover:bg-blue-600 focus:bg-blue-800 active:bg-blue-600" >Filter</x-primary-button>
      <a type="reset" class="inline-flex items-center px-4 py-2 m-2 text-xs font-semibold bg-slate-50 rounded-lg" href="{{route('store')}}">RESET</a>
      </div>
      </form>

    </div>

    @forelse($products as $product)
    <div class="flex flex-col w-full max-w-xs my-10 overflow-hidden bg-white borderborder-gray-100 rounded-lg shadow-md group">
      <a class="relative flex mx-3 mt-3 overflow-hidden h-60 rounded-xl" href="#">
        <img class="absolute top-0 right-0 object-cover w-full h-full peer" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="product image" />
        <img class="absolute top-0 object-cover w-full h-full transition-all duration-1000 delay-100 peer -right-96 hover:right-0 peer-hover:right-0" src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" alt="product image" />
        <svg class="absolute inset-x-0 mx-auto text-3xl text-white transition-opacity pointer-events-none bottom-5 group-hover:animate-ping group-hover:opacity-30 peer-hover:opacity-0" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
          <path fill="currentColor" d="M2 10a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v10a4 4 0 0 1-2.328 3.635a2.996 2.996 0 0 0-.55-.756l-8-8A3 3 0 0 0 14 17v7H6a4 4 0 0 1-4-4V10Zm14 19a1 1 0 0 0 1.8.6l2.7-3.6H25a1 1 0 0 0 .707-1.707l-8-8A1 1 0 0 0 16 17v12Z" />
        </svg>
        <!-- <span class="absolute top-0 left-0 px-2 m-2 text-sm font-medium text-center text-white bg-black rounded-full">39% OFF</span> -->
      </a>
      <div class="px-5 pb-5 mt-4">
        <a href="#">
          <h5 class="text-xl tracking-tight text-slate-900">{{$product->title}}</h5>
        </a>
        <div class="flex items-center justify-between mt-2 mb-5">
          <p>
            <span class="text-3xl font-bold text-slate-900">{{$product->price}} MAD</span>
            <span class="text-sm line-through text-red-600">{{$product->price + 100}}</span>
          </p>
        </div>
        <a href="#" class="flex items-center justify-center rounded-md bg-orange-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-orange-500 focus:outline-none focus:ring-4 focus:ring-orange-100">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          Add to cart</a>
      </div>
    </div>

    <!-- <div class="col">
      <div class="flex flex-col h-full overflow-hidden bg-white rounded-lg shadow-md">
        @if($product->images->isNotEmpty())
        <img class="object-cover w-full h-52" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="Product Image">
        @endif
        <div class="flex-grow p-4">
          <h5 class="mb-2 text-xl font-semibold">{{$product->title}}</h5>
          <p class="text-gray-700">{!! $product->description !!}</p>
          <hr class="my-4">
          <div class="flex items-center justify-between">
            <span>Quantity: <span class="inline-block px-2 text-sm text-white bg-green-500 rounded">{{$product->quantity}}</span></span>
            <span>Price: <span class="inline-block px-2 text-sm text-white bg-blue-500 rounded">{{$product->price}} MAD</span></span>
          </div>
          <hr class="my-4">
          <div class="my-2">
            Category: <span class="inline-block px-2 text-sm text-white bg-blue-500 rounded">{{$product->category?->name}}</span>
          </div>
        </div>
        <div class="p-4 bg-gray-100">
          <small class="text-gray-500">{{$product->created_at->diffForhumans()}}</small>
        </div>
      </div>
    </div> -->
    @empty
    <div class="w-full my-4 alert alert-info" role="alert">
      <h4>
        <strong>Info:</strong> No Products
      </h4>
    </div>
    @endforelse

    <span></span>
  </div>
</div>


@endsection