<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');
        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $sort = in_array(request('sort'), ['quote_number', 'status', 'issue_date', 'valid_until', 'total', 'created_at']) ? request('sort') : 'created_at';
        $direction = request('direction') === 'asc' ? 'asc' : 'desc';

        $quotes = Quote::where('user_id', Auth::id())
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                return $query->whereDate('issue_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query, $dateTo) {
                return $query->whereDate('issue_date', '<=', $dateTo);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('quote_number', 'like', "%{$search}%")
                      ->orWhereHas('customer', function ($cq) use ($search) {
                          $cq->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->with('customer')
            ->orderBy($sort, $direction)
            ->paginate(15);

        return view('quotes.index', compact('quotes', 'sort', 'direction'));
    }

    public function create()
    {
        $customers = Customer::where('user_id', Auth::id())->get();
        $products = Product::where('user_id', Auth::id())->get();

        return view('quotes.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'issue_date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|string|in:draft,sent,accepted,rejected',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'currency' => 'required|string|max:10',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.product_id' => 'nullable|exists:products,id',
        ]);

        $items = $request->items;

        $subtotal = collect($items)->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        $taxAmount = $subtotal * $validated['tax_rate'] / 100;
        $total = $subtotal + $taxAmount;

        $quoteNumber = $this->generateQuoteNumber();

        $quote = Quote::create([
            'user_id' => Auth::id(),
            'customer_id' => $validated['customer_id'],
            'quote_number' => $quoteNumber,
            'issue_date' => $validated['issue_date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $validated['tax_rate'],
            'tax_amount' => $taxAmount,
            'total' => $total,
            'currency' => $validated['currency'],
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($items as $item) {
            $itemTotal = $item['quantity'] * $item['unit_price'];
            $quote->items()->create([
                'product_id' => $item['product_id'] ?? null,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total' => $itemTotal,
            ]);
        }

        return redirect()->route('quotes.index')
            ->with('success', 'Quote created successfully.');
    }

    public function show(Quote $quote)
    {
        if ($quote->user_id !== Auth::id()) {
            abort(403);
        }

        $quote->load(['customer', 'items', 'items.product']);

        return view('quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        if ($quote->user_id !== Auth::id()) {
            abort(403);
        }

        $customers = Customer::where('user_id', Auth::id())->get();
        $products = Product::where('user_id', Auth::id())->get();
        $quote->load('items');

        return view('quotes.edit', compact('quote', 'customers', 'products'));
    }

    public function update(Request $request, Quote $quote)
    {
        if ($quote->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'issue_date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|string|in:draft,sent,accepted,rejected',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'currency' => 'required|string|max:10',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.product_id' => 'nullable|exists:products,id',
        ]);

        $items = $request->items;

        $subtotal = collect($items)->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        $taxAmount = $subtotal * $validated['tax_rate'] / 100;
        $total = $subtotal + $taxAmount;

        $quote->update([
            'customer_id' => $validated['customer_id'],
            'issue_date' => $validated['issue_date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $validated['tax_rate'],
            'tax_amount' => $taxAmount,
            'total' => $total,
            'currency' => $validated['currency'],
            'notes' => $validated['notes'] ?? null,
        ]);

        $quote->items()->delete();

        foreach ($items as $item) {
            $itemTotal = $item['quantity'] * $item['unit_price'];
            $quote->items()->create([
                'product_id' => $item['product_id'] ?? null,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total' => $itemTotal,
            ]);
        }

        return redirect()->route('quotes.index')
            ->with('success', 'Quote updated successfully.');
    }

    public function destroy(Quote $quote)
    {
        if ($quote->user_id !== Auth::id()) {
            abort(403);
        }

        $quote->items()->delete();
        $quote->delete();

        return redirect()->route('quotes.index')
            ->with('success', 'Quote deleted successfully.');
    }

    public function pdf(Quote $quote)
    {
        if ($quote->user_id !== Auth::id()) {
            abort(403);
        }

        $quote->load(['customer', 'items', 'items.product']);

        $pdf = Pdf::loadView('pdf.quote', compact('quote'));

        return $pdf->download("quote-{$quote->quote_number}.pdf");
    }

    private function generateQuoteNumber()
    {
        $prefix = 'QTE-' . now()->format('Ym') . '-';
        $lastQuote = Quote::where('user_id', Auth::id())
            ->where('quote_number', 'like', $prefix . '%')
            ->orderBy('quote_number', 'desc')
            ->first();

        if ($lastQuote) {
            $lastNumber = (int) substr($lastQuote->quote_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
