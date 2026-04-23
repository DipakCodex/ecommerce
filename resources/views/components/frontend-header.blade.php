<!-- ===== HEADER / NAVIGATION ===== -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-[var(--border-light)]">
    <!-- Top bar -->
    <div class="bg-[var(--primary)] text-white py-2">
        <div class="container flex justify-between items-center text-sm">
            <div class="flex gap-4">
                <span><i class="fas fa-truck"></i> Free shipping over ₹499</span>
                <span class="hidden sm:inline"><i class="fas fa-headset"></i> 24/7 Support</span>
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-[var(--accent-soft)]">Help</a>
                <a href="#" class="hover:text-[var(--accent-soft)]">Track Order</a>
            </div>
        </div>
    </div>

    <!-- Main navigation -->
    <div class="container py-4">
        <div class="flex items-center justify-between gap-4">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-[var(--primary)] to-[var(--secondary)] rounded-xl flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-white text-xl"></i>
                </div>
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] bg-clip-text text-transparent">
                    DipakHub
                </span>
            </div>

            <!-- Search bar -->
            <div class="flex-1 max-w-2xl mx-4 hidden lg:block">
                <div class="relative">
                    <input type="text" placeholder="Search for products, brands and more..."
                        class="w-full px-5 py-3 pr-12 rounded-full border-2 border-[var(--border-light)] focus:border-[var(--primary)] focus:outline-none">
                    <button
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-[var(--primary)] text-white px-5 py-2 rounded-full hover:bg-[var(--primary-dark)]">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Right menu -->
            <div class="flex items-center gap-4 md:gap-6">
               @if (!Auth::guard('web')->user())
                <a href="{{ route('login') }}"
                    class="hidden sm:flex flex-col items-center text-[var(--text-soft)] hover:text-[var(--primary)]">
                    <i class="fas fa-user text-xl"></i>
                    <span class="text-xs mt-1">Sign in</span>
                </a>
                @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="flex flex-col items-center text-[var(--text-soft)] hover:text-[var(--primary)]">
                        <i class="fas fa-user text-xl"></i>
                        <span class="text-xs mt-1">Sign out</span>
                    </button>
                </form>
               @endif
                <a href="#"
                    class="flex flex-col items-center text-[var(--text-soft)] hover:text-[var(--primary)] relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-[var(--danger)] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    <span class="text-xs mt-1">Cart</span>
                </a>
                <a href="#dokan-registration"
                    class="hidden md:flex flex-col items-center text-[var(--accent)] hover:text-[var(--primary)]">
                    <i class="fas fa-store text-xl"></i>
                    <span class="text-xs mt-1">Sell</span>
                </a>

                {{-- <a href="{{ route('login') }}"
                    class="hidden md:flex flex-col items-center text-[var(--accent)] hover:text-[var(--primary)]">
                    <i class="fas fa-store text-xl"></i>
                    <span class="text-xs mt-1">Sign in</span>
                </a> --}}
            </div>
        </div>
    </div>

    <!-- Category menu -->
    <div class="border-t border-[var(--border-light)]">
        <div class="container py-2 overflow-x-auto whitespace-nowrap">
            <div class="flex justify-center gap-6 text-xl font-medium ">
                <a href="{{ route('home') }}" class="text-[var(--text-soft)] hover:text-[var(--primary)]">Home</a>
                <a href="{{ route('products') }}" class="text-[var(--text-soft)] hover:text-[var(--primary)]">Shop</a>
                <a href="{{ route('deals') }}" class="text-[var(--text-soft)] hover:text-[var(--primary)]">Deals</a>
            </div>

        </div>
    </div>
</header>
