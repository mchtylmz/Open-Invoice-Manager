<x-app-layout>
    <div x-data="dashboardWidgets()" x-init="init()">
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <button @click="showSettings = !showSettings" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Customize
                </button>
            </div>
        </x-slot>

        <!-- Widget Settings Panel -->
        <div x-show="showSettings" x-cloak x-transition class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Toggle Widgets</h3>
                <div class="flex flex-wrap gap-3">
                    <template x-for="(w, key) in widgets" :key="key">
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border cursor-pointer transition-colors"
                               :class="w.visible ? 'border-indigo-200 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-500 hover:border-gray-300'">
                            <input type="checkbox" x-model="w.visible" @change="save()" class="sr-only">
                            <span class="text-sm font-medium" x-text="w.label"></span>
                        </label>
                    </template>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                @if (session('reminder_sent'))
                    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 text-sm text-emerald-700">
                        {{ session('reminder_sent') }}
                    </div>
                @endif

                <!-- Stats Row -->
                <div x-show="widgets.stats.visible" x-transition class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_customers'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500">Customers</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500">Products</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_invoices'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500">Total Invoices</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_invoices'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500">Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_quotes'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500">Quotes</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['revenue'] ?? 0, 2) }} {{ $stats['currency'] ?? 'USD' }}</p>
                                <p class="text-xs text-gray-500">Revenue</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overdue Reminder Banner -->
                @if(($stats['overdue_invoices'] ?? 0) > 0)
                    <div x-show="widgets.stats.visible" x-transition class="bg-red-50 border border-red-200 rounded-2xl px-6 py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            <div>
                                <p class="text-sm font-semibold text-red-800">{{ $stats['overdue_invoices'] }} overdue invoice{{ $stats['overdue_invoices'] > 1 ? 's' : '' }} pending</p>
                                <p class="text-xs text-red-600">Send email reminders to stay on top of payments.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('reminders.overdue.send') }}" class="flex-shrink-0">
                            @csrf
                            <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-colors">
                                Send Reminders
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Chart + Calendar Row -->
                <div class="grid lg:grid-cols-5 gap-6">
                    <!-- Revenue Chart -->
                    <div x-show="widgets.chart.visible" x-transition class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-900">Revenue (Last 6 Months)</h3>
                            <span class="text-xs text-gray-400">{{ $stats['currency'] ?? 'USD' }}</span>
                        </div>
                        <div class="p-6">
                            <div class="relative" style="height: 260px;">
                                <canvas data-chart='{{ json_encode($chartConfig) }}'></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Calendar -->
                    <div x-show="widgets.calendar.visible" x-transition class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-900">{{ now()->format('F Y') }}</h3>
                            <span class="text-xs text-gray-400">Due Dates</span>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-7 text-center text-xs font-semibold text-gray-400 mb-2 uppercase tracking-wider">
                                <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                            </div>
                            <div class="grid grid-cols-7 text-center">
                                @for ($i = 0; $i < $calendarStartDayOfWeek; $i++)
                                    <div class="p-1.5"></div>
                                @endfor
                                @foreach ($calendarDays as $day)
                                    <div class="p-1.5 relative {{ $day['isToday'] ? 'bg-indigo-50 rounded-lg' : '' }} {{ $day['isPast'] && $day['invoices']->count() > 0 ? 'bg-red-50 rounded-lg' : '' }}">
                                        <span class="text-sm font-medium {{ $day['isToday'] ? 'text-indigo-600' : ($day['isPast'] ? 'text-gray-400' : 'text-gray-700') }}">
                                            {{ $day['day'] }}
                                        </span>
                                        @if ($day['invoices']->count() > 0)
                                            <div class="mt-0.5 space-y-0.5">
                                                @foreach ($day['invoices'] as $inv)
                                                    <a href="{{ route('invoices.show', $inv) }}"
                                                       class="block text-[10px] leading-tight truncate rounded px-1 py-0.5 font-medium
                                                           {{ $inv->status === 'paid' ? 'bg-green-100 text-green-700' : ($inv->status === 'overdue' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                                        {{ $inv->invoice_number }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-3 flex items-center gap-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded bg-amber-100 border border-amber-200"></span> Pending</span>
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded bg-green-100 border border-green-200"></span> Paid</span>
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded bg-red-100 border border-red-200"></span> Overdue</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div x-show="widgets.activities.visible" x-transition class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900">Recent Activities</h3>
                    </div>
                    <div class="p-6">
                        @if($recentActivities->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentActivities as $activity)
                                    <div class="flex items-start gap-3 text-sm">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0
                                            {{ $activity->action === 'created' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                            {{ $activity->action === 'updated' ? 'bg-blue-50 text-blue-600' : '' }}
                                            {{ $activity->action === 'deleted' ? 'bg-red-50 text-red-600' : '' }}
                                            {{ $activity->action === 'emailed' ? 'bg-purple-50 text-purple-600' : '' }}">
                                            @if($activity->action === 'created')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            @elseif($activity->action === 'updated')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            @elseif($activity->action === 'deleted')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            @elseif($activity->action === 'emailed')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-gray-700">{{ $activity->description }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No activities yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Tables Row -->
                <div class="grid lg:grid-cols-2 gap-6">
                    <div x-show="widgets.invoices.visible" x-transition class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-900">Recent Invoices</h3>
                            <a href="{{ route('invoices.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View All</a>
                        </div>
                        <div class="p-6">
                            @if($recentInvoices->count() > 0)
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="text-left text-gray-500 border-b border-gray-200">
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Number</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Customer</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Status</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentInvoices as $invoice)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                <td class="py-3">
                                                    <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">{{ $invoice->invoice_number }}</a>
                                                </td>
                                                <td class="py-3 text-gray-600">{{ $invoice->customer->name ?? '-' }}</td>
                                                <td class="py-3"><x-status-badge :status="$invoice->status" type="invoice" /></td>
                                                <td class="py-3 text-right font-medium text-gray-900">{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-sm text-gray-500">No recent invoices.</p>
                            @endif
                        </div>
                    </div>

                    <div x-show="widgets.quotes.visible" x-transition class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-900">Recent Quotes</h3>
                            <a href="{{ route('quotes.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View All</a>
                        </div>
                        <div class="p-6">
                            @if($recentQuotes->count() > 0)
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="text-left text-gray-500 border-b border-gray-200">
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Number</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Customer</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Status</th>
                                            <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentQuotes as $quote)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                <td class="py-3">
                                                    <a href="{{ route('quotes.show', $quote) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">{{ $quote->quote_number }}</a>
                                                </td>
                                                <td class="py-3 text-gray-600">{{ $quote->customer->name ?? '-' }}</td>
                                                <td class="py-3"><x-status-badge :status="$quote->status" type="quote" /></td>
                                                <td class="py-3 text-right font-medium text-gray-900">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-sm text-gray-500">No recent quotes.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dashboardWidgets() {
            return {
                showSettings: false,
                widgets: {
                    stats: { label: 'Statistics', visible: true },
                    chart: { label: 'Revenue Chart', visible: true },
                    calendar: { label: 'Payment Calendar', visible: true },
                    invoices: { label: 'Recent Invoices', visible: true },
                    quotes: { label: 'Recent Quotes', visible: true },
                    activities: { label: 'Recent Activities', visible: true },
                },
                init() {
                    const saved = localStorage.getItem('dashboard_widgets');
                    if (saved) {
                        try {
                            const parsed = JSON.parse(saved);
                            Object.keys(this.widgets).forEach((key) => {
                                if (parsed[key] !== undefined) {
                                    this.widgets[key].visible = parsed[key];
                                }
                            });
                        } catch (e) {}
                    }
                },
                save() {
                    const state = {};
                    Object.keys(this.widgets).forEach((key) => {
                        state[key] = this.widgets[key].visible;
                    });
                    localStorage.setItem('dashboard_widgets', JSON.stringify(state));
                }
            }
        }
    </script>
</x-app-layout>
