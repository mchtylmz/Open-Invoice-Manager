<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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
                <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Invoice Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        <x-form-input label="Customer" name="customer_id" type="select" :required="true">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(old('customer_id', $invoice->customer_id) == $customer->id)>{{ $customer->name }}</option>
                            @endforeach
                        </x-form-input>

                        <x-form-input label="Status" name="status" type="select" :required="true">
                            <option value="draft" @selected(old('status', $invoice->status) == 'draft')>Draft</option>
                            <option value="pending" @selected(old('status', $invoice->status) == 'pending')>Pending</option>
                            <option value="paid" @selected(old('status', $invoice->status) == 'paid')>Paid</option>
                            <option value="overdue" @selected(old('status', $invoice->status) == 'overdue')>Overdue</option>
                            <option value="cancelled" @selected(old('status', $invoice->status) == 'cancelled')>Cancelled</option>
                        </x-form-input>

                        <x-form-input label="Issue Date" name="issue_date" type="date" :value="$invoice->issue_date->format('Y-m-d')" :required="true" />

                        <x-form-input label="Due Date" name="due_date" type="date" :value="$invoice->due_date->format('Y-m-d')" :required="true" />

                        <x-form-input label="Tax Rate (%)" name="tax_rate" type="number" :value="$invoice->tax_rate" step="0.01" min="0" max="100" />

                        <x-form-input label="Currency" name="currency" type="select" :required="true">
                            <option value="TRY" @selected(old('currency', $invoice->currency) == 'TRY')>TRY</option>
                            <option value="USD" @selected(old('currency', $invoice->currency) == 'USD')>USD</option>
                            <option value="EUR" @selected(old('currency', $invoice->currency) == 'EUR')>EUR</option>
                        </x-form-input>

                        <div class="md:col-span-2">
                            <x-form-input label="Notes" name="notes" type="textarea" :value="$invoice->notes" placeholder="Additional notes..." />
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Invoice Items</h3>
                    <div id="items-container">
                        <table class="w-full text-sm mb-4">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 font-medium w-1/3">Product / Description</th>
                                    <th class="pb-3 font-medium">Quantity</th>
                                    <th class="pb-3 font-medium">Unit Price</th>
                                    <th class="pb-3 font-medium text-right">Total</th>
                                    <th class="pb-3 font-medium text-right w-20">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="items-body">
                                @foreach($invoice->items as $i => $item)
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="py-2">
                                        <select name="items[{{ $i }}][product_id]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            <option value="">Manual entry</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}" @selected($item->product_id == $product->id)>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="items[{{ $i }}][description]" value="{{ $item->description }}" placeholder="Description" class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </td>
                                    <td class="py-2">
                                        <input type="number" name="items[{{ $i }}][quantity]" value="{{ $item->quantity }}" min="1" step="1" class="item-qty w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </td>
                                    <td class="py-2">
                                        <input type="number" name="items[{{ $i }}][unit_price]" value="{{ $item->unit_price }}" step="0.01" min="0" class="item-price w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </td>
                                    <td class="py-2 text-right">
                                        <span class="item-total text-gray-700 dark:text-gray-300">{{ number_format($item->quantity * $item->unit_price, 2) }}</span>
                                    </td>
                                    <td class="py-2 text-right">
                                        <button type="button" onclick="this.closest('tr').remove(); recalcTotals();" class="text-red-600 dark:text-red-400 hover:underline text-sm">Remove</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="button" id="add-item" class="inline-flex items-center px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition mb-6">
                        + Add Item
                    </button>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
                        <div class="flex justify-end">
                            <div class="w-64 space-y-2">
                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">{{ number_format($invoice->items->sum(fn($i) => $i->quantity * $i->unit_price), 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                    <span>Tax (<span id="tax-rate-display">{{ $invoice->tax_rate }}</span>%):</span>
                                    <span id="tax-amount">{{ number_format($invoice->items->sum(fn($i) => $i->quantity * $i->unit_price) * $invoice->tax_rate / 100, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base font-semibold text-gray-900 dark:text-white border-t border-gray-200 dark:border-gray-700 pt-2">
                                    <span>Total:</span>
                                    <span id="grand-total">{{ number_format($invoice->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('invoices.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:from-indigo-600 hover:to-purple-700 transition-all">
                            Update Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let itemIndex = {{ count($invoice->items) }};

        document.getElementById('add-item').addEventListener('click', function() {
            const tbody = document.getElementById('items-body');
            const tr = document.createElement('tr');
            tr.className = 'border-b border-gray-100 dark:border-gray-700/50';
            tr.innerHTML = `
                <td class="py-2">
                    <select name="items[${itemIndex}][product_id]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">Manual entry</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="items[${itemIndex}][description]" placeholder="Description" class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </td>
                <td class="py-2">
                    <input type="number" name="items[${itemIndex}][quantity]" value="1" min="1" step="1" class="item-qty w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </td>
                <td class="py-2">
                    <input type="number" name="items[${itemIndex}][unit_price]" value="0" step="0.01" min="0" class="item-price w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </td>
                <td class="py-2 text-right">
                    <span class="item-total text-gray-700 dark:text-gray-300">0.00</span>
                </td>
                <td class="py-2 text-right">
                    <button type="button" onclick="this.closest('tr').remove(); recalcTotals();" class="text-red-600 dark:text-red-400 hover:underline text-sm">Remove</button>
                </td>
            `;
            tbody.appendChild(tr);
            itemIndex++;
        });

        document.addEventListener('input', function(e) {
            if (e.target.closest('#items-body')) {
                const row = e.target.closest('tr');
                if (row) recalcRow(row);
                recalcTotals();
            }
            if (e.target.id === 'tax_rate') {
                document.getElementById('tax-rate-display').textContent = e.target.value || '0';
                recalcTotals();
            }
        });

        function recalcRow(row) {
            const qty = parseFloat(row.querySelector('.item-qty')?.value) || 0;
            const price = parseFloat(row.querySelector('.item-price')?.value) || 0;
            const total = qty * price;
            const totalSpan = row.querySelector('.item-total');
            if (totalSpan) totalSpan.textContent = total.toFixed(2);
        }

        function recalcTotals() {
            let subtotal = 0;
            document.querySelectorAll('.item-total').forEach(function(span) {
                subtotal += parseFloat(span.textContent) || 0;
            });
            const taxRate = parseFloat(document.getElementById('tax_rate')?.value) || 0;
            const taxAmount = subtotal * (taxRate / 100);
            const grandTotal = subtotal + taxAmount;

            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('tax-amount').textContent = taxAmount.toFixed(2);
            document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
        }

        recalcTotals();
    </script>
    @endpush
</x-app-layout>
