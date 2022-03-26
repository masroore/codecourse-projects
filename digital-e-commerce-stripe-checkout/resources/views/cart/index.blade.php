<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (optional(optional($cart)->products)->count())
                    @foreach ($cart->products as $product)
                        <div class="mb-4 pb-4 border-b">
                            <div class="font-semibold">{{ $product->title }}</div>

                            <div>@money($product->price)</div>

                            <form action="{{ route('cart.products.destroy', $product) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="text-indigo-500">Remove</button>
                            </form>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <div class="mb-2">Cart total: @money($cart->total())</div>
                        <x-link-button :href="route('checkout.index')">
                            Checkout
                        </x-link-button>
                    </div>
                @else
                    <p>Your cart is empty</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
