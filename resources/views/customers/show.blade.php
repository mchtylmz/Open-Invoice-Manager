<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $customer->name }}
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 rounded-xl text-xs font-semibold text-white shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Customer Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                            <p class="text-base font-medium text-gray-900 dark:text-white mt-1">{{ $customer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                            <p class="text-base text-gray-900 dark:text-white mt-1">{{ $customer->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                            <p class="text-base text-gray-900 dark:text-white mt-1">{{ $customer->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tax Number</p>
                            <p class="text-base text-gray-900 dark:text-white mt-1">{{ $customer->tax_number ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Address</p>
                            <p class="text-base text-gray-900 dark:text-white mt-1">{!! nl2br(e($customer->address ?? '-')) !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Invoices</h3>
                </div>
                <div class="p-6">
                    @if($customer->invoices->count() > 0)
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Invoice Number</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Status</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Issue Date</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->invoices as $invoice)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="py-3">
                                            <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 font-medium">{{ $invoice->invoice_number }}</a>
                                        </td>
                                        <td class="py-3"><x-status-badge :status="$invoice->status" type="invoice" /></td>
                                        <td class="py-3 text-gray-600 dark:text-gray-400">{{ $invoice->issue_date->format('d.m.Y') }}</td>
                                        <td class="py-3 text-right font-medium text-gray-900 dark:text-white">{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No invoices for this customer.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quotes</h3>
                </div>
                <div class="p-6">
                    @if($customer->quotes->count() > 0)
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Quote Number</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Status</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Issue Date</th>
                                    <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->quotes as $quote)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="py-3">
                                            <a href="{{ route('quotes.show', $quote) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 font-medium">{{ $quote->quote_number }}</a>
                                        </td>
                                        <td class="py-3"><x-status-badge :status="$quote->status" type="quote" /></td>
                                        <td class="py-3 text-gray-600 dark:text-gray-400">{{ $quote->issue_date->format('d.m.Y') }}</td>
                                        <td class="py-3 text-right font-medium text-gray-900 dark:text-white">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No quotes for this customer.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
