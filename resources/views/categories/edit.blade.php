@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-screen-xl px-4 py-6 sm:px-6 lg:px-8">
    <h2 class="underline">Add new product:</h2>
    <form action="{{route('products.update',$product->id)}}" class="mx-auto mb-0 mt-8 max-w-md space-y-4" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <label for="title" class="text-gray-900">Title</label>

            <div class="relative">
                <input type="text" name="title" id="title" class="w-full rounded border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter title" value="{{old('title',$product->title)}}" />
            </div>
            @error('title') <span class="text-red-600">{{$message}}</span> @enderror
        </div>
        <div>
            <label for="description" class="text-gray-900">Description</label>

            <div class="relative">
                <textarea name="description" id="description" class="w-full rounded border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter description">{{old('description',$product->description)}}
                </textarea>
            </div>
            @error('description') <span class="text-red-600">{{$message}}</span> @enderror
        </div>
        <div>
            <label for="images" class="text-gray-900">Upload images</label>

            <div class="relative">
                <input type="file" name="images[]" id="images" class="w-full p-3 text-sm text-gray-900  rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-white dark:border-gray-600 dark:placeholder-gray-400" multiple />
            </div>
            @error('images.*') <span class="text-red-600">{{$message}}</span> @enderror
        </div>
        @if($product->images)
        <div>
            <label>Existing Images:</label>
            @foreach ($product->images as $image)
            <div class="flex justify-center items-center">
                <img  src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" width="100">
                <label>
                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Delete
                </label>
            </div>
            @endforeach
        </div>
        @endif
        <div>
            <label for="quantity" class="text-gray-900">Quantity</label>

            <div class="relative">
                <input type="number" name="quantity" id="quantity" class="w-full rounded border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter quantity" value="{{old('quantity',$product->quantity)}}" />
            </div>
            @error('quantity') <span class="text-red-600">{{$message}}</span> @enderror
        </div>

        <div>
            <label for="price" class="text-gray-900">Price</label>

            <div class="relative">
                <input type="number" name="price" id="price" class="w-full rounded border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter price" value="{{old('price',$product->price)}}" />
            </div>
            @error('price') <span class="text-red-600">{{$message}}</span> @enderror
        </div>

        <x-primary-button>
            Update
        </x-primary-button>
        <a class="inline-flex items-center ml-2 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" href="{{route('products.index')}}">
            Retour
        </a>
    </form>
</div>

@endsection