<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exchange Rates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Info -->
            <div class="bg-indigo-50 border border-indigo-200 rounded-2xl px-6 py-4 text-sm text-indigo-700">
                <strong>Live rates</strong> fetched from <a href="https://www.frankfurter.app" target="_blank" class="underline">Frankfurter API</a>.
                Updated hourly. <strong>Base:</strong>
                <form method="GET" action="{{ route('exchange-rates.index') }}" class="inline">
                    <select name="base" onchange="this.form.submit()" class="inline-block bg-white border border-indigo-200 rounded-lg px-2.5 py-1 text-sm font-medium text-indigo-700">
                        @foreach($supportedCurrencies as $currency)
                            <option value="{{ $currency }}" {{ $base === $currency ? 'selected' : '' }}>{{ $currency }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if (session('conversion_result'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 text-sm text-emerald-700">
                    <strong>{{ number_format(session('conversion_result')['amount'], 2) }} {{ session('conversion_result')['from'] }}</strong>
                    =
                    <strong>{{ number_format(session('conversion_result')['result'], 4) }} {{ session('conversion_result')['to'] }}</strong>
                </div>
            @endif

            <!-- Converter -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-base font-semibold text-gray-900">Currency Converter</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('exchange-rates.convert') }}" class="flex flex-col sm:flex-row items-end gap-3">
                        @csrf
                        <div class="flex-1 w-full">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Amount</label>
                            <input type="number" step="0.01" min="0" name="amount" required value="{{ old('amount') }}" class="w-full border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="100">
                        </div>
                        <div class="w-full sm:w-36">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">From</label>
                            <select name="from" class="w-full border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                @foreach($supportedCurrencies as $currency)
                                    <option value="{{ $currency }}" {{ $base === $currency ? 'selected' : '' }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-36">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">To</label>
                            <select name="to" class="w-full border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                @foreach($supportedCurrencies as $currency)
                                    <option value="{{ $currency }}" {{ $currency === 'TRY' ? 'selected' : '' }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors whitespace-nowrap">Convert</button>
                    </form>
                </div>
            </div>

            <!-- Rates Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Rates ({{ $base }})</h3>
                    <span class="text-xs text-gray-400">Date: {{ $rates['date'] }}</span>
                </div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b border-gray-200">
                                <th class="pb-3 font-semibold text-xs uppercase tracking-wider">Currency</th>
                                <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Rate</th>
                                <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">1 {{ $base }} →</th>
                                <th class="pb-3 font-semibold text-xs uppercase tracking-wider text-right">Inverse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supportedCurrencies as $currency)
                                @if(isset($rates['rates'][$currency]))
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $currency === $base ? 'bg-gray-50 font-semibold' : '' }}">
                                        <td class="py-2.5">
                                            <span class="inline-flex items-center gap-2">
                                                <span class="w-8 h-5 rounded flex items-center justify-center text-[10px] font-bold text-white
                                                    {{ $currency === 'USD' ? 'bg-green-600' : '' }}
                                                    {{ $currency === 'EUR' ? 'bg-blue-600' : '' }}
                                                    {{ $currency === 'GBP' ? 'bg-purple-600' : '' }}
                                                    {{ $currency === 'TRY' ? 'bg-red-600' : '' }}
                                                    {{ $currency === 'CHF' ? 'bg-orange-600' : '' }}
                                                    {{ $currency === 'CAD' ? 'bg-red-500' : '' }}
                                                    {{ $currency === 'AUD' ? 'bg-yellow-600' : '' }}
                                                    {{ $currency === 'JPY' ? 'bg-gray-700' : '' }}
                                                    {{ $currency === 'CNY' ? 'bg-rose-600' : '' }}
                                                    {{ $currency === 'BRL' ? 'bg-emerald-600' : '' }}">{{ substr($currency, 0, 1) }}</span>
                                                {{ $currency }}
                                            </span>
                                        </td>
                                        <td class="py-2.5 text-right font-medium {{ $currency === $base ? 'text-gray-900' : 'text-gray-600' }}">
                                            {{ $currency === $base ? '—' : number_format($rates['rates'][$currency], 4) }}
                                        </td>
                                        <td class="py-2.5 text-right text-gray-600">
                                            {{ $currency === $base ? '—' : '1 ' . $base . ' = ' . number_format($rates['rates'][$currency], 4) . ' ' . $currency }}
                                        </td>
                                        <td class="py-2.5 text-right text-gray-600">
                                            @if($currency !== $base && $rates['rates'][$currency] > 0)
                                                1 {{ $currency }} = {{ number_format(1 / $rates['rates'][$currency], 4) }} {{ $base }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
