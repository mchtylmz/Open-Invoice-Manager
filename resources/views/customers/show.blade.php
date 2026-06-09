<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $customer->name }}
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    Edit
                </a>
                <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Customer Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                            <p class="text-gray-900 dark:text-white">{{ $customer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                            <p class="text-gray-900 dark:text-white">{{ $customer->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                            <p class="text-gray-900 dark:text-white">{{ $customer->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tax Number</p>
                            <p class="text-gray-900 dark:text-white">{{ $customer->tax_number ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Address</p>
                            <p class="text-gray-900 dark:text-white">{!! nl2br(e($customer->address ?? '-')) !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Invoices</h3>
                </div>
                <div class="p-6">
                    @if($customer->invoices->count() > 0)
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 font-medium">Invoice Number</th>
                                    <th class="pb-3 font-medium">Status</th>
                                    <th class="pb-3 font-medium">Issue Date</th>
                                    <th class="pb-3 font-medium text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->invoices as $invoice)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                        <td class="py-3">
                                            <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                {{ $invoice->invoice_number }}
                                            </a>
                                        </td>
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
                                        <td class="py-3 text-gray-700 dark:text-gray-300">{{ $invoice->issue_date->format('d.m.Y') }}</td>
                                        <td class="py-3 text-right text-gray-700 dark:text-gray-300">{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No invoices for this customer.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quotes</h3>
                </div>
                <div class="p-6">
                    @if($customer->quotes->count() > 0)
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 font-medium">Quote Number</th>
                                    <th class="pb-3 font-medium">Status</th>
                                    <th class="pb-3 font-medium">Issue Date</th>
                                    <th class="pb-3 font-medium text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->quotes as $quote)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                        <td class="py-3">
                                            <a href="{{ route('quotes.show', $quote) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                {{ $quote->quote_number }}
                                            </a>
                                        </td>
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
                                        <td class="py-3 text-gray-700 dark:text-gray-300">{{ $quote->issue_date->format('d.m.Y') }}</td>
                                        <td class="py-3 text-right text-gray-700 dark:text-gray-300">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No quotes for this customer.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
