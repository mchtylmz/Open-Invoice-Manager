<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invoice') }} {{ $invoice->invoice_number }}
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('invoices.pdf', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    PDF Export
                </a>
                <a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    Edit
                </a>
                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">INVOICE</h3>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mt-1">{{ $invoice->invoice_number }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">From</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ auth()->user()->company_name ?? auth()->user()->name }}</p>
                            @if(auth()->user()->company_address)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{!! nl2br(e(auth()->user()->company_address)) !!}</p>
                            @endif
                            @if(auth()->user()->company_phone)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->company_phone }}</p>
                            @endif
                            @if(auth()->user()->company_email)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->company_email }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Bill To</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $invoice->customer->name }}</p>
                            @if($invoice->customer->address)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{!! nl2br(e($invoice->customer->address)) !!}</p>
                            @endif
                            @if($invoice->customer->email)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $invoice->customer->email }}</p>
                            @endif
                            @if($invoice->customer->phone)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $invoice->customer->phone }}</p>
                            @endif
                            @if($invoice->customer->tax_number)
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tax: {{ $invoice->customer->tax_number }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Issue Date</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $invoice->issue_date->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Due Date</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $invoice->due_date->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Currency</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $invoice->currency }}</p>
                        </div>
                    </div>

                    <table class="w-full text-sm mb-6">
                        <thead>
                            <tr class="text-left border-b-2 border-gray-200 dark:border-gray-700">
                                <th class="pb-3 text-gray-500 dark:text-gray-400 font-medium">Description</th>
                                <th class="pb-3 text-gray-500 dark:text-gray-400 font-medium text-right">Quantity</th>
                                <th class="pb-3 text-gray-500 dark:text-gray-400 font-medium text-right">Unit Price</th>
                                <th class="pb-3 text-gray-500 dark:text-gray-400 font-medium text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->items as $item)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-3 text-gray-900 dark:text-white">{{ $item->description }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300 text-right">{{ $item->quantity }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300 text-right">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300 text-right">{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <div class="w-64 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Subtotal:</span>
                                <span>{{ number_format($invoice->items->sum(fn($i) => $i->quantity * $i->unit_price), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Tax ({{ $invoice->tax_rate }}%):</span>
                                <span>{{ number_format($invoice->items->sum(fn($i) => $i->quantity * $i->unit_price) * $invoice->tax_rate / 100, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white border-t-2 border-gray-200 dark:border-gray-700 pt-2">
                                <span>Total:</span>
                                <span>{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</span>
                            </div>
                        </div>
                    </div>

                    @if($invoice->notes)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Notes</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{!! nl2br(e($invoice->notes)) !!}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
