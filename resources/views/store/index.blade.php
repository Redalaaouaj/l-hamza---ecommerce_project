@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 m-2 text-sm text-emerald-100 rounded-xl bg-green-500 border border-emerald-600 font-normal" role="alert">
  <span class="font-semibold mr-2">{{session('success')}}</span>
</div>
@endif

<div class="max-w-2xl mx-auto">

	<div id="default-carousel" class="relative" data-carousel="static">
     
        <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
           
            <div class=" duration-700 ease-in-out" data-carousel-item>
                <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl ">Primer Slide</span>
                <img src="{{asset('/banner3.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
           
            <div class=" duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('/banner2.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
           
            <div class=" duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('/banner1.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
        </div>
        
        
        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
       
        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden">Anterior</span>
            </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 0 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="hidden">Siguiente</span>
            </span>
        </button>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</div>


<div class="m-12">

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($products as $product)
    <div class="col">
      <div class="bg-white shadow-md rounded-lg overflow-hidden h-full flex flex-col">
        @if($product->images->isNotEmpty())
        <img class="object-cover h-52 w-full" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="Product Image">
        @endif
        <div class="p-4 flex-grow">
          <h5 class="text-xl font-semibold mb-2">{{$product->name}}</h5>
          <p class="text-gray-700">{!! $product->description !!}</p>
          <hr class="my-4">
          <div class="flex justify-between items-center">
            <span>Quantity: <span class="inline-block bg-green-500 text-white text-sm px-2 rounded">{{$product->quantity}}</span></span>
            <span>Price: <span class="inline-block bg-blue-500 text-white text-sm px-2 rounded">{{$product->price}} MAD</span></span>
          </div>
          <hr class="my-4">
          <div class="my-2">
            Category: <span class="inline-block bg-blue-500 text-white text-sm px-2 rounded">{{$product->category?->name}}</span>
          </div>
        </div>
        <div class="p-4 bg-gray-100">
          <small class="text-gray-500">{{$product->created_at->diffForhumans()}}</small>
        </div>
      </div>
    </div>
    @empty
    <div class="alert alert-info my-4 w-full" role="alert">
      <h4>
        <strong>Info:</strong> No Products
      </h4>
    </div>
    @endforelse

    <span></span>
  </div>
</div>


@endsection