<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
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

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('products.update', $product) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <x-form-input label="Name" name="name" type="text" :value="$product->name" :required="true" placeholder="Product name" />
                        </div>

                        <div class="md:col-span-2">
                            <x-form-input label="Description" name="description" type="textarea" :value="$product->description" placeholder="Product description" />
                        </div>

                        <x-form-input label="Unit Price" name="unit_price" type="number" :value="$product->unit_price" :required="true" step="0.01" placeholder="0.00" />

                        <x-form-input label="Unit Type" name="unit_type" type="select" :required="true">
                            <option value="piece" @selected(old('unit_type', $product->unit_type) == 'piece')>Piece</option>
                            <option value="hour" @selected(old('unit_type', $product->unit_type) == 'hour')>Hour</option>
                            <option value="month" @selected(old('unit_type', $product->unit_type) == 'month')>Month</option>
                            <option value="service" @selected(old('unit_type', $product->unit_type) == 'service')>Service</option>
                        </x-form-input>

                        <x-form-input label="Currency" name="currency" type="select" :required="true">
                            <option value="TRY" @selected(old('currency', $product->currency) == 'TRY')>TRY</option>
                            <option value="USD" @selected(old('currency', $product->currency) == 'USD')>USD</option>
                            <option value="EUR" @selected(old('currency', $product->currency) == 'EUR')>EUR</option>
                        </x-form-input>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:from-indigo-600 hover:to-purple-700 transition-all">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
