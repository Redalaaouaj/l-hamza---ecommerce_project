@extends('layouts.app')

@section('content')
<section class="h-screen py-12">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center">
      <h1 class="text-2xl font-semibold text-gray-900">Your Cart</h1>
    </div>
        <div class="mx-auto mt-8 max-w-2xl md:mt-12">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-6 sm:px-8 sm:py-10">
                    <div class="flow-root">
                        <ul class="-my-8">
                            @foreach($cartItems as $cartItem)
                            <li class="cart-item flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0" data-id="{{ $cartItem->id }}">
                                <div class="shrink-0">
                                    <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="{{ asset('storage/' . $cartItem->product->images->first()->image_path) }}" alt="product image" />
                                </div>
                                <div class="relative flex flex-1 flex-col justify-between">
                                    <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                        <div class="pr-8 sm:pr-5">
                                            <p class="mx-0 mt-6 text-base font-semibold text-gray-900">{{ $cartItem->product->title }}</p>
                                        </div>
                                        <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                            <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">{{ $cartItem->product->price }} MAD</p>
                                            <div class="sm:order-1">
                                                <div class="mx-auto flex h-8 items-stretch text-gray-600">
                                                    <button class="decrease-quantity flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-orange-500 hover:text-white" data-id="{{ $cartItem->id }}" data-quantity="-1">-</button>
                                                    <div class="quantity flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">{{ $cartItem->quantity }}</div>
                                                    <button class="increase-quantity flex items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-orange-500 hover:text-white" data-id="{{ $cartItem->id }}" data-quantity="1">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                        <button type="button" class="delete-item flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-orange-600" data-id="{{ $cartItem->id }}">
                                            <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-6 border-t border-b py-2">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-400">Subtotal</p>
                            <p class="subtotal text-lg font-semibold text-gray-900">{{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} MAD</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-400">Shipping</p>
                            <p class="shipping text-lg font-semibold text-gray-900">30.00 MAD</p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Total</p>
                        <p class="total text-2xl font-semibold text-gray-900"><span class="text-xs font-normal text-gray-400">MAD</span> {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 30 }}.00</p>
                    </div>
                    <div class="mt-6 text-center">
                        <button type="button" class="group inline-flex w-full items-center justify-center rounded-md bg-orange-600 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                            Place Order
                            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function updateCartItemCount() {
    fetch("{{ route('cart.itemCount') }}", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('cart-item-count').textContent = data.count;
    })
    .catch(error => console.error('Error:', error));
}

document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const quantity = parseInt(this.dataset.quantity);

        fetch("{{ route('cart.updateQuantity') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                this.closest('li').querySelector('.quantity').textContent = data.quantity;
                document.querySelector('.subtotal').textContent = data.subtotal + ' MAD';
                document.querySelector('.total').textContent = 'MAD ' + data.total + '.00';
                updateCartItemCount();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

document.querySelectorAll('.delete-item').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;

        fetch("{{ route('cart.deleteItem') }}", {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else if (data.success) {
                this.closest('li').remove();
                document.querySelector('.subtotal').textContent = data.subtotal + ' MAD';
                document.querySelector('.total').textContent = 'MAD ' + data.total + '.00';
                updateCartItemCount();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endsection
