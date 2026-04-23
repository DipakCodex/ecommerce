<x-frontend-layout>
    <!-- ===== PAGE HEADER ===== -->
    <section class="py-8 bg-gradient-to-r from-[var(--primary-light)]/10 via-[var(--accent-soft)]/20 to-[var(--primary-light)]/10">
        <div class="container">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[var(--text-dark)] mb-2">
                        All Products
                    </h1>
                    <p class="text-lg text-[var(--text-soft)]">Discover amazing products at great prices</p>
                </div>
                <div class="flex gap-3">
                    <span class="bg-white/50 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold text-[var(--text-dark)]">
                        <i class="fas fa-box mr-1"></i> {{ $products->count() }}+ Products
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium">All Products</span>
            </nav>
        </div>
    </section>

    <!-- ===== PRODUCTS LISTING SECTION ===== -->
    <section class="py-8">
        <div class="container">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- ===== SIDEBAR FILTERS ===== -->
                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[var(--border-light)] sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold">Filters</h3>
                            <a href="{{ route('products') }}" class="text-sm text-[var(--primary)] hover:underline">Clear All</a>
                        </div>

                        <form method="GET" action="{{ route('products') }}" id="filter-form">
                            <!-- Categories Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3 flex items-center justify-between">
                                    <span>Categories</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </h4>
                                <div class="space-y-2 max-h-60 overflow-y-auto">
                                    @php
                                        $categories = ['Electronics', 'Fashion', 'Furniture', 'Groceries', 'Sports', 'Books', 'Beauty', 'Toys'];
                                        $selectedCategories = request('categories', []);
                                    @endphp
                                    @foreach($categories as $category)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="categories[]" value="{{ strtolower($category) }}"
                                               class="rounded border-[var(--border-light)] text-[var(--primary)] focus:ring-[var(--primary)]"
                                               {{ in_array(strtolower($category), (array)$selectedCategories) ? 'checked' : '' }}>
                                        <span class="text-[var(--text-soft)]">{{ $category }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">Price Range</h4>
                                <div class="space-y-3">
                                    <div class="flex gap-3">
                                        <input type="number" name="min_price" placeholder="Min"
                                               value="{{ request('min_price') }}"
                                               class="w-full px-3 py-2 border border-[var(--border-light)] rounded-lg focus:border-[var(--primary)] focus:outline-none">
                                        <input type="number" name="max_price" placeholder="Max"
                                               value="{{ request('max_price') }}"
                                               class="w-full px-3 py-2 border border-[var(--border-light)] rounded-lg focus:border-[var(--primary)] focus:outline-none">
                                    </div>
                                </div>
                            </div>

                            <!-- Ratings Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">Customer Ratings</h4>
                                <div class="space-y-2">
                                    @for($i = 4; $i >= 1; $i--)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}"
                                               class="text-[var(--primary)] focus:ring-[var(--primary)]"
                                               {{ request('rating') == $i ? 'checked' : '' }}>
                                        <span class="flex items-center gap-1">
                                            @for($j = 1; $j <= 5; $j++)
                                                @if($j <= $i)
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                @else
                                                    <i class="far fa-star text-yellow-400 text-xs"></i>
                                                @endif
                                            @endfor
                                            <span class="text-[var(--text-soft)] text-sm ml-1">& Up</span>
                                        </span>
                                    </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Discount Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">Discount</h4>
                                <div class="space-y-2">
                                    @php
                                        $discounts = [10, 20, 30, 40, 50];
                                    @endphp
                                    @foreach($discounts as $discount)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="discount[]" value="{{ $discount }}"
                                               class="rounded border-[var(--border-light)] text-[var(--primary)] focus:ring-[var(--primary)]"
                                               {{ in_array($discount, (array)request('discount', [])) ? 'checked' : '' }}>
                                        <span class="text-[var(--text-soft)]">{{ $discount }}% or more</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Availability -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">Availability</h4>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="in_stock" value="1"
                                           class="rounded border-[var(--border-light)] text-[var(--primary)] focus:ring-[var(--primary)]"
                                           {{ request('in_stock') ? 'checked' : '' }}>
                                    <span class="text-[var(--text-soft)]">In Stock Only</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-[var(--primary)] text-white py-3 rounded-xl font-semibold hover:bg-[var(--primary-dark)] transition-all">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </aside>

                <!-- ===== PRODUCTS GRID ===== -->
                <div class="lg:w-3/4">
                    <!-- Sorting & Results Bar -->
                    <div class="bg-white rounded-2xl shadow-md p-4 mb-6 border border-[var(--border-light)] flex flex-wrap items-center justify-between gap-4">
                        <div class="text-[var(--text-soft)]">
                            <span class="font-semibold text-[var(--text-dark)]">{{ $products->count() }}</span> products found
                        </div>

                        <div class="flex items-center gap-3">
                            <label class="text-[var(--text-soft)] text-sm">Sort by:</label>
                            <select name="sort" id="sort-select"
                                    class="px-4 py-2 border border-[var(--border-light)] rounded-lg focus:border-[var(--primary)] focus:outline-none bg-white"
                                    onchange="window.location.href = this.value">
                                @php
                                    $sortOptions = [
                                        'latest' => 'Latest',
                                        'price_low' => 'Price: Low to High',
                                        'price_high' => 'Price: High to Low',
                                        'popularity' => 'Popularity',
                                        'rating' => 'Customer Rating'
                                    ];
                                    $currentSort = request('sort', 'latest');
                                @endphp
                                @foreach($sortOptions as $value => $label)
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => $value]) }}"
                                            {{ $currentSort == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- View Toggle (Grid/List) - UI only, functionality can be added -->
                            <div class="flex gap-1 border-l border-[var(--border-light)] pl-3">
                                <button class="w-8 h-8 flex items-center justify-center rounded bg-[var(--primary)] text-white">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button class="w-8 h-8 flex items-center justify-center rounded text-[var(--text-muted)] hover:bg-[var(--bg-warm)]">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        @php
                            $discountedPrice = $product->price;
                            if($product->discount > 0) {
                                $discountedPrice = $product->price - ($product->discount * $product->price) / 100;
                            }
                        @endphp
                        <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden border border-[var(--border-light)] hover:shadow-xl transition-all group">
                            <div class="relative">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{ asset(Storage::url($product->images[0] ?? 'placeholder.jpg')) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </a>
                                @if($product->discount > 0)
                                <span class="absolute top-3 left-3 bg-[var(--danger)] text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    -{{ $product->discount }}%
                                </span>
                                @endif
                                @if($product->created_at && $product->created_at->diffInDays() < 7)
                                <span class="absolute {{ $product->discount > 0 ? 'top-12' : 'top-3' }} left-3 bg-[var(--primary)] text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    New
                                </span>
                                @endif
                                <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-[var(--danger)] hover:text-white transition-colors">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-5">
                                <a href="{{ route('product', $product->slug) }}" class="block">
                                    <h3 class="font-semibold text-lg mb-1 hover:text-[var(--primary)] transition-colors line-clamp-1">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                <p class="text-[var(--text-muted)] text-sm mb-2">{{ $product->dokan->name ?? 'Seller' }}</p>

                                <!-- Rating -->
                                <div class="flex items-center gap-1 mb-3">
                                    @php $rating = $product->rating ?? 4.0; @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($rating))
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        @elseif($i - 0.5 <= $rating)
                                            <i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400 text-xs"></i>
                                        @endif
                                    @endfor
                                    <span class="text-xs text-[var(--text-muted)] ml-1">({{ number_format($product->reviews_count ?? 0) }})</span>
                                </div>

                                <!-- Price Section -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if($product->discount > 0)
                                            <span class="text-xl font-bold text-[var(--text-dark)]">
                                                ₹{{ number_format($discountedPrice) }}
                                            </span>
                                            <span class="text-sm text-[var(--text-muted)] line-through ml-2">
                                                ₹{{ number_format($product->price) }}
                                            </span>
                                        @else
                                            <span class="text-xl font-bold text-[var(--text-dark)]">
                                                ₹{{ number_format($product->price) }}
                                            </span>
                                        @endif
                                    </div>
                                    <button class="bg-[var(--primary)] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[var(--primary-dark)] shadow-md transition-all">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- No Products Found -->
                    <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-2xl font-bold mb-2">No Products Found</h3>
                        <p class="text-[var(--text-soft)] mb-6">Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-[var(--primary)] text-white px-6 py-3 rounded-full font-semibold hover:bg-[var(--primary-dark)]">
                            Clear All Filters
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TRUST BADGES ===== -->
    <section class="py-10 bg-white border-t border-[var(--border-light)] mt-8">
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

    <!-- ===== NEWSLETTER ===== -->
    <section class="py-12 bg-gradient-to-br from-[var(--primary-light)]/10 to-[var(--accent-soft)]/20">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-3xl font-bold mb-3">Stay Updated</h3>
                <p class="text-[var(--text-soft)] mb-6">Subscribe to get special offers, free giveaways, and exclusive deals.</p>
                <div class="flex gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 px-5 py-3 rounded-full border-2 border-[var(--border-light)] focus:border-[var(--primary)] focus:outline-none">
                    <button class="bg-[var(--primary)] text-white px-8 py-3 rounded-full font-semibold hover:bg-[var(--primary-dark)]">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>

@push('styles')
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
