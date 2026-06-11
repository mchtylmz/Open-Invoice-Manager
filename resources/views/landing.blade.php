<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Open source invoice and quote management for freelancers and small businesses.">
    <title>{{ config('app.name', 'Open Invoice Manager') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    <!-- Navbar -->
    <nav x-data="{ mobileOpen: false }" class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight text-gray-900">open<span class="text-indigo-600">invoice</span></span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">How It Works</a>
                    <a href="#pricing" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">Pricing</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak x-transition:enter="duration-200 ease-out" x-transition:leave="duration-150 ease-in" class="md:hidden pb-4 border-t border-gray-100 mt-2 pt-4">
                <div class="flex flex-col gap-3">
                    <a href="#features" class="text-sm font-medium text-gray-600 hover:text-gray-900">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 hover:text-gray-900">How It Works</a>
                    <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-gray-900">Pricing</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative pt-32 pb-24 sm:pt-40 sm:pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/50 via-white to-white"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-gradient-to-br from-indigo-100 to-transparent rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    Free &bull; Open Source &bull; Self-Hosted
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.15] text-gray-900">
                    Invoicing, Seriously<br>
                    <span class="text-indigo-600">Simplified</span>
                </h1>
                <p class="mt-5 text-base sm:text-lg text-gray-500 max-w-xl mx-auto leading-relaxed">
                    Create, send, and track professional invoices and quotes. Built for freelancers and small businesses who value simplicity.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                        Get Started Free
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#features" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 shadow-sm transition-colors">
                        Explore Features
                    </a>
                </div>
            </div>

            <div class="mt-16 max-w-5xl mx-auto">
                <div class="rounded-xl overflow-hidden shadow-lg ring-1 ring-gray-100">
                    <img src="{{ asset('docs/screenshots/dashboard.svg') }}" alt="Dashboard preview" class="w-full h-auto" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 sm:py-28 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-14">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Everything you need</h2>
                <p class="mt-3 text-base text-gray-500">Manage your billing workflow end-to-end.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">Customer Management</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Keep all your customer data organized with detailed profiles, contact info, and billing history.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">Invoices &amp; Quotes</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Create professional documents with line items, tax rates, discounts, and custom notes.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">PDF Export</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Generate clean, print-ready PDFs for any invoice or quote with one click.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-rose-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">Dashboard Analytics</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Get real-time insights with revenue charts, payment status tracking, and quick overviews.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-sky-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">Search &amp; Filter</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Find anything instantly with powerful search, status filters, date ranges, and column sorting.</p>
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-5 hover:border-gray-200 hover:shadow-sm transition-all">
                    <div class="w-10 h-10 rounded-lg bg-violet-50 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1.5">Multi-Currency</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Work with any currency. Perfect for international clients and global freelancing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">100%</div>
                    <div class="mt-1 text-sm text-gray-500">Open Source</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">Free</div>
                    <div class="mt-1 text-sm text-gray-500">No Hidden Costs</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">Self-Hosted</div>
                    <div class="mt-1 text-sm text-gray-500">Your Data, Your Control</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">Unlimited</div>
                    <div class="mt-1 text-sm text-gray-500">Customers &amp; Documents</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-14">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">How it works</h2>
                <p class="mt-3 text-base text-gray-500">Get started in minutes.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg font-bold text-indigo-600">1</span>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Create Your Account</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Sign up in seconds. No credit card needed. Your data stays on your server.</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg font-bold text-indigo-600">2</span>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Add Customers &amp; Products</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Build your customer list and product catalog. Everything organized in one place.</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg font-bold text-indigo-600">3</span>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Send &amp; Track</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Create invoices and quotes, export to PDF, and track payment status in real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Built with modern tech</h2>
                <p class="mt-3 text-base text-gray-500">A robust stack you can trust.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                    <span class="font-semibold text-gray-700">PHP 8.4</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                    <span class="font-semibold text-gray-700">Laravel 13</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                    <span class="font-semibold text-gray-700">Livewire</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                    <span class="font-semibold text-gray-700">TailwindCSS</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                    <span class="font-semibold text-gray-700">MySQL</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <span class="font-semibold text-gray-700">Docker</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="pricing" class="py-24 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Ready to simplify your billing?</h2>
                <p class="mt-3 text-base text-gray-500">Self-hosted, completely free, and packed with features.</p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                        Get Started Free
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="https://github.com/mchtylmz/open-invoice-manager" target="_blank" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 shadow-sm transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        View on GitHub
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-100 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-indigo-600 rounded flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-900">openinvoice</span>
                </div>
                <p class="text-xs text-gray-500">
                    Open source under MIT License. Built for freelancers.
                </p>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
