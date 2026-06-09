<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-4 bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('settings.update') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Company Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="md:col-span-2">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Address</label>
                            <textarea name="company_address" id="company_address" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label for="company_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Phone</label>
                            <input type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="company_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Email</label>
                            <input type="email" name="company_email" id="company_email" value="{{ old('company_email', $settings['company_email'] ?? '') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="company_tax_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax Number</label>
                            <input type="text" name="company_tax_number" id="company_tax_number" value="{{ old('company_tax_number', $settings['company_tax_number'] ?? '') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Invoice Defaults</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="default_tax_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Default Tax Rate (%)</label>
                            <input type="number" name="default_tax_rate" id="default_tax_rate" value="{{ old('default_tax_rate', $settings['default_tax_rate'] ?? 0) }}" step="0.01" min="0" max="100" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="default_currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Default Currency</label>
                            <select name="default_currency" id="default_currency" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="TRY" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'TRY')>TRY</option>
                                <option value="USD" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'USD')>USD</option>
                                <option value="EUR" @selected(old('default_currency', $settings['default_currency'] ?? 'USD') == 'EUR')>EUR</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
