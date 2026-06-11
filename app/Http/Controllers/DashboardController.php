<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Quote;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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

        // Chart: monthly revenue for last 6 months
        $chartLabels = [];
        $chartData = [];
        $now = now();
        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $label = $month->format('M Y');
            $chartLabels[] = $label;

            $revenue = Invoice::where('user_id', $userId)
                ->where('status', 'paid')
                ->whereYear('issue_date', $month->year)
                ->whereMonth('issue_date', $month->month)
                ->sum('total');

            $chartData[] = (float) $revenue;
        }

        $chartConfig = [
            'type' => 'line',
            'data' => [
                'labels' => $chartLabels,
                'datasets' => [[
                    'label' => 'Revenue',
                    'data' => $chartData,
                    'borderColor' => '#4f46e5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'pointBackgroundColor' => '#4f46e5',
                ]],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'x' => ['grid' => ['display' => false]],
                    'y' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(0,0,0,0.06)']],
                ],
            ],
        ];

        // Calendar: invoices for current month grouped by due_date
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();

        $calendarInvoices = Invoice::where('user_id', $userId)
            ->whereBetween('due_date', [$monthStart, $monthEnd])
            ->with('customer')
            ->orderBy('due_date')
            ->get()
            ->groupBy(function ($inv) {
                return $inv->due_date->format('Y-m-d');
            });

        // Build calendar grid
        $period = CarbonPeriod::create($monthStart, $monthEnd);
        $calendarDays = [];
        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            $calendarDays[] = [
                'date' => $date,
                'day' => $date->day,
                'isToday' => $date->isToday(),
                'isPast' => $date->isPast() && !$date->isToday(),
                'invoices' => $calendarInvoices->get($dateStr, collect()),
            ];
        }

        $calendarStartDayOfWeek = $monthStart->dayOfWeek; // 0=Sun, 6=Sat

        return view('dashboard', compact(
            'stats', 'recentInvoices', 'recentQuotes',
            'chartConfig', 'calendarDays', 'calendarStartDayOfWeek'
        ));
    }
}
