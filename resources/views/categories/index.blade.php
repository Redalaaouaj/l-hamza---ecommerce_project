@extends('layouts.app')
@section('content')


<h2 class="m-7 underline font-bold text-[20px]">Categories:</h2>
<div class="flex justify-evenly">

  <div class="rounded m-7">
    <div class="overflow-x-auto rounded-t-lg">
      <table class="w-20 divide-y-2 divide-gray-700 bg-gray-200 text-sm">
        <thead class="ltr:text-left rtl:text-right">
          <tr>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">#</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-700">
          @foreach($categories as $i=>$category)
          <tr class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            <td class="whitespace-nowrap px-4 py-2 text-center">{{$i+1}}</td>
            <td class="whitespace-nowrap px-4 py-2 text-center">{{$category->name}}</td>
            <td class="whitespace-nowrap px-4 py-2 text-center">
              <form action="{{route('categories.destroy',$category->id)}}" method="post" class="inline">
                @csrf
                @method('delete')
                <x-primary-button class="bg-red-600 hover:bg-red-500 focus:bg-red-700 active:bg-red-900">
                  Delete
                </x-primary-button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>

  <div class="max-w-screen-xl px-4 py-6 sm:px-6 lg:px-8">
    <form action="{{route('categories.store')}}" class="mb-0 max-w-md space-y-4" method="post">
      @csrf
      <div>
        <label for="name" class="text-gray-900">Add new category:</label>

        <div class="relative">
          <input type="text" name="name" id="name" class="my-2 rounded border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter category" value="{{old('name')}}" />
        </div>
        @error('name') <span class="text-red-600">{{$message}}</span> @enderror

        <x-primary-button>
          Save
        </x-primary-button>
    </form>
  </div>
</div>
@endsection