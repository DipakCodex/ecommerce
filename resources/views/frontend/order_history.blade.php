<x-frontend-layout>
    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium">Order History</span>
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

    <!-- ===== ORDER HISTORY ===== -->
    <section class="py-8">
        <div class="container">
            <h1 class="text-3xl md:text-4xl font-bold text-[var(--text-dark)] mb-8">
                Order History
                <span class="text-lg font-normal text-[var(--text-muted)] ml-3">
                    ({{ $orders->count() }} {{ $orders->count() === 1 ? 'order' : 'orders' }})
                </span>
            </h1>

            @if ($orders->count() > 0)
                <!-- Orders List -->
                @foreach ($orders as $order)
                    <div class="mb-8">
                        <!-- Order Header -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 mb-4">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-shopping-bag text-xl text-[var(--primary)]"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-[var(--text-dark)]">
                                            Order #{{ $order->id }}
                                        </h2>
                                        <p class="text-sm text-[var(--text-muted)]">
                                            {{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    @if($order->payment_status == 'Completed')
                                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                            Paid
                                        </span>
                                    @elseif($order->payment_status == 'Pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                            Pending
                                        </span>
                                    @elseif($order->payment_status == 'Failed')
                                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                            Failed
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
                                            {{ $order->payment_status ?? 'Processing' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        @if($order->orderItems && $order->orderItems->count() > 0)
                            <div class="space-y-4">
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $itemTotal = $item->qty * $item->amount;
                                    @endphp
                                    <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6">
                                        <div class="flex flex-col sm:flex-row gap-6">
                                            <!-- Product Image -->
                                            <div class="w-full sm:w-32 h-32 flex-shrink-0">
                                                @php
                                                    $imagePath = null;
                                                    if($item->product && $item->product->images) {
                                                        $imagePath = is_array($item->product->images) ? $item->product->images[0] : $item->product->images;
                                                    }
                                                @endphp
                                                @if($imagePath)
                                                    <img src="{{ asset(Storage::url($imagePath)) }}" alt="{{ $item->product->name ?? 'Product' }}"
                                                        class="w-full h-full object-cover rounded-xl">
                                                @else
                                                    <div class="w-full h-full bg-gray-100 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-image text-3xl text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h3 class="font-semibold text-lg mb-1">
                                                            @if($item->product)
                                                                <a href="{{ route('product.show', $item->product_id) }}"
                                                                    class="hover:text-[var(--primary)]">
                                                                    {{ $item->product->name }}
                                                                </a>
                                                            @else
                                                                <span class="text-[var(--text-muted)]">Product #{{ $item->product_id }}</span>
                                                            @endif
                                                        </h3>
                                                    </div>
                                                </div>

                                                <!-- Quantity & Price -->
                                                <div class="flex items-baseline gap-2 mb-3">
                                                    <span class="text-sm text-[var(--text-muted)]">
                                                        Qty: {{ $item->qty }}
                                                    </span>
                                                    <span class="text-sm text-[var(--text-muted)]">×</span>
                                                    <span class="text-xl font-bold text-[var(--text-dark)]">
                                                        Rs. {{ number_format($item->amount, 2) }}
                                                    </span>
                                                </div>

                                                <!-- Item Total -->
                                                <div class="flex items-center gap-4">
                                                    <div class="ml-auto text-right">
                                                        <p class="text-sm text-[var(--text-muted)]">Item Total</p>
                                                        <p class="text-lg font-bold text-[var(--primary)]">
                                                            Rs. {{ number_format($itemTotal, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- No Items Message -->
                            <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 text-center">
                                <p class="text-[var(--text-muted)]">No items found for this order.</p>
                            </div>
                        @endif

                        <!-- Order Summary -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 mt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">Order Summary for Order #{{ $order->id }}</h3>
                                    <div class="space-y-2 mt-3">
                                        <div class="flex justify-between text-[var(--text-soft)]">
                                            <span>Total Items</span>
                                            <span>{{ $order->orderItems ? $order->orderItems->sum('qty') : 0 }}</span>
                                        </div>
                                        <div class="flex justify-between text-[var(--text-soft)]">
                                            <span>Payment Status</span>
                                            <span class="{{ $order->payment_status == 'Completed' ? 'text-green-600 font-semibold' : 'text-yellow-600 font-semibold' }}">
                                                {{ $order->payment_status ?? 'Processing' }}
                                            </span>
                                        </div>
                                        <div class="border-t border-[var(--border-light)] pt-2 flex justify-between font-bold">
                                            <span>Total Amount</span>
                                            <span class="text-[var(--primary)]">Rs. {{ number_format($order->total_amount, 2) }}</span>
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
                <!-- Empty Order History -->
                <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-12 text-center">
                    <div
                        class="w-24 h-24 bg-[var(--bg-warm)] rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shopping-bag text-4xl text-[var(--text-muted)]"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-3">No orders yet</h2>
                    <p class="text-[var(--text-muted)] mb-8">Looks like you haven't placed any orders yet.</p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 bg-[var(--primary)] text-white px-8 py-3 rounded-xl font-semibold hover:bg-[var(--primary-dark)] transition-all">
                        <i class="fas fa-arrow-left"></i>
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </section>

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