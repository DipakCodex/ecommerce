<x-frontend-layout>
    <!-- ===== BREADCRUMB ===== -->
    <section class="py-4 bg-[var(--bg-warm)] border-b border-[var(--border-light)]">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)]">
                    <i class="fas fa-home mr-1"></i>Home
                </a>
                <i class="fas fa-chevron-right text-xs text-[var(--text-muted)]"></i>
                <span class="text-[var(--text-dark)] font-medium">Sign In</span>
            </nav>
        </div>
    </section>

    <!-- ===== SIGN IN SECTION ===== -->
    <section class="py-16 min-h-[70vh] flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <!-- Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-[var(--border-light)]">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-[var(--primary)]/10 rounded-full mb-4">
                            <i class="fas fa-lock text-2xl text-[var(--primary)]"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-[var(--text-dark)] mb-2">Welcome Back</h2>
                        <p class="text-[var(--text-soft)]">Sign in to continue to DipakHub</p>
                    </div>

                    <!-- Google Sign In Button -->
                    <a href="{{ route('google.redirect') }}"
                       class="flex items-center justify-center gap-3 w-full bg-white border-2 border-[var(--border-light)] hover:border-[var(--primary)] text-[var(--text-dark)] font-semibold py-4 px-6 rounded-xl transition-all shadow-sm hover:shadow-md group">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span>Continue with Google</span>
                        <i class="fas fa-arrow-right ml-auto text-[var(--text-muted)] group-hover:text-[var(--primary)] group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[var(--border-light)]"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-[var(--text-muted)]">or</span>
                        </div>
                    </div>

                    <!-- Guest Checkout Option -->
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="text-[var(--primary)] font-semibold hover:underline inline-flex items-center gap-2">
                            Continue as Guest
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>

                    <!-- Terms Notice -->
                    <p class="text-xs text-center text-[var(--text-muted)] mt-8">
                        By signing in, you agree to our
                        <a href="#" class="text-[var(--primary)] hover:underline">Terms of Service</a> and
                        <a href="#" class="text-[var(--primary)] hover:underline">Privacy Policy</a>.
                    </p>
                </div>

                <!-- Benefits List -->
                <div class="mt-8 grid grid-cols-1 gap-3">
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-xs"></i>
                        </div>
                        <span>Access your order history and track shipments</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-xs"></i>
                        </div>
                        <span>Save items to your wishlist</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-xs"></i>
                        </div>
                        <span>Get personalized recommendations</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
