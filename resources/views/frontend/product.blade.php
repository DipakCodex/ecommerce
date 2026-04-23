<x-frontend-layout>
    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <a href="#" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    {{ $product->category ?? 'Products' }}
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium truncate">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <!-- ===== SUCCESS FLASH MESSAGE ===== -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition class="bg-[var(--success)]/10 border border-[var(--success)] text-[var(--success)] px-4 py-3 rounded-lg mb-4">
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

    <!-- ===== PRODUCT DETAILS ===== -->
    <section class="py-8">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-10">
                <!-- Left: Product Images -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-[var(--border-light)]">
                        <img src="{{ asset(Storage::url($product->images[0])) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-[400px] object-cover"
                             id="mainImage">
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if(count($product->images) > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($product->images as $index => $image)
                        <div class="bg-white rounded-xl overflow-hidden shadow-md border-2 cursor-pointer thumbnail-container
                                   {{ $index === 0 ? 'border-[var(--primary)]' : 'border-transparent hover:border-[var(--primary)]' }}"
                             onclick="changeMainImage('{{ asset(Storage::url($image)) }}', this)">
                            <img src="{{ asset(Storage::url($image)) }}"
                                 alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                 class="w-full h-20 object-cover">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right: Product Info -->
                <!-- Wrap price and actions in Alpine for reactive quantity/total -->
                <div x-data="{
                    quantity: 1,
                    unitPrice: {{ $product->discount > 0 ? ($product->price - ($product->discount * $product->price) / 100) : $product->price }},
                    originalPrice: {{ $product->price }},
                    discountPercent: {{ $product->discount ?? 0 }},
                    get totalPrice() {
                        return this.quantity * this.unitPrice;
                    },
                    get totalSaved() {
                        return this.quantity * (this.originalPrice - this.unitPrice);
                    }
                }" class="space-y-6">
                    <!-- Product Title & Brand -->
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-[var(--text-dark)] mb-2">
                            {{ $product->name }}
                        </h1>
                        <div class="flex items-center gap-3">
                            <a href="#" class="text-[var(--primary)] font-semibold hover:underline">
                                <i class="fas fa-store mr-1"></i>{{ $product->dokan->name }}
                            </a>
                            <span class="text-[var(--text-muted)]">|</span>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                <span class="text-sm text-[var(--text-muted)] ml-1">(4.5k reviews)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Section with Dynamic Total -->
                    <div class="bg-[var(--bg-warm)] p-6 rounded-2xl">
                        <div class="flex items-baseline gap-3 mb-3">
                            @if($product->discount > 0)
                                <span class="text-4xl font-bold text-[var(--text-dark)]">
                                    Rs. <span x-text="unitPrice.toFixed(2)"></span>
                                </span>
                                <span class="text-xl text-[var(--text-muted)] line-through">
                                    Rs. <span x-text="originalPrice.toFixed(2)"></span>
                                </span>
                                <span class="bg-[var(--danger)] text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $product->discount }}% OFF
                                </span>
                            @else
                                <span class="text-4xl font-bold text-[var(--text-dark)]">
                                    Rs. <span x-text="unitPrice.toFixed(2)"></span>
                                </span>
                            @endif
                        </div>

                        @if($product->discount > 0)
                        <p class="text-[var(--success)] text-sm font-semibold mb-3">
                            <i class="fas fa-tag mr-1"></i>
                            You save: Rs. <span x-text="totalSaved.toFixed(2)"></span>
                        </p>
                        @endif

                        <!-- Dynamic Total Price -->
                        <div class="mt-4 pt-4 border-t border-[var(--border-light)]">
                            <div class="flex items-baseline justify-between">
                                <span class="text-lg font-semibold">Total Price:</span>
                                <span class="text-3xl font-bold text-[var(--primary)]">
                                    Rs. <span x-text="totalPrice.toFixed(2)"></span>
                                </span>
                            </div>
                            <p class="text-[var(--text-soft)] text-sm mt-1">
                                <i class="fas fa-check-circle text-[var(--success)] mr-1"></i>
                                Inclusive of all taxes
                            </p>
                        </div>
                    </div>

                    <!-- Key Features -->
                    <div class="space-y-3">
                        <h3 class="font-semibold text-lg">Key Features</h3>
                        <ul class="grid grid-cols-2 gap-3">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-[var(--primary)]"></i>
                                <span class="text-[var(--text-soft)]">Free Delivery</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-[var(--primary)]"></i>
                                <span class="text-[var(--text-soft)]">1 Year Warranty</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-[var(--primary)]"></i>
                                <span class="text-[var(--text-soft)]">Easy Returns</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-[var(--primary)]"></i>
                                <span class="text-[var(--text-soft)]">Cash on Delivery</span>
                            </li>
                        </ul>
                    </div>

                    <!-- ===== ACTION BUTTONS WITH QUANTITY & CART FORM ===== -->
                    <div class="space-y-4">
                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4">
                            <span class="text-[var(--text-soft)] font-medium">Quantity:</span>
                            <div class="flex items-center border border-[var(--border-light)] rounded-xl overflow-hidden">
                                <button type="button"
                                        @click="quantity = Math.max(1, quantity - 1)"
                                        class="w-10 h-10 flex items-center justify-center text-[var(--text-muted)] hover:bg-[var(--bg-warm)] transition">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" x-model="quantity" min="1" value="1"
                                       class="w-16 h-10 text-center border-x border-[var(--border-light)] focus:outline-none"
                                       readonly>
                                <button type="button"
                                        @click="quantity++"
                                        class="w-10 h-10 flex items-center justify-center text-[var(--text-muted)] hover:bg-[var(--bg-warm)] transition">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <span class="text-sm text-[var(--text-muted)]">
                                <span x-text="quantity"></span> item(s)
                            </span>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.store') }}" method="POST" class="flex gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" x-model="quantity">

                            <button type="submit"
                                    class="flex-1 bg-[var(--primary)] text-white px-6 py-4 rounded-xl font-semibold hover:bg-[var(--primary-dark)] shadow-lg transition-all">
                                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                            </button>
                        </form>


                        <!-- Buy Now Form -->
                        <form action="{{ route('checkout.direct') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" x-model="quantity">
                            <button type="submit"
                                    class="w-full border-2 border-[var(--primary)] text-[var(--primary)] px-6 py-4 rounded-xl font-semibold hover:bg-[var(--primary)] hover:text-white transition-all">
                                <i class="fas fa-bolt mr-2"></i>Buy Now
                            </button>
                        </form>
                    </div>

                    <!-- Share & Wishlist -->
                    <div class="flex gap-4 pt-4 border-t border-[var(--border-light)]">
                        <button class="flex items-center gap-2 text-[var(--text-soft)] hover:text-[var(--danger)] transition-colors">
                            <i class="far fa-heart"></i>
                            <span>Add to Wishlist</span>
                        </button>
                        <button class="flex items-center gap-2 text-[var(--text-soft)] hover:text-[var(--primary)] transition-colors">
                            <i class="fas fa-share-alt"></i>
                            <span>Share Product</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== PRODUCT DESCRIPTION & SPECIFICATIONS ===== -->
    <section class="py-8 bg-white">
        <div class="container">
            <div class="border-b border-[var(--border-light)] mb-6">
                <div class="flex gap-8">
                    <button class="tab-button active px-2 py-4 font-semibold text-[var(--primary)] border-b-2 border-[var(--primary)]"
                            onclick="switchTab('description')">
                        Description
                    </button>
                    <button class="tab-button px-2 py-4 font-semibold text-[var(--text-muted)] hover:text-[var(--primary)]"
                            onclick="switchTab('specifications')">
                        Specifications
                    </button>
                    <button class="tab-button px-2 py-4 font-semibold text-[var(--text-muted)] hover:text-[var(--primary)]"
                            onclick="switchTab('reviews')">
                        Reviews (4.5k)
                    </button>
                </div>
            </div>

            <!-- Description Tab -->
            <div id="description-tab" class="tab-content">
                <div class="prose max-w-none">
                    <p class="text-[var(--text-soft)] leading-relaxed">
                        {!! $product->description !!}
                    </p>
                </div>
            </div>

            <!-- Specifications Tab -->
            <div id="specifications-tab" class="tab-content hidden">
                <div class="bg-[var(--bg-warm)] rounded-2xl p-6">
                    <table class="w-full">
                        <tbody class="divide-y divide-[var(--border-light)]">
                            <tr>
                                <td class="py-3 font-semibold w-1/3">Brand</td>
                                <td class="py-3 text-[var(--text-soft)]">{{ $product->dokan->name }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold">Category</td>
                                <td class="py-3 text-[var(--text-soft)]">{{ $product->category ?? 'General' }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold">SKU</td>
                                <td class="py-3 text-[var(--text-soft)]">DP-{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold">Warranty</td>
                                <td class="py-3 text-[var(--text-soft)]">1 Year Manufacturer Warranty</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold">Country of Origin</td>
                                <td class="py-3 text-[var(--text-soft)]">India</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews-tab" class="tab-content hidden">
                <div class="space-y-6">
                    <!-- Rating Summary -->
                    <div class="bg-[var(--bg-warm)] rounded-2xl p-6">
                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-[var(--text-dark)] mb-2">4.5</div>
                                <div class="flex items-center gap-1 justify-center mb-1">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                </div>
                                <p class="text-sm text-[var(--text-muted)]">Based on 4,521 reviews</p>
                            </div>
                            <div class="flex-1">
                                <!-- Rating bars would go here -->
                                <p class="text-[var(--text-soft)]">95% of buyers recommend this product</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Reviews -->
                    <div class="space-y-4">
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[var(--border-light)]">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-[var(--primary)]/10 rounded-full flex items-center justify-center">
                                    <span class="font-bold text-[var(--primary)]">JD</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold">John Doe</h4>
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    </div>
                                </div>
                                <span class="ml-auto text-sm text-[var(--text-muted)]">2 days ago</span>
                            </div>
                            <p class="text-[var(--text-soft)]">Excellent product! Exactly as described. Fast delivery and great packaging.</p>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[var(--border-light)]">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-[var(--secondary)]/10 rounded-full flex items-center justify-center">
                                    <span class="font-bold text-[var(--secondary)]">SP</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Sarah Parker</h4>
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="far fa-star text-yellow-400 text-xs"></i>
                                    </div>
                                </div>
                                <span class="ml-auto text-sm text-[var(--text-muted)]">1 week ago</span>
                            </div>
                            <p class="text-[var(--text-soft)]">Good quality for the price. Would recommend to others looking for value.</p>
                        </div>
                    </div>

                    <button class="w-full border-2 border-[var(--primary)] text-[var(--primary)] px-6 py-3 rounded-xl font-semibold hover:bg-[var(--primary)] hover:text-white transition-all">
                        Load More Reviews
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== RELATED PRODUCTS ===== -->
    <section class="py-12 bg-[var(--bg-warm)]">
        <div class="container">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">You May Also Like</h2>
                <a href="#" class="text-[var(--primary)] font-semibold hover:underline">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 0; $i < 4; $i++)
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden border border-[var(--border-light)]">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=300&h=200&fit=crop"
                             alt="Related Product">
                        <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-[var(--danger)] hover:text-white">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1">Similar Product {{ $i + 1 }}</h3>
                        <p class="text-[var(--text-muted)] text-sm mb-3">Trusted Seller</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-[var(--text-dark)]">Rs. 1,299</span>
                            <button class="bg-[var(--primary)] text-white px-4 py-2 rounded-lg text-sm hover:bg-[var(--primary-dark)]">
                                View
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
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

<script>
    // Image gallery switcher
    function changeMainImage(imageSrc, element) {
        document.getElementById('mainImage').src = imageSrc;

        // Update active thumbnail styling
        document.querySelectorAll('.thumbnail-container').forEach(container => {
            container.classList.remove('border-[var(--primary)]');
            container.classList.add('border-transparent');
        });
        element.classList.remove('border-transparent');
        element.classList.add('border-[var(--primary)]');
    }

    // Tab switcher
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Remove active state from all buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active', 'text-[var(--primary)]', 'border-b-2', 'border-[var(--primary)]');
            button.classList.add('text-[var(--text-muted)]');
        });

        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');

        // Add active state to clicked button
        event.target.classList.add('active', 'text-[var(--primary)]', 'border-b-2', 'border-[var(--primary)]');
        event.target.classList.remove('text-[var(--text-muted)]');
    }
</script>

<!-- Alpine.js for Quantity Selector & Dynamic Total & Flash Dismiss -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .tab-button.active {
        color: var(--primary);
        border-bottom-width: 2px;
        border-color: var(--primary);
    }

    .prose {
        max-width: 100%;
    }
</style>
