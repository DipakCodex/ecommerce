{{-- resources/views/frontend/checkout.blade.php --}}
<x-frontend-layout>
    @section('title', 'Checkout')

    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <a href="{{ route('cart.index') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    Cart
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium">Checkout</span>
            </nav>
        </div>
    </section>

    <!-- ===== CHECKOUT PROGRESS ===== -->
    <section class="py-6 bg-white border-b border-[var(--border-light)]">
        <div class="container">
            <div class="flex items-center justify-center max-w-2xl mx-auto">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[var(--primary)] text-white rounded-full flex items-center justify-center font-semibold">1</div>
                    <span class="ml-3 font-semibold text-[var(--primary)]">Shopping Cart</span>
                </div>
                <div class="w-20 h-0.5 bg-[var(--primary)] mx-4"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[var(--primary)] text-white rounded-full flex items-center justify-center font-semibold">2</div>
                    <span class="ml-3 font-semibold text-[var(--primary)]">Checkout</span>
                </div>
                <div class="w-20 h-0.5 bg-gray-300 mx-4"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center font-semibold">3</div>
                    <span class="ml-3 text-gray-400">Confirmation</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CHECKOUT FORM ===== -->
    <section class="py-8">
        <div class="container">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm" x-data="checkoutForm()">
                @csrf

                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Left: Billing & Shipping Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Address -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-[var(--primary)]"></i>
                                Shipping Address
                            </h2>

                            @if(Auth::check() && count($savedAddresses) > 0)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-2">Select Saved Address</label>
                                <select x-model="selectedAddress" @change="fillAddress" class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                    <option value="">-- Select an address --</option>
                                    @foreach($savedAddresses as $address)
                                    <option value="{{ $address->id }}"
                                            data-full_name="{{ $address->full_name }}"
                                            data-phone="{{ $address->phone }}"
                                            data-address="{{ $address->address }}"
                                            data-city="{{ $address->city }}"
                                            data-state="{{ $address->state }}"
                                            data-postal_code="{{ $address->postal_code }}"
                                            data-country="{{ $address->country }}">
                                        {{ $address->address }}, {{ $address->city }} - {{ $address->postal_code }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Full Name *</label>
                                    <input type="text" name="full_name" x-model="form.full_name" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Email *</label>
                                    <input type="email" name="email" x-model="form.email" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" x-model="form.phone" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-semibold mb-2">Address *</label>
                                <textarea name="address" x-model="form.address" rows="3" required
                                          class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">City *</label>
                                    <input type="text" name="city" x-model="form.city" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">State *</label>
                                    <input type="text" name="state" x-model="form.state" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Postal Code *</label>
                                    <input type="text" name="postal_code" x-model="form.postal_code" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Country *</label>
                                    <input type="text" name="country" x-model="form.country" required
                                           class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                </div>
                            </div>

                            @if(Auth::check())
                            <div class="mt-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="save_address" value="1" class="w-4 h-4 text-[var(--primary)] rounded">
                                    <span class="ml-2 text-sm text-[var(--text-soft)]">Save this address for future orders</span>
                                </label>
                            </div>
                            @endif
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                                <i class="fas fa-credit-card text-[var(--primary)]"></i>
                                Payment Method
                            </h2>

                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-[var(--border-light)] rounded-xl cursor-pointer hover:border-[var(--primary)] transition">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" x-model="form.payment_method" checked
                                           class="w-5 h-5 text-[var(--primary)]">
                                    <div class="ml-4">
                                        <span class="font-semibold block">Cash on Delivery</span>
                                        <span class="text-sm text-[var(--text-muted)]">Pay when you receive the product</span>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 border border-[var(--border-light)] rounded-xl cursor-pointer hover:border-[var(--primary)] transition">
                                    <input type="radio" name="payment_method" value="card" x-model="form.payment_method"
                                           class="w-5 h-5 text-[var(--primary)]">
                                    <div class="ml-4">
                                        <span class="font-semibold block">Credit/Debit Card</span>
                                        <span class="text-sm text-[var(--text-muted)]">Secure payment via Stripe</span>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 border border-[var(--border-light)] rounded-xl cursor-pointer hover:border-[var(--primary)] transition">
                                    <input type="radio" name="payment_method" value="bank_transfer" x-model="form.payment_method"
                                           class="w-5 h-5 text-[var(--primary)]">
                                    <div class="ml-4">
                                        <span class="font-semibold block">Bank Transfer</span>
                                        <span class="text-sm text-[var(--text-muted)]">Direct bank transfer</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6">
                            <h2 class="text-xl font-bold mb-4">Order Notes (Optional)</h2>
                            <textarea name="order_notes" rows="3" placeholder="Any special instructions or notes..."
                                      class="w-full px-4 py-3 border border-[var(--border-light)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                        </div>
                    </div>

                    <!-- Right: Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-md border border-[var(--border-light)] p-6 sticky top-24">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                                <i class="fas fa-shopping-bag text-[var(--primary)]"></i>
                                Order Summary
                            </h2>

                            <!-- Order Items -->
                            <div class="space-y-4 mb-6 max-h-80 overflow-y-auto">
                                @foreach($checkoutData['items'] as $item)
                                <div class="flex gap-3">
                                    @if($item['image'])
                                    <img src="{{ asset(Storage::url($item['image'])) }}"
                                         alt="{{ $item['name'] }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-sm">{{ $item['name'] }}</h4>
                                        <p class="text-xs text-[var(--text-muted)] mb-1">{{ $item['dokan_name'] }}</p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm">Qty: {{ $item['quantity'] }}</span>
                                            <span class="font-semibold">Rs. {{ number_format($item['subtotal'], 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-t border-[var(--border-light)] pt-4 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-[var(--text-soft)]">Subtotal</span>
                                    <span>Rs. {{ number_format($checkoutData['subtotal'], 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[var(--text-soft)]">Shipping</span>
                                    @if($checkoutData['shipping'] == 0)
                                    <span class="text-[var(--success)]">Free</span>
                                    @else
                                    <span>Rs. {{ number_format($checkoutData['shipping'], 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[var(--text-soft)]">Tax (5% GST)</span>
                                    <span>Rs. {{ number_format($checkoutData['tax'], 2) }}</span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border-t border-[var(--border-light)] mt-4 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold">Total</span>
                                    <span class="text-2xl font-bold text-[var(--primary)]">
                                        Rs. {{ number_format($checkoutData['total'], 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit"
                                    class="w-full bg-[var(--primary)] text-white px-6 py-4 rounded-xl font-semibold hover:bg-[var(--primary-dark)] shadow-lg transition-all mt-6">
                                <i class="fas fa-lock mr-2"></i>
                                Place Order
                            </button>

                            <p class="text-xs text-center text-[var(--text-muted)] mt-4">
                                By placing your order, you agree to our
                                <a href="#" class="text-[var(--primary)]">Terms & Conditions</a>
                            </p>

                            <!-- Security Badges -->
                            <div class="flex items-center justify-center gap-4 mt-4 pt-4 border-t border-[var(--border-light)]">
                                <i class="fab fa-cc-visa text-2xl text-[var(--text-muted)]"></i>
                                <i class="fab fa-cc-mastercard text-2xl text-[var(--text-muted)]"></i>
                                <i class="fas fa-shield-alt text-2xl text-[var(--success)]"></i>
                                <span class="text-xs text-[var(--text-muted)]">256-bit SSL Secure</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

    @push('scripts')
    <script>
        function checkoutForm() {
            return {
                form: {
                    full_name: '{{ Auth::check() ? Auth::user()->name : '' }}',
                    email: '{{ Auth::check() ? Auth::user()->email : '' }}',
                    phone: '',
                    address: '',
                    city: '',
                    state: '',
                    postal_code: '',
                    country: 'India',
                    payment_method: 'cash_on_delivery'
                },
                selectedAddress: '',

                fillAddress() {
                    if (this.selectedAddress) {
                        const select = document.querySelector('select[x-model="selectedAddress"]');
                        const selectedOption = select.options[select.selectedIndex];

                        this.form.full_name = selectedOption.dataset.full_name;
                        this.form.phone = selectedOption.dataset.phone;
                        this.form.address = selectedOption.dataset.address;
                        this.form.city = selectedOption.dataset.city;
                        this.form.state = selectedOption.dataset.state;
                        this.form.postal_code = selectedOption.dataset.postal_code;
                        this.form.country = selectedOption.dataset.country;
                    }
                }
            }
        }
    </script>
    @endpush
</x-frontend-layout>
