<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customers') }}
            </h2>
            <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                + Add Customer
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
                    <form action="{{ route('customers.index') }}" method="GET" class="flex gap-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers..." class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-lg font-medium text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                            Search
                        </button>
                        @if(request()->anyFilled(['search', 'sort']))
                            <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-lg font-medium text-xs text-gray-600 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>

                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                <x-sortable-th :route="'customers.index'" :field="'name'" :label="'Name'" />
                                <x-sortable-th :route="'customers.index'" :field="'email'" :label="'Email'" />
                                <x-sortable-th :route="'customers.index'" :field="'phone'" :label="'Phone'" />
                                <x-sortable-th :route="'customers.index'" :field="'tax_number'" :label="'Tax Number'" />
                                <th class="pb-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-3">
                                        <a href="{{ route('customers.show', $customer) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                                            {{ $customer->name }}
                                        </a>
                                    </td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $customer->email ?? '-' }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $customer->phone ?? '-' }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-300">{{ $customer->tax_number ?? '-' }}</td>
                                    <td class="py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('customers.edit', $customer) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">No customers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
