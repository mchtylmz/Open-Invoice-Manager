<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_customers'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Customers</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_products'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Products</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_invoices'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Invoices</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_invoices'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pending</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_quotes'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Quotes</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['revenue'] ?? 0, 2) }} {{ $stats['currency'] ?? 'USD' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Invoices</h3>
                    </div>
                    <div class="p-6">
                        @if($recentInvoices->count() > 0)
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                        <th class="pb-3 font-medium">Number</th>
                                        <th class="pb-3 font-medium">Customer</th>
                                        <th class="pb-3 font-medium">Status</th>
                                        <th class="pb-3 font-medium text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentInvoices as $invoice)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="py-3">
                                                <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    {{ $invoice->invoice_number }}
                                                </a>
                                            </td>
                                            <td class="py-3 text-gray-700 dark:text-gray-300">{{ $invoice->customer->name ?? '-' }}</td>
                                            <td class="py-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @switch($invoice->status)
                                                        @case('draft') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @break
                                                        @case('pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 @break
                                                        @case('paid') bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 @break
                                                        @case('overdue') bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300 @break
                                                        @case('cancelled') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @break
                                                        @default bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                    @endswitch
                                                ">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-right text-gray-700 dark:text-gray-300">{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No recent invoices.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Quotes</h3>
                    </div>
                    <div class="p-6">
                        @if($recentQuotes->count() > 0)
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                        <th class="pb-3 font-medium">Number</th>
                                        <th class="pb-3 font-medium">Customer</th>
                                        <th class="pb-3 font-medium">Status</th>
                                        <th class="pb-3 font-medium text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentQuotes as $quote)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="py-3">
                                                <a href="{{ route('quotes.show', $quote) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    {{ $quote->quote_number }}
                                                </a>
                                            </td>
                                            <td class="py-3 text-gray-700 dark:text-gray-300">{{ $quote->customer->name ?? '-' }}</td>
                                            <td class="py-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @switch($quote->status)
                                                        @case('draft') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @break
                                                        @case('sent') bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 @break
                                                        @case('accepted') bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 @break
                                                        @case('rejected') bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300 @break
                                                        @default bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                    @endswitch
                                                ">
                                                    {{ ucfirst($quote->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-right text-gray-700 dark:text-gray-300">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No recent quotes.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
