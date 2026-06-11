<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Company Information</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Update your business details for invoices and quotes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                        </div>

                        <div>
                            <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Company Address</label>
                            <textarea name="company_address" id="company_address" rows="3" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Company Phone</label>
                                <input type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                            </div>
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Company Email</label>
                                <input type="email" name="company_email" id="company_email" value="{{ old('company_email', $settings['company_email'] ?? '') }}" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                            </div>
                            <div>
                                <label for="company_tax_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tax Number</label>
                                <input type="text" name="company_tax_number" id="company_tax_number" value="{{ old('company_tax_number', $settings['company_tax_number'] ?? '') }}" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/50 dark:to-amber-800/50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Invoice Defaults</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Default values for new invoices and quotes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="default_tax_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Default Tax Rate (%)</label>
                                <input type="number" name="default_tax_rate" id="default_tax_rate" value="{{ old('default_tax_rate', $settings['default_tax_rate'] ?? 0) }}" step="0.01" min="0" max="100" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                            </div>
                            <div>
                                <label for="default_currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Default Currency</label>
                                <select name="default_currency" id="default_currency" class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500/20">
                                    <option value="TRY" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'TRY')>TRY - Turkish Lira</option>
                                    <option value="USD" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'USD')>USD - US Dollar</option>
                                    <option value="EUR" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'EUR')>EUR - Euro</option>
                                    <option value="GBP" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'GBP')>GBP - British Pound</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:from-indigo-600 hover:to-purple-700 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
