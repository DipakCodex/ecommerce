<x-frontend-layout>
    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium">Shopping Cart</span>
            </nav>
        </div>
    </section>

    <!-- ===== SUCCESS/ERROR FLASH MESSAGES ===== -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="bg-[var(--success)]/10 border border-[var(--success)] text-[var(--success)] px-4 py-3 rounded-lg">
            <div class="container flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-[var(--success)] hover:text-[var(--success)]/70">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="bg-[var(--danger)]/10 border border-[var(--danger)] text-[var(--danger)] px-4 py-3 rounded-lg">
            <div class="container flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-[var(--danger)] hover:text-[var(--danger)]/70">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- ===== SHOPPING CART ===== -->
    <section class="py-8">
        <div class="container">
            <h1 class="text-3xl md:text-4xl font-bold text-[var(--text-dark)] mb-8">
                Shopping Cart
                <span class="text-lg font-normal text-[var(--text-muted)] ml-3">
                    ({{ $cartCount }} {{ $cartCount === 1 ? 'item' : 'items' }})
                </span>
            </h1>

            @if ($cartCount > 0)
                <!-- Cart Groups by Dokan -->
                @foreach ($groups as $group)
                    <div class="mb-8">
                        <!-- Dokan Header -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-xl text-[var(--primary)]"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-[var(--text-dark)]">
                                            {{ $group['dokan']->name ?? 'Store' }}
                                        </h2>
                                        <p class="text-sm text-[var(--text-muted)]">
                                            {{ count($group['items']) }} {{ count($group['items']) === 1 ? 'item' : 'items' }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('checkout.dokan', $group['dokan']->id) }}"
                                    class="bg-[var(--primary)] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[var(--primary-dark)] transition-all">
                                    Checkout {{ $group['dokan']->name }}
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Cart Items for this Dokan -->
                        <div class="space-y-4">
                            @foreach ($group['items'] as $item)
                                <div x-data="{
                                    quantity: {{ $item->qty }},
                                    unitPrice: {{ $item->product->price - $item->product->discount }},
                                    originalPrice: {{ $item->product->price }},
                                    get itemTotal() {
                                        return this.quantity * this.unitPrice;
                                    },
                                    get itemSaved() {
                                        return this.quantity * (this.originalPrice - this.unitPrice);
                                    },
                                    async updateQuantity() {
                                        try {
                                            const response = await fetch('{{ route('cart.update', $item->product_id) }}', {
                                                method: 'PATCH',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    quantity: this.quantity
                                                })
                                            });

                                            if (response.ok) {
                                                window.location.reload();
                                            }
                                        } catch (error) {
                                            console.error('Error updating cart:', error);
                                        }
                                    }
                                }"
                                    class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6">
                                    <div class="flex flex-col sm:flex-row gap-6">
                                        <!-- Product Image -->
                                        <div class="w-full sm:w-32 h-32 flex-shrink-0">
                                            @php
                                                $imagePath = is_array($item->product->images) ? $item->product->images[0] : $item->product->images;
                                            @endphp
                                            <img src="{{ asset(Storage::url($imagePath)) }}" alt="{{ $item->product->name }}"
                                                class="w-full h-full object-cover rounded-xl">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="font-semibold text-lg mb-1">
                                                        <a href="{{ route('product.show', $item->product_id) }}"
                                                            class="hover:text-[var(--primary)]">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h3>
                                                </div>

                                                <!-- Remove Item -->
                                                <form action="{{ route('cart.remove', $item->product_id) }}"
                                                    method="POST" class="ml-4">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $item->product_id }}">
                                                    <button type="submit"
                                                        class="text-[var(--text-muted)] hover:text-[var(--danger)] transition-colors">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Price -->
                                            <div class="flex items-baseline gap-2 mb-3">
                                                <span class="text-xl font-bold text-[var(--text-dark)]">
                                                    Rs. <span x-text="unitPrice.toFixed(2)"></span>
                                                </span>
                                                @if ($item->product->discount > 0)
                                                    <span class="text-sm text-[var(--text-muted)] line-through">
                                                        Rs. <span x-text="originalPrice.toFixed(2)"></span>
                                                    </span>
                                                    <span class="text-xs font-semibold text-[var(--success)]">
                                                        {{ $item->product->discount }}% OFF
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Quantity & Total -->
                                            <div class="flex flex-wrap items-center gap-4">
                                                <!-- Quantity Selector -->
                                                <div
                                                    class="flex items-center border border-[var(--border-light)] rounded-lg overflow-hidden">
                                                    <button type="button"
                                                        @click="quantity = Math.max(1, quantity - 1); updateQuantity()"
                                                        class="w-8 h-8 flex items-center justify-center text-[var(--text-muted)] hover:bg-[var(--bg-warm)] transition">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <input type="number" x-model="quantity" min="1"
                                                        class="w-12 h-8 text-center border-x border-[var(--border-light)] focus:outline-none text-sm"
                                                        @change="updateQuantity()">
                                                    <button type="button" @click="quantity++; updateQuantity()"
                                                        class="w-8 h-8 flex items-center justify-center text-[var(--text-muted)] hover:bg-[var(--bg-warm)] transition">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>

                                                <!-- Item Total -->
                                                <div class="ml-auto text-right">
                                                    <p class="text-sm text-[var(--text-muted)]">Item Total</p>
                                                    <p class="text-lg font-bold text-[var(--primary)]">
                                                        Rs. <span x-text="itemTotal.toFixed(2)"></span>
                                                    </p>
                                                    @if ($item->product->discount > 0)
                                                        <p class="text-xs text-[var(--success)]">
                                                            Saved Rs. <span x-text="itemSaved.toFixed(2)"></span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Dokan Order Summary -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 mt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">Order Summary for {{ $group['dokan']->name }}</h3>
                                    <div class="space-y-2 mt-3">
                                        <div class="flex justify-between text-[var(--text-soft)]">
                                            <span>Subtotal</span>
                                            <span>Rs. {{ number_format($group['subtotal'], 2) }}</span>
                                        </div>
                                        @if ($group['discount'] > 0)
                                            <div class="flex justify-between text-[var(--success)]">
                                                <span>Discount</span>
                                                <span>- Rs. {{ number_format($group['discount'], 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="flex justify-between text-[var(--text-soft)]">
                                            <span>Delivery Fee</span>
                                            @if ($group['delivery_fee'] == 0)
                                                <span class="text-[var(--success)]">FREE</span>
                                            @else
                                                <span>Rs. {{ number_format($group['delivery_fee'], 2) }}</span>
                                            @endif
                                        </div>
                                        <div class="border-t border-[var(--border-light)] pt-2 flex justify-between font-bold">
                                            <span>Total</span>
                                            <span class="text-[var(--primary)]">Rs. {{ number_format($group['total'], 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Continue Shopping -->
                <div class="pt-4">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 text-[var(--primary)] hover:text-[var(--primary-dark)] font-medium">
                        <i class="fas fa-arrow-left"></i>
                        Continue Shopping
                    </a>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-12 text-center">
                    <div
                        class="w-24 h-24 bg-[var(--bg-warm)] rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shopping-cart text-4xl text-[var(--text-muted)]"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-3">Your cart is empty</h2>
                    <p class="text-[var(--text-muted)] mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 bg-[var(--primary)] text-white px-8 py-3 rounded-xl font-semibold hover:bg-[var(--primary-dark)] transition-all">
                        <i class="fas fa-arrow-left"></i>
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== RECOMMENDED PRODUCTS ===== -->
    @if ($cartCount > 0 && isset($recommendedProducts) && $recommendedProducts->count() > 0)
        <section class="py-12 bg-[var(--bg-warm)]">
            <div class="container">
                <h2 class="text-2xl font-bold mb-6">You Might Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($recommendedProducts as $product)
                        <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden border border-[var(--border-light)]">
                            <div class="relative">
                                @php
                                    $productImage = is_array($product->images) ? $product->images[0] : ($product->images ?? 'placeholder.jpg');
                                @endphp
                                <img src="{{ asset(Storage::url($productImage)) }}"
                                    alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @if ($product->discount > 0)
                                    <span class="absolute top-3 left-3 bg-[var(--danger)] text-white px-2 py-1 rounded-lg text-xs font-semibold">
                                        {{ $product->discount }}% OFF
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold mb-1 truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-[var(--text-muted)] mb-3">
                                    {{ $product->dokan->name ?? 'Seller' }}</p>
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if ($product->discount > 0)
                                            <span class="text-lg font-bold text-[var(--text-dark)]">
                                                Rs. {{ number_format($product->price - $product->discount, 2) }}
                                            </span>
                                            <span class="text-sm text-[var(--text-muted)] line-through ml-2">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </span>
                                        @else
                                            <span class="text-lg font-bold text-[var(--text-dark)]">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="bg-[var(--primary)] text-white w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[var(--primary-dark)] transition">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ===== TRUST BADGES ===== -->
    <section class="py-10 bg-white border-t border-[var(--border-light)]">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-truck text-2xl text-[var(--primary)]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Free Shipping</h4>
                        <p class="text-sm text-[var(--text-muted)]">On orders above ₹499</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-undo-alt text-2xl text-[var(--primary)]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Easy Returns</h4>
                        <p class="text-sm text-[var(--text-muted)]">7 days return policy</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-lock text-2xl text-[var(--primary)]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Secure Payment</h4>
                        <p class="text-sm text-[var(--text-muted)]">100% secure transactions</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-headset text-2xl text-[var(--primary)]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">24/7 Support</h4>
                        <p class="text-sm text-[var(--text-muted)]">Dedicated assistance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
