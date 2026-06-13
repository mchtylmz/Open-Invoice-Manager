<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Quote') }} {{ $quote->quote_number }}
            </h2>
            <div class="flex items-center gap-2">
                <form action="{{ route('quotes.duplicate', $quote) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-xs font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        Duplicate
                    </button>
                </form>
                <a href="{{ route('quotes.pdf', $quote) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-xs font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    PDF Export
                </a>
                <a href="{{ route('quotes.edit', $quote) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 rounded-xl text-xs font-semibold text-white shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('quotes.destroy', $quote) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 rounded-xl text-xs font-semibold text-white shadow-sm hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">QUOTE</h3>
                            <p class="text-base text-indigo-600 dark:text-indigo-400 font-medium mt-1">{{ $quote->quote_number }}</p>
                        </div>
                        <x-status-badge :status="$quote->status" type="quote" />
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">From</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ auth()->user()->company_name ?? auth()->user()->name }}</p>
                            @if(auth()->user()->company_address)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{!! nl2br(e(auth()->user()->company_address)) !!}</p>@endif
                            @if(auth()->user()->company_phone)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ auth()->user()->company_phone }}</p>@endif
                            @if(auth()->user()->company_email)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ auth()->user()->company_email }}</p>@endif
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Bill To</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $quote->customer->name }}</p>
                            @if($quote->customer->address)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{!! nl2br(e($quote->customer->address)) !!}</p>@endif
                            @if($quote->customer->email)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $quote->customer->email }}</p>@endif
                            @if($quote->customer->phone)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $quote->customer->phone }}</p>@endif
                            @if($quote->customer->tax_number)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Tax: {{ $quote->customer->tax_number }}</p>@endif
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-8 p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Issue Date</p>
                            <p class="text-base font-medium text-gray-900 dark:text-white mt-1">{{ $quote->issue_date->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Valid Until</p>
                            <p class="text-base font-medium text-gray-900 dark:text-white mt-1">{{ $quote->valid_until ? $quote->valid_until->format('d.m.Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Currency</p>
                            <p class="text-base font-medium text-gray-900 dark:text-white mt-1">{{ $quote->currency }}</p>
                        </div>
                    </div>

                    <table class="w-full text-sm mb-8">
                        <thead>
                            <tr class="border-b-2 border-gray-200 dark:border-gray-700">
                                <th class="pb-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                                <th class="pb-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Qty</th>
                                <th class="pb-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Unit Price</th>
                                <th class="pb-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quote->items as $item)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-3 text-gray-900 dark:text-white">{{ $item->description }}</td>
                                    <td class="py-3 text-right text-gray-600 dark:text-gray-400">{{ $item->quantity }}</td>
                                    <td class="py-3 text-right text-gray-600 dark:text-gray-400">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-3 text-right font-medium text-gray-900 dark:text-white">{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <div class="w-64 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Subtotal</span>
                                <span>{{ number_format($quote->items->sum(fn($i) => $i->quantity * $i->unit_price), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Tax ({{ $quote->tax_rate }}%)</span>
                                <span>{{ number_format($quote->items->sum(fn($i) => $i->quantity * $i->unit_price) * $quote->tax_rate / 100, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white border-t-2 border-gray-200 dark:border-gray-700 pt-3">
                                <span>Total</span>
                                <span>{{ number_format($quote->total, 2) }} {{ $quote->currency }}</span>
                            </div>
                        </div>
                    </div>

                    @if($quote->notes)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Notes</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{!! nl2br(e($quote->notes)) !!}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
