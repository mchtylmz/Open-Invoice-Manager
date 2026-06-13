<?php

namespace App\Http\Controllers;

use App\Services\ExchangeRateService;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, ExchangeRateService $exchangeRateService)
    {
        $base = $request->query('base', 'USD');
        $base = strtoupper($base);

        if (!in_array($base, $exchangeRateService->getSupportedCurrencies())) {
            $base = 'USD';
        }

        $rates = $exchangeRateService->getRates($base);
        $supportedCurrencies = $exchangeRateService->getSupportedCurrencies();

        return view('exchange-rates.index', compact('rates', 'base', 'supportedCurrencies'));
    }

    public function convert(Request $request, ExchangeRateService $exchangeRateService)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
        ]);

        $result = $exchangeRateService->convert(
            (float) $request->amount,
            strtoupper($request->from),
            strtoupper($request->to)
        );

        if ($result === null) {
            return back()->with('error', 'Conversion failed. Please try again.');
        }

        return back()->with('conversion_result', [
            'amount' => (float) $request->amount,
            'from' => strtoupper($request->from),
            'to' => strtoupper($request->to),
            'result' => $result,
        ]);
    }
}
