<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    protected string $baseUrl = 'https://api.frankfurter.app';

    protected array $supportedCurrencies = ['USD', 'EUR', 'GBP', 'TRY', 'CHF', 'CAD', 'AUD', 'JPY', 'CNY', 'BRL'];

    public function getRates(string $base = 'USD'): array
    {
        $cacheKey = "exchange_rates_{$base}";

        return Cache::remember($cacheKey, 3600, function () use ($base) {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/latest", [
                    'from' => $base,
                    'to' => implode(',', $this->supportedCurrencies),
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $rates = $data['rates'] ?? [];

                    $result = [];
                    foreach ($this->supportedCurrencies as $currency) {
                        if ($currency === $base) {
                            $result[$currency] = 1.0;
                        } elseif (isset($rates[$currency])) {
                            $result[$currency] = $rates[$currency];
                        }
                    }
                    return [
                        'base' => $base,
                        'date' => $data['date'] ?? now()->format('Y-m-d'),
                        'rates' => $result,
                    ];
                }
            } catch (\Exception $e) {
                //
            }

            return $this->getFallbackRates($base);
        });
    }

    public function convert(float $amount, string $from, string $to): ?float
    {
        if ($from === $to) {
            return $amount;
        }

        $rates = $this->getRates($from);

        if (!isset($rates['rates'][$to])) {
            return null;
        }

        return round($amount * $rates['rates'][$to], 2);
    }

    public function getSupportedCurrencies(): array
    {
        return $this->supportedCurrencies;
    }

    protected function getFallbackRates(string $base): array
    {
        $fallback = [
            'USD' => ['USD' => 1, 'EUR' => 0.92, 'GBP' => 0.79, 'TRY' => 34.50, 'CHF' => 0.88, 'CAD' => 1.36, 'AUD' => 1.53, 'JPY' => 149.50, 'CNY' => 7.24, 'BRL' => 5.05],
            'EUR' => ['USD' => 1.09, 'EUR' => 1, 'GBP' => 0.86, 'TRY' => 37.50, 'CHF' => 0.96, 'CAD' => 1.48, 'AUD' => 1.66, 'JPY' => 162.50, 'CNY' => 7.87, 'BRL' => 5.49],
            'TRY' => ['USD' => 0.029, 'EUR' => 0.027, 'GBP' => 0.023, 'TRY' => 1, 'CHF' => 0.026, 'CAD' => 0.039, 'AUD' => 0.044, 'JPY' => 4.33, 'CNY' => 0.21, 'BRL' => 0.15],
        ];

        return [
            'base' => $base,
            'date' => now()->format('Y-m-d'),
            'rates' => $fallback[$base] ?? $fallback['USD'],
        ];
    }
}
