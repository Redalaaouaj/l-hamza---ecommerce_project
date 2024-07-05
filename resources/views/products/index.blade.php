@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="p-4 m-2 text-sm text-emerald-100 rounded-xl bg-green-500 border border-emerald-600 font-normal" role="alert">
  <span class="font-semibold mr-2">{{session('success')}}</span>
</div>
@endif

<a class="m-5 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{route('products.create')}}">New product</a>

<h2 class="mx-7 underline font-bold text-[20px]">Products list:</h2>
<div class="rounded-lg border border-gray-700 m-7">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full divide-y-2 divide-gray-700 bg-gray-200 text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">#</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Title</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Category</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Images</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Quantity</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Price</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Actions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-700">
        @forelse($products as $i=>$product)
        <tr class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          <td class="whitespace-nowrap px-4 py-2">{{$i+1}}</td>
          <td class="whitespace-nowrap px-4 py-2">{{$product->title}}</td>
          <td class="whitespace-nowrap px-4 py-2">{{$product->description}}</td>
          <td class="whitespace-nowrap px-4 py-2">{{$product->category->name}}</td>
          <td class="whitespace-nowrap px-4 py-2">
            @foreach ($product->images as $image)
            <img width="100px" src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image">
            @endforeach
          </td>
          <td class="whitespace-nowrap px-4 py-2">{{$product->quantity}}</td>
          <td class="whitespace-nowrap px-4 py-2">{{$product->price}}</td>
          <td class="whitespace-nowrap px-4 py-2">
            <a href="{{route('products.edit',$product->id)}}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
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