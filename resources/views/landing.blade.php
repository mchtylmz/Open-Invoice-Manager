<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free, open-source invoice and quote management for freelancers and small businesses.">
    <title>{{ config('app.name', 'Open Invoice Manager') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    <!-- Navbar -->
    <nav x-data="{ mobileOpen: false }" class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-lg border-b border-gray-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">open<span class="text-indigo-600">invoice</span></span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Features</a>
                    <a href="#screenshots" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Screenshots</a>
                    <a href="#how-it-works" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">How It Works</a>
                    <a href="#cta" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Get Started</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gray-900 rounded-xl hover:bg-gray-800 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md transition-all">Get Started</a>
                            @endif
                        @endauth
                    @endif
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2.5 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                        <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="md:hidden pb-6 space-y-1">
                <a href="#features" class="block px-4 py-3 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">Features</a>
                <a href="#screenshots" class="block px-4 py-3 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">Screenshots</a>
                <a href="#how-it-works" class="block px-4 py-3 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">How It Works</a>
                <a href="#cta" class="block px-4 py-3 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative pt-32 pb-20 sm:pt-40 sm:pb-28 overflow-hidden bg-white">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/50 via-white to-white"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-gradient-to-br from-indigo-100/40 to-transparent rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase bg-indigo-50 text-indigo-700 border border-indigo-100/80 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    Free &bull; Open Source &bull; Self-Hosted
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.1] text-gray-900">
                    Invoicing,<br>
                    <span class="text-indigo-600">Seriously Simplified.</span>
                </h1>

                <p class="mt-6 text-lg text-gray-500 max-w-xl mx-auto leading-relaxed">
                    Create, send, and track professional invoices and quotes — all self-hosted, completely free.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                        Get Started Free
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="https://github.com/mchtylmz/open-invoice-manager" target="_blank" class="inline-flex items-center gap-2 px-7 py-3 text-sm font-bold text-gray-700 bg-white border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        Source Code
                    </a>
                </div>
            </div>

            <div class="mt-16 max-w-5xl mx-auto">
                <div class="rounded-2xl overflow-hidden shadow-2xl ring-1 ring-gray-200/80">
                    <img src="{{ asset('docs/screenshots/dashboard.svg') }}" alt="Dashboard preview" class="w-full h-auto" loading="eager">
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Bar -->
    <section class="py-10 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs font-semibold tracking-widest uppercase text-gray-400 mb-6">Built with</p>
            <div class="flex flex-wrap items-center justify-center gap-6">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">PHP 8.4</span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">Laravel 13</span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">Livewire</span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">Tailwind CSS</span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">MySQL</span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold text-gray-700">Docker</span>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-indigo-600 bg-indigo-50 px-4 py-1.5 rounded-full mb-4">Features</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900">Everything you need</h2>
                <p class="mt-4 text-lg text-gray-500">From customer management to PDF exports.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">Customer Management</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Detailed profiles, contact info, billing history — everything organized.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">Invoices &amp; Quotes</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Line items, tax rates, discounts, custom notes — professional documents.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">PDF Export</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Beautiful, print-ready PDFs for any invoice or quote with one click.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">Dashboard Analytics</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Revenue charts, payment status, quick overview — real-time insights.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">Search &amp; Filter</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Powerful search, status filters, date ranges, and column sorting.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1.5">Multi-Currency</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Work with any currency. Perfect for international clients.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots -->
    <section id="screenshots" class="py-20 lg:py-28 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-indigo-600 bg-indigo-50 px-4 py-1.5 rounded-full mb-4">Screenshots</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900">See it in action</h2>
                <p class="mt-4 text-lg text-gray-500">A clean, intuitive interface designed for everyday billing.</p>
            </div>

            <div class="space-y-20">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/dashboard.svg') }}" alt="Dashboard" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dashboard</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Real-time revenue charts, payment tracking, and quick stats at a glance.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/customers.svg') }}" alt="Customers" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Customers</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Manage your customer base with detailed profiles, contact info, and history.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/invoices.svg') }}" alt="Invoices" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Invoices</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Create, filter, and track invoices with status badges and PDF export.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/invoice-detail.svg') }}" alt="Invoice Detail" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Invoice Detail</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Clean layout with line items, tax, discounts, and payment tracking.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/invoice-pdf.svg') }}" alt="PDF Export" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">PDF Export</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Generate print-ready PDFs for any invoice or quote with one click.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-10">
                    <div class="flex-1 w-full">
                        <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-200/80">
                            <img src="{{ asset('docs/screenshots/settings.svg') }}" alt="Settings" class="w-full h-auto" loading="lazy">
                        </div>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Settings</h3>
                        <p class="text-base text-gray-500 leading-relaxed">Customize company info, currency, tax rates, and preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl font-black text-gray-900">100%</div>
                    <div class="mt-1.5 text-sm font-semibold text-gray-500">Open Source</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl font-black text-gray-900">Free</div>
                    <div class="mt-1.5 text-sm font-semibold text-gray-500">No Hidden Costs</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl font-black text-gray-900">Self-Hosted</div>
                    <div class="mt-1.5 text-sm font-semibold text-gray-500">Your Data</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl font-black text-indigo-600">&infin;</div>
                    <div class="mt-1.5 text-sm font-semibold text-gray-500">Unlimited</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-indigo-600 bg-indigo-50 px-4 py-1.5 rounded-full mb-4">How It Works</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900">Up and running in minutes</h2>
                <p class="mt-4 text-lg text-gray-500">No complex setup. No hidden fees.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center mx-auto mb-5">
                        <span class="text-xl font-black text-indigo-600">1</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Deploy &amp; Register</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">Deploy via Docker or your own server. Sign up in seconds.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center mx-auto mb-5">
                        <span class="text-xl font-black text-indigo-600">2</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Add Customers &amp; Products</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">Build your customer list and product catalog in one place.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center mx-auto mb-5">
                        <span class="text-xl font-black text-indigo-600">3</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Send &amp; Track</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">Create invoices, export to PDF, and track payments in real time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="py-20 lg:py-28 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl bg-gray-900 overflow-hidden px-6 sm:px-12 lg:px-20 py-16 lg:py-20">
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>

                <div class="relative text-center max-w-2xl mx-auto">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">Ready to simplify your billing?</h2>
                    <p class="mt-4 text-lg text-gray-300">Self-hosted, completely free, and packed with features.</p>
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3 text-sm font-bold text-gray-900 bg-white rounded-xl hover:bg-gray-100 shadow-xl transition-all">
                            Get Started Free
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="https://github.com/mchtylmz/open-invoice-manager" target="_blank" class="inline-flex items-center gap-2 px-7 py-3 text-sm font-bold text-white bg-white/10 backdrop-blur border border-white/20 rounded-xl hover:bg-white/20 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            View on GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-5">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-sm font-bold text-gray-900">open<span class="text-indigo-600">invoice</span></span>
                </div>
                <p class="text-sm text-gray-400">Open source under the MIT License.</p>
                <div class="flex items-center gap-4">
                    <a href="https://github.com/mchtylmz/open-invoice-manager" target="_blank" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
