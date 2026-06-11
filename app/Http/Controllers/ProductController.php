<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $search = request('search');
        $sort = in_array(request('sort'), ['name', 'unit_price', 'unit_type', 'currency', 'created_at']) ? request('sort') : 'created_at';
        $direction = request('direction') === 'asc' ? 'asc' : 'desc';

        $products = Product::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(15);

        return view('products.index', compact('products', 'sort', 'direction'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'unit_type' => 'required|string|max:50',
            'currency' => 'required|string|max:10',
        ]);

        $validated['user_id'] = Auth::id();

        $product = Product::create($validated);

        ActivityService::log('created', $product, 'Product created: ' . $product->name);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
            'unit_type' => 'required|string|max:50',
            'currency' => 'required|string|max:10',
        ]);

        $product->update($validated);

        ActivityService::log('updated', $product, 'Product updated: ' . $product->name);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        ActivityService::log('deleted', $product, 'Product deleted: ' . $product->name);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function exportCsv()
    {
        $products = Product::where('user_id', Auth::id())->get();

        $headers = ['Name', 'Description', 'Unit Price', 'Unit Type', 'Currency', 'Created At'];
        $rows = $products->map(fn($p) => [
            $p->name, $p->description, number_format($p->unit_price, 2),
            $p->unit_type, $p->currency, $p->created_at->format('d.m.Y'),
        ]);

        $callback = function () use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->streamDownload($callback, 'products.csv');
    }
}
