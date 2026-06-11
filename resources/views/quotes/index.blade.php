<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Quotes') }}
            </h2>
            <a href="{{ route('quotes.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl text-xs font-semibold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:from-indigo-600 hover:to-purple-700 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Quote
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                    <form action="{{ route('quotes.index') }}" method="GET" class="flex flex-wrap gap-3">
                        <select name="status" class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                            <option value="">All Statuses</option>
                            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                            <option value="sent" @selected(request('status') == 'sent')>Sent</option>
                            <option value="accepted" @selected(request('status') == 'accepted')>Accepted</option>
                            <option value="rejected" @selected(request('status') == 'rejected')>Rejected</option>
                        </select>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                        <div class="relative flex-1 min-w-[200px]">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by number or customer..." class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-xl text-xs font-semibold hover:bg-gray-800 dark:hover:bg-white transition-colors">
                            Filter
                        </button>
                        @if(request()->anyFilled(['search', 'status', 'date_from', 'date_to', 'sort']))
                            <a href="{{ route('quotes.index') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-xl text-xs font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <x-sortable-th :route="'quotes.index'" :field="'quote_number'" :label="'Quote #'" />
                                <th class="px-6 py-4">Customer</th>
                                <x-sortable-th :route="'quotes.index'" :field="'status'" :label="'Status'" />
                                <x-sortable-th :route="'quotes.index'" :field="'issue_date'" :label="'Issue Date'" />
                                <x-sortable-th :route="'quotes.index'" :field="'valid_until'" :label="'Valid Until'" />
                                <x-sortable-th :route="'quotes.index'" :field="'total'" :label="'Total'" />
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                            @forelse($quotes as $quote)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('quotes.show', $quote) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium">
                                            {{ $quote->quote_number }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $quote->customer->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <x-status-badge :status="$quote->status" type="quote" />
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $quote->issue_date->format('d.m.Y') }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $quote->valid_until ? $quote->valid_until->format('d.m.Y') : '-' }}</td>
                                    <td class="px-6 py-4 text-right font-medium text-gray-900 dark:text-white">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('quotes.show', $quote) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                View
                                            </a>
                                            <a href="{{ route('quotes.edit', $quote) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                            <p class="text-gray-500 dark:text-gray-400 font-medium">No quotes found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($quotes->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $quotes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
