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
<body class="font-sans antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <nav x-data="{ mobileOpen: false }" class="fixed top-0 inset-x-0 z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-lg border-b border-gray-200/50 dark:border-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:shadow-indigo-500/30 transition-shadow">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight">Invoice Manager</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">How It Works</a>
                    <a href="#pricing" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Pricing</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl hover:from-indigo-600 hover:to-purple-700 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl hover:from-indigo-600 hover:to-purple-700 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 transition-all">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak x-transition:enter="duration-200 ease-out" x-transition:leave="duration-150 ease-in" class="md:hidden pb-4 border-t border-gray-200 dark:border-gray-800 mt-2 pt-4">
                <div class="flex flex-col gap-3">
                    <a href="#features" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">How It Works</a>
                    <a href="#pricing" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Pricing</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative pt-32 pb-24 sm:pt-40 sm:pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-950"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-gradient-to-br from-indigo-400/20 to-purple-400/20 dark:from-indigo-500/10 dark:to-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/4 right-0 w-96 h-96 bg-gradient-to-bl from-pink-400/10 to-rose-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-amber-400/10 to-orange-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800/50 mb-6">
                    Free &bull; Open Source &bull; Self-Hosted
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1]">
                    <span class="text-gray-900 dark:text-white">Invoice &amp; Quote</span><br>
                    <span class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">Management</span>
                    <span class="text-gray-900 dark:text-white"> Made Simple</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Create, send, and track professional invoices and quotes in minutes. Built for freelancers and small businesses who value simplicity and control.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl hover:from-indigo-600 hover:to-purple-700 shadow-xl shadow-indigo-500/30 hover:shadow-indigo-500/40 transition-all duration-200">
                        Start Free Trial
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#features" class="inline-flex items-center px-8 py-3.5 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-750 hover:border-gray-300 dark:hover:border-gray-600 shadow-sm transition-all">
                        Explore Features
                    </a>
                </div>
            </div>

            <!-- Mockup -->
            <div class="mt-20 relative max-w-5xl mx-auto">
                <div class="absolute inset-0 bg-gradient-to-t from-white dark:from-gray-950 via-transparent to-transparent z-10 pointer-events-none"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-indigo-500/10 ring-1 ring-gray-200 dark:ring-gray-800">
                    <img src="{{ asset('docs/screenshots/dashboard.svg') }}" alt="Dashboard preview" class="w-full h-auto" loading="lazy">
                </div>
                <!-- Glow effect -->
                <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-3/4 h-8 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 blur-2xl"></div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 sm:py-32 bg-gray-50/50 dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">Everything You Need</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Powerful features to manage your billing workflow end-to-end.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-indigo-200 dark:hover:border-indigo-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Customer Management</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Keep all your customer data organized with detailed profiles, contact info, and billing history.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-emerald-200 dark:hover:border-emerald-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/50 dark:to-emerald-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Invoices &amp; Quotes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Create professional documents with line items, tax rates, discounts, and custom notes in seconds.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-amber-200 dark:hover:border-amber-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/50 dark:to-amber-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">PDF Export</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Generate beautiful, print-ready PDFs for any invoice or quote with one click.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-rose-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-rose-200 dark:hover:border-rose-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-rose-200 dark:from-rose-900/50 dark:to-rose-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Dashboard Analytics</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Get real-time insights with revenue charts, payment status tracking, and quick overviews.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-sky-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-sky-200 dark:hover:border-sky-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-sky-100 to-sky-200 dark:from-sky-900/50 dark:to-sky-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Search &amp; Filter</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Find anything instantly with powerful search, status filters, date ranges, and column sorting.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group relative bg-white dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl hover:shadow-violet-500/5 transition-all duration-300 border border-gray-200 dark:border-gray-800 hover:border-violet-200 dark:hover:border-violet-800">
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-100 to-violet-200 dark:from-violet-900/50 dark:to-violet-800/50 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Multi-Currency</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Work with any currency. Perfect for international clients and global freelancing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-20 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-white">100%</div>
                    <div class="mt-1 text-sm text-indigo-100">Open Source</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-white">Free</div>
                    <div class="mt-1 text-sm text-indigo-100">No Hidden Costs</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-white">Self-Hosted</div>
                    <div class="mt-1 text-sm text-indigo-100">Your Data, Your Control</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold text-white">Unlimited</div>
                    <div class="mt-1 text-sm text-indigo-100">Customers &amp; Documents</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">How It Works</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Get started in minutes with three simple steps.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12 relative">
                <!-- Connector line -->
                <div class="hidden md:block absolute top-16 left-[17%] right-[17%] h-0.5 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-800"></div>

                <div class="relative text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-500/10">
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Create Your Account</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Sign up in seconds. No credit card needed. Your data stays on your server.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/50 dark:to-purple-800/50 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/10">
                        <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Add Customers &amp; Products</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Build your customer list and product catalog. Everything organized in one place.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-100 to-pink-200 dark:from-pink-900/50 dark:to-pink-800/50 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-pink-500/10">
                        <span class="text-2xl font-bold text-pink-600 dark:text-pink-400">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Send &amp; Track</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Create invoices and quotes, export to PDF, and track payment status in real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-20 bg-gray-50/50 dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">Built With Modern Tech</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">A robust stack you can trust.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12">
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">PHP 8.4</span>
                </div>
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Laravel 13</span>
                </div>
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-sky-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Livewire</span>
                </div>
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-sky-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">TailwindCSS</span>
                </div>
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">MySQL</span>
                </div>
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Docker</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="pricing" class="py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-3xl p-10 sm:p-16 text-center overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-50"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Simplify Your Billing?</h2>
                    <p class="text-lg text-indigo-100 mb-10 max-w-xl mx-auto">Self-hosted, completely free, and packed with features. Start managing your invoices today.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3.5 text-base font-semibold text-indigo-600 bg-white rounded-2xl hover:bg-indigo-50 shadow-xl transition-all">
                            Get Started Free
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="https://github.com/mchtylmz/open-invoice-manager" target="_blank" class="inline-flex items-center px-8 py-3.5 text-base font-semibold text-white border-2 border-white/30 rounded-2xl hover:bg-white/10 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            View on GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold">Open Invoice Manager</span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Open source. MIT License. Built with
                    <span class="text-red-500">&hearts;</span> for freelancers.
                </p>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
