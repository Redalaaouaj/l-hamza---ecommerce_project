@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 m-2 text-sm font-normal bg-green-500 border text-emerald-100 rounded-xl border-emerald-600" role="alert">
  <span class="mr-2 font-semibold">{{session('success')}}</span>
</div>
@endif

<a class="inline-flex items-center px-4 py-2 m-5 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-800 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{route('products.create')}}">New product</a>

<h2 class="mx-7 underline font-bold text-[20px]">Products list:</h2>
<div class="border border-gray-700 rounded-lg m-7">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full text-sm bg-gray-200 divide-y-2 divide-gray-700">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">#</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Title</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Description</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Category</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Images</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Quantity</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Price</th>
          <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Actions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-700">
        @forelse($products as $i=>$product)
        <tr class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
          <td class="px-4 py-2 m-4 whitespace-nowrap">{{$i+1}}</td>
          <td class="px-4 py-2 whitespace-nowrap">{{$product->title}}</td>
          <td class="max-w-xs px-4 py-2 overflow-hidden whitespace-nowrap text-ellipsis">{{$product->description}}</td>
          <td class="px-4 py-2 whitespace-nowrap">{{$product->category->name}}</td>
          <td class="px-4 py-2 whitespace-nowrap">
            @foreach ($product->images as $image)
            <img width="100px" src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image">
            @endforeach
          </td>
          <td class="px-4 py-2 whitespace-nowrap">{{$product->quantity}}</td>
          <td class="px-4 py-2 whitespace-nowrap">{{$product->price}}</td>
          <td class="px-4 py-2 whitespace-nowrap">
            <a href="{{route('products.edit',$product->id)}}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-500 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>
            <form action="{{route('products.destroy',$product->id)}}" method="post" class="inline">
              @csrf
              @method('delete')
              <x-primary-button class="bg-red-600 hover:bg-red-500 focus:bg-red-700 active:bg-red-900">
                Delete
              </x-primary-button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">No products</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>


</div>

{{$products->links()}}
@endsection