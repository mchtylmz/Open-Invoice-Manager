<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                + Add Product
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
                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                <th class="pb-3 font-medium">Name</th>
                                <th class="pb-3 font-medium">Unit Price</th>
                                <th class="pb-3 font-medium">Unit Type</th>
                                <th class="pb-3 font-medium">Currency</th>
                                <th class="pb-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-3 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ number_format($product->unit_price, 2) }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ ucfirst($product->unit_type) }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $product->currency }}</td>
                                    <td class="py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
