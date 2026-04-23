<x-frontend-layout>
    <section
        class="py-8 bg-gradient-to-r from-[var(--primary-light)]/10 via-[var(--accent-soft)]/20 to-[var(--primary-light)]/10">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span
                        class="inline-block px-4 py-1 bg-[var(--accent)]/20 text-[var(--text-dark)] rounded-full text-sm font-semibold mb-4">
                        🎉 Big Festival Sale
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        <span class="text-[var(--primary)]">Shop Smart</span><br>
                        <span class="text-[var(--text-dark)]">Live Better</span>
                    </h1>
                    <p class="text-lg text-[var(--text-soft)] mb-6">Get up to 60% off on top brands. Limited time offer!
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="bg-[var(--primary)] text-white px-8 py-3 rounded-full font-semibold hover:bg-[var(--primary-dark)] shadow-lg">
                            Shop Now <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#"
                            class="border-2 border-[var(--primary)] text-[var(--primary)] px-8 py-3 rounded-full font-semibold hover:bg-[var(--primary)] hover:text-white">
                            View Deals
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=600&h=400&fit=crop"
                        alt="Shopping" class="rounded-2xl shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CATEGORY CARDS ===== -->
    <section class="py-12">
        <div class="container">
            <h2 class="text-3xl font-bold mb-8 text-center">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-mobile-alt text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Electronics</h3>
                    </div>
                </div>
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-tshirt text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Fashion</h3>
                    </div>
                </div>
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-couch text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Furniture</h3>
                    </div>
                </div>
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-apple-alt text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Groceries</h3>
                    </div>
                </div>
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-dumbbell text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Sports</h3>
                    </div>
                </div>
                <div class="text-center group cursor-pointer">
                    <div class="bg-white p-6 rounded-2xl shadow-md group-hover:shadow-xl transition-all">
                        <i class="fas fa-book text-4xl text-[var(--primary)] mb-3"></i>
                        <h3 class="font-semibold">Books</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURED PRODUCTS SECTION ===== -->
    <section class="py-12 bg-white">
        <div class="container">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Featured Products</h2>
                <a href="#" class="text-[var(--primary)] font-semibold hover:underline">View All <i
                        class="fas fa-arrow-right ml-1"></i></a>
            </div>

            <!-- Product cards grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <!-- Product Card 1 -->
                    <div
                        class="product-card bg-white rounded-2xl shadow-md overflow-hidden border border-[var(--border-light)]">
                        <div class="relative">
                            <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}">
                            @if ($product->discount>0)
                            <span
                                class="absolute top-3 left-3 bg-[var(--danger)] text-white px-3 py-1 rounded-full text-xs font-semibold">{{$product->discount}} %
                            </span>
                            @endif
                            <button
                                class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-[var(--danger)] hover:text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-1 mb-2">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>
                                <span class="text-xs text-[var(--text-muted)] ml-1">(4.5k)</span>
                            </div>
                            <h3 class="font-semibold text-lg mb-1">{{ $product->name }}</h3>
                            <p class="text-[var(--text-muted)] text-sm mb-3">{{ $product->dokan->name }}</p>
                            <div class="">
                                <div>
                                    <span
                                        class="text-2xl font-bold text-[var(--text-dark)]">Rs{{ $product->price - ($product->discount
                                         * $product->price) / 100 }}
                                    </span>


                                        <span
                                            class="text-sm text-[var(--text-muted)] line-through ml-2">Rs.{{ $product->price }}
                                        </span>
                                </div>
                                <a href="{{route('product' , $product->slug)}}"
                                    class="bg-[var(--primary)] mt-5 text-white w-29 h-10 rounded-xl flex items-center justify-center hover:bg-[var(--primary-dark)] shadow-md">
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div></div>




            </div>
    </section>

    <!-- ===== DEALS & OFFERS BANNER ===== -->
    <section class="py-10 bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white">
        <div class="container">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Get 20% Cashback</h2>
                    <p class="text-lg opacity-90">On your first order above ₹999</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-xl">
                        <span class="block text-3xl font-bold">20%</span>
                        <span class="text-sm">OFF</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-xl">
                        <span class="block text-3xl font-bold">₹500</span>
                        <span class="text-sm">Max Cashback</span>
                    </div>
                </div>
                <button
                    class="mt-4 md:mt-0 bg-white text-[var(--primary)] px-8 py-3 rounded-full font-semibold hover:shadow-xl">
                    Grab Now
                </button>
            </div>
        </div>
    </section>

    <!-- ===== DOKAN REGISTRATION SECTION (Main Form) ===== -->
    <section id="dokan-registration" class="py-16 bg-[var(--bg-warm)]">
        <div class="container">
            <div class="text-center mb-10">
                <span
                    class="inline-block px-4 py-1 bg-[var(--accent)]/20 text-[var(--text-dark)] rounded-full text-sm font-semibold mb-3">
                    <i class="fas fa-store mr-2"></i>Sell on DipakHub
                </span>
                <h2 class="text-4xl font-bold mb-3">Register Your Dokan Today</h2>
                <p class="text-lg text-[var(--text-soft)] max-w-2xl mx-auto">
                    Join thousands of sellers and grow your business. Get your own dashboard to manage products, track
                    orders, and boost sales.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-10 max-w-6xl mx-auto">
                <!-- Left: Benefits -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-[var(--primary)]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-line text-2xl text-[var(--primary)]"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Grow Your Business</h3>
                                <p class="text-[var(--text-soft)]">Access millions of customers across India. Our
                                    platform helps you reach new markets and scale your business.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-[var(--primary)]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tachometer-alt text-2xl text-[var(--primary)]"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Powerful Dashboard</h3>
                                <p class="text-[var(--text-soft)]">Manage products, inventory, pricing, and orders from
                                    a single intuitive dashboard after approval.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-[var(--primary)]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-2xl text-[var(--primary)]"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Secure Payments</h3>
                                <p class="text-[var(--text-soft)]">Get paid directly to your bank account. We handle
                                    all payment processing with industry-leading security.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-[var(--primary)]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-headset text-2xl text-[var(--primary)]"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">24/7 Seller Support</h3>
                                <p class="text-[var(--text-soft)]">Our dedicated seller support team is always
                                    available to help you with any questions or issues.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Registration Form -->
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold mb-6">Start Selling in Minutes</h3>

                    <form action="{{ route('dokan_registration') }}" method="POST" class="space-y-5">

                        <!-- Name -->
                        @csrf
                        <div>
                            <label for="name" class="dokan-label">
                                <i class="fas fa-user text-[var(--primary)] mr-2"></i>Full Name / Business Name
                            </label>
                            <input type="text" id="name" name="name"
                                placeholder="e.g., Rajesh Kumar or Rajesh Electronics" class="dokan-input"
                                value="{{ old('name') }}">

                            @error('name')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="dokan-label">
                                <i class="fas fa-envelope text-[var(--primary)] mr-2"></i>Email Address
                            </label>
                            <input type="email" id="email" name="email" placeholder="you@example.com"
                                class="dokan-input" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact_no" class="dokan-label">
                                <i class="fas fa-phone text-[var(--primary)] mr-2"></i>Contact Number
                            </label>
                            <input type="tel" id="contact_no" name="contact_no" placeholder="+91 98765 43210"
                                class="dokan-input" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="dokan-label">
                                <i class="fas fa-message text-[var(--primary)] mr-2"></i>Tell us about your business
                            </label>
                            <textarea id="message" name="message" rows="4"
                                placeholder="What products do you sell? Where is your business located? Any other details you'd like to share..."
                                class="dokan-input" value="{{ old('message') }}"></textarea>
                            @error('message')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category selection (optional) -->
                        <div>
                            <label class="dokan-label">
                                <i class="fas fa-tags text-[var(--primary)] mr-2"></i>Primary Category (Optional)
                            </label>
                            <select name="category" class="dokan-input">
                                <option value="">Select a category</option>
                                <option value="electronics">Electronics</option>
                                <option value="fashion">Fashion & Apparel</option>
                                <option value="home">Home & Furniture</option>
                                <option value="beauty">Beauty & Personal Care</option>
                                <option value="sports">Sports & Fitness</option>
                                <option value="books">Books & Stationery</option>
                                <option value="groceries">Groceries & Food</option>
                                <option value="other">Other</option>
                            </select value="{{ old('message') }}">
                            @error('message')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start gap-2">
                            <input type="checkbox" id="terms" class="mt-1">
                            <label for="terms" class="text-sm text-[var(--text-soft)]">
                                I agree to the <a href="#" class="text-[var(--primary)] hover:underline">Terms
                                    of Service</a> and
                                <a href="#" class="text-[var(--primary)] hover:underline">Privacy Policy</a>. I
                                understand that my application will be reviewed before approval.
                            </label>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] text-white py-4 rounded-xl font-semibold text-lg hover:shadow-xl transition-all">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Registration
                        </button>

                        <p class="text-xs text-center text-[var(--text-muted)] mt-4">
                            <i class="fas fa-clock mr-1"></i>Applications are typically reviewed within 24-48 hours
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS SECTION ===== -->
    <section class="py-16 bg-white">
        <div class="container">
            <h2 class="text-3xl font-bold text-center mb-12">What Our Sellers Say</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-[var(--bg-warm)] p-6 rounded-2xl">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-[var(--text-soft)] mb-4">"DipakHub transformed my small handicraft business. Within
                        3 months, my sales tripled and I'm now shipping to customers across India!"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-[var(--primary)] rounded-full flex items-center justify-center text-white font-bold">
                            PK</div>
                        <div>
                            <h4 class="font-semibold">Priya Kapoor</h4>
                            <p class="text-sm text-[var(--text-muted)]">Handicrafts Seller</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[var(--bg-warm)] p-6 rounded-2xl">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-[var(--text-soft)] mb-4">"The dashboard is incredibly easy to use. I can manage all
                        my electronics inventory and track orders effortlessly. Highly recommended!"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-[var(--secondary)] rounded-full flex items-center justify-center text-white font-bold">
                            AS</div>
                        <div>
                            <h4 class="font-semibold">Amit Sharma</h4>
                            <p class="text-sm text-[var(--text-muted)]">Electronics Store Owner</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[var(--bg-warm)] p-6 rounded-2xl">
                    <div class="flex items-center gap-1 mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                    <p class="text-[var(--text-soft)] mb-4">"From registration to first sale, the process was smooth.
                        The support team is always responsive and helpful."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-[var(--accent)] rounded-full flex items-center justify-center text-white font-bold">
                            MR</div>
                        <div>
                            <h4 class="font-semibold">Meera Reddy</h4>
                            <p class="text-sm text-[var(--text-muted)]">Fashion Boutique</p>
                        </div>
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
                <p class="text-[var(--text-soft)] mb-6">Subscribe to get special offers, free giveaways, and exclusive
                    deals.</p>
                <div class="flex gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-5 py-3 rounded-full border-2 border-[var(--border-light)] focus:border-[var(--primary)] focus:outline-none">
                    <button
                        class="bg-[var(--primary)] text-white px-8 py-3 rounded-full font-semibold hover:bg-[var(--primary-dark)]">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
