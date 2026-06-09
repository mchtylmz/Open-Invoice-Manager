<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invoices') }}
            </h2>
            <a href="{{ route('invoices.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                + Add Invoice
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('invoices.index') }}" method="GET" class="flex gap-4">
                        <select name="status" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Statuses</option>
                            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                            <option value="paid" @selected(request('status') == 'paid')>Paid</option>
                            <option value="overdue" @selected(request('status') == 'overdue')>Overdue</option>
                            <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
                        </select>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by invoice number or customer..." class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-lg font-medium text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                            Filter
                        </button>
                    </form>
                </div>

                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                <th class="pb-3 font-medium">Invoice Number</th>
                                <th class="pb-3 font-medium">Customer</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th class="pb-3 font-medium">Issue Date</th>
                                <th class="pb-3 font-medium">Due Date</th>
                                <th class="pb-3 font-medium text-right">Total</th>
                                <th class="pb-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-3">
                                        <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
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
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $invoice->issue_date->format('d.m.Y') }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $invoice->due_date->format('d.m.Y') }}</td>
                                    <td class="py-3 text-right text-gray-700 dark:text-gray-300">{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td>
                                    <td class="py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('invoices.edit', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Edit</a>
                                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-6 text-center text-gray-500 dark:text-gray-400">No invoices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
