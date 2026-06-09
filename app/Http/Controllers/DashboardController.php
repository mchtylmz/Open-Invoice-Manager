<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        $stats = [
            'total_customers' => Customer::where('user_id', $userId)->count(),
            'total_products' => Product::where('user_id', $userId)->count(),
            'total_invoices' => Invoice::where('user_id', $userId)->count(),
            'pending_invoices' => Invoice::where('user_id', $userId)->where('status', 'pending')->count(),
            'total_quotes' => Quote::where('user_id', $userId)->count(),
            'revenue' => Invoice::where('user_id', $userId)->where('status', 'paid')->sum('total'),
        ];

        $recentInvoices = Invoice::where('user_id', $userId)
            ->with('customer')
            ->latest()
            ->take(5)
            ->get();

        $recentQuotes = Quote::where('user_id', $userId)
            ->with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentInvoices', 'recentQuotes'));
    }
}
