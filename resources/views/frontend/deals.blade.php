<x-frontend-layout>
    <!-- ===== PAGE HEADER WITH SALE BANNER ===== -->
    <section class="py-8 bg-gradient-to-r from-[var(--danger)]/10 via-[var(--primary-light)]/20 to-[var(--danger)]/10">
        <div class="container">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="bg-[var(--danger)] text-white px-4 py-1 rounded-full text-sm font-semibold animate-pulse">
                            <i class="fas fa-bolt mr-1"></i>Limited Time
                        </span>
                        <span class="bg-white/50 backdrop-blur-sm px-4 py-1 rounded-full text-sm font-semibold text-[var(--text-dark)]">
                            Up to 70% OFF
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[var(--text-dark)] mb-2">
                        Hot Deals & Offers
                    </h1>
                    <p class="text-lg text-[var(--text-soft)]">Grab the best discounts before they're gone!</p>
                </div>
                <div class="flex gap-4">
                    <div class="bg-white rounded-2xl shadow-lg p-4 text-center min-w-[100px]">
                        <span class="block text-3xl font-bold text-[var(--danger)]" id="days">00</span>
                        <span class="text-sm text-[var(--text-muted)]">Days</span>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-4 text-center min-w-[100px]">
                        <span class="block text-3xl font-bold text-[var(--danger)]" id="hours">00</span>
                        <span class="text-sm text-[var(--text-muted)]">Hours</span>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-4 text-center min-w-[100px]">
                        <span class="block text-3xl font-bold text-[var(--danger)]" id="minutes">00</span>
                        <span class="text-sm text-[var(--text-muted)]">Mins</span>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-4 text-center min-w-[100px]">
                        <span class="block text-3xl font-bold text-[var(--danger)]" id="seconds">00</span>
                        <span class="text-sm text-[var(--text-muted)]">Secs</span>
                    </div>
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
                <span class="text-[var(--text-dark)] font-medium">Deals & Offers</span>
            </nav>
        </div>
    </section>

    <!-- ===== DEALS LISTING SECTION ===== -->
    <section class="py-8">
        <div class="container">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- ===== SIDEBAR FILTERS ===== -->
                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-md p-6 border border-[var(--border-light)] sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold">Filter Deals</h3>
                            <a href="{{ route('deals') }}" class="text-sm text-[var(--primary)] hover:underline">Clear All</a>
                        </div>

                        <form method="GET" action="{{ route('deals') }}" id="filter-form">
                            <!-- Discount Range Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3 flex items-center justify-between">
                                    <span>Discount Percentage</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </h4>
                                <div class="space-y-2">
                                    @php
                                        $discountRanges = [
                                            '10-25' => '10% - 25% off',
                                            '25-40' => '25% - 40% off',
                                            '40-60' => '40% - 60% off',
                                            '60-100' => '60% or more'
                                        ];
                                    @endphp
                                    @foreach($discountRanges as $range => $label)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="discount_range" value="{{ $range }}"
                                               class="text-[var(--primary)] focus:ring-[var(--primary)]"
                                               {{ request('discount_range') == $range ? 'checked' : '' }}>
                                        <span class="text-[var(--text-soft)]">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Categories Filter -->
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">Categories</h4>
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

                <!-- ===== DEALS GRID ===== -->
                <div class="lg:w-3/4">
                    <!-- Sorting & Results Bar -->
                    <div class="bg-white rounded-2xl shadow-md p-4 mb-6 border border-[var(--border-light)] flex flex-wrap items-center justify-between gap-4">
                        <div class="text-[var(--text-soft)]">
                            {{-- Showing <span class="font-semibold text-[var(--text-dark)]">{{ $deals->firstItem() ?? 0 }}</span> -
                            <span class="font-semibold text-[var(--text-dark)]">{{ $deals->lastItem() ?? 0 }}</span> of
                            <span class="font-semibold text-[var(--text-dark)]">{{ $deals->total() }}</span> deals --}}
                        </div>

                        <div class="flex items-center gap-3">
                            <label class="text-[var(--text-soft)] text-sm">Sort by:</label>
                            <select name="sort" id="sort-select"
                                    class="px-4 py-2 border border-[var(--border-light)] rounded-lg focus:border-[var(--primary)] focus:outline-none bg-white"
                                    onchange="window.location.href = this.value">
                                @php
                                    $sortOptions = [
                                        'discount_high' => 'Discount: High to Low',
                                        'price_low' => 'Price: Low to High',
                                        'price_high' => 'Price: High to Low',
                                        'latest' => 'Latest',
                                        'popularity' => 'Popularity'
                                    ];
                                    $currentSort = request('sort', 'discount_high');
                                @endphp
                                @foreach($sortOptions as $value => $label)
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => $value]) }}"
                                            {{ $currentSort == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Deals Grid -->
                    @if($deals->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($deals as $deal)
                        @php
                            $discountedPrice = $deal->price - ($deal->discount * $deal->price) / 100;
                            $savings = ($deal->discount * $deal->price) / 100;
                        @endphp
                        <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden border border-[var(--border-light)] hover:shadow-xl transition-all group">
                            <div class="relative">
                                <a href="{{ route('product', $deal->slug) }}">
                                    <img src="{{ asset(Storage::url($deal->images[0] ?? 'placeholder.jpg')) }}"
                                         alt="{{ $deal->name }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </a>
                                <!-- Discount Badge -->
                                <span class="absolute top-3 left-3 bg-[var(--danger)] text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    -{{ $deal->discount }}%
                                </span>
                                <!-- Save Amount Badge -->
                                <span class="absolute top-3 left-20 bg-[var(--success)] text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Save ₹{{ number_format($savings) }}
                                </span>
                                <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-[var(--danger)] hover:text-white transition-colors">
                                    <i class="far fa-heart"></i>
                                </button>
                                @if($deal->discount >= 50)
                                <span class="absolute bottom-3 left-3 bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                    <i class="fas fa-fire mr-1"></i>HOT DEAL
                                </span>
                                @endif
                            </div>
                            <div class="p-5">
                                <a href="{{ route('product', $deal->slug) }}" class="block">
                                    <h3 class="font-semibold text-lg mb-1 hover:text-[var(--primary)] transition-colors line-clamp-1">
                                        {{ $deal->name }}
                                    </h3>
                                </a>
                                <p class="text-[var(--text-muted)] text-sm mb-2">{{ $deal->dokan->name ?? 'Seller' }}</p>

                                <!-- Rating -->
                                <div class="flex items-center gap-1 mb-3">
                                    @php $rating = $deal->rating ?? 4.2; @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($rating))
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        @elseif($i - 0.5 <= $rating)
                                            <i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400 text-xs"></i>
                                        @endif
                                    @endfor
                                    <span class="text-xs text-[var(--text-muted)] ml-1">({{ rand(10,5000) }})</span>
                                </div>

                                <!-- Price Section -->
                                <div class="mb-3">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-[var(--text-dark)]">
                                            ₹{{ number_format($discountedPrice) }}
                                        </span>
                                        <span class="text-sm text-[var(--text-muted)] line-through">
                                            ₹{{ number_format($deal->price) }}
                                        </span>
                                    </div>
                                    <div class="mt-1">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-[var(--danger)] h-2 rounded-full" style="width: {{ $deal->discount }}%"></div>
                                        </div>
                                        <p class="text-xs text-[var(--success)] mt-1 font-semibold">
                                            <i class="fas fa-tag mr-1"></i>You save ₹{{ number_format($savings) }} ({{ $deal->discount }}%)
                                        </p>
                                    </div>
                                </div>

                                <!-- Stock Status -->
                                @php
                                    $stockStatus = ['In Stock', 'Limited Stock', 'Selling Fast'][rand(0,2)];
                                    $stockColor = $stockStatus == 'In Stock' ? 'success' : 'warning';
                                @endphp
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-medium text-[var(--{{ $stockColor }})]">
                                        <i class="fas fa-circle text-[8px] mr-1"></i>{{ $stockStatus }}
                                    </span>
                                    <button class="bg-[var(--primary)] text-white px-4 py-2 rounded-lg text-sm hover:bg-[var(--primary-dark)] transition-all">
                                        <i class="fas fa-shopping-cart mr-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- <!-- Pagination -->
                    @if($deals->hasPages())
                    <div class="mt-8">
                        {{ $deals->appends(request()->query())->links() }}
                    </div>
                    @endif --}}

                    @else
                    <!-- No Deals Found -->
                    <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                        <div class="text-6xl mb-4">🏷️</div>
                        <h3 class="text-2xl font-bold mb-2">No Active Deals Found</h3>
                        <p class="text-[var(--text-soft)] mb-6">Check back later for new discounts and offers.</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-[var(--primary)] text-white px-6 py-3 rounded-full font-semibold hover:bg-[var(--primary-dark)]">
                            Browse All Products
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURED DEAL BANNER ===== -->
    @if(isset($featuredDeal) && $featuredDeal)
    <section class="py-10 bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white">
        <div class="container">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 bg-white rounded-2xl p-2">
                        <img src="{{ asset(Storage::url($featuredDeal->images[0] ?? '')) }}" alt="Featured Deal" class="w-full h-full object-cover rounded-xl">
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Deal of the Day</h3>
                        <p class="text-lg opacity-90">{{ $featuredDeal->name }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-3xl font-bold">₹{{ number_format($featuredDeal->price - ($featuredDeal->discount * $featuredDeal->price)/100) }}</span>
                            <span class="text-lg line-through opacity-75">₹{{ number_format($featuredDeal->price) }}</span>
                            <span class="bg-white text-[var(--danger)] px-3 py-1 rounded-full text-sm font-bold">{{ $featuredDeal->discount }}% OFF</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('product', $featuredDeal->slug) }}" class="mt-4 md:mt-0 bg-white text-[var(--primary)] px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all">
                    Grab This Deal <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- ===== NEWSLETTER ===== -->
    <section class="py-12 bg-gradient-to-br from-[var(--primary-light)]/10 to-[var(--accent-soft)]/20 mt-8">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-3xl font-bold mb-3">Never Miss a Deal!</h3>
                <p class="text-[var(--text-soft)] mb-6">Subscribe to get notified about exclusive discounts and flash sales.</p>
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
    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    .pagination .page-item {
        list-style: none;
    }
    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 9999px;
        background: white;
        color: var(--text-dark);
        font-weight: 500;
        transition: all 0.2s;
        border: 1px solid var(--border-light);
    }
    .pagination .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    .pagination .page-link:hover {
        background: var(--bg-warm);
    }
    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    /* Animated pulse for limited time badge */
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Countdown Timer for deals page (example: set to 3 days from now)
    document.addEventListener('DOMContentLoaded', function() {
        // Set the countdown date (e.g., 3 days from page load)
        const countDownDate = new Date();
        countDownDate.setDate(countDownDate.getDate() + 3);
        countDownDate.setHours(23, 59, 59, 999); // End of day

        const timerInterval = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance < 0) {
                clearInterval(timerInterval);
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }, 1000);
    });
</script>
@endpush
