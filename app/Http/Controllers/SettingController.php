<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();
        $settings = Setting::where('user_id', $userId)->pluck('value', 'key')->toArray();

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_tax_number' => 'nullable|string|max:50',
            'company_phone' => 'nullable|string|max:50',
            'company_email' => 'nullable|email|max:255',
            'default_tax_rate' => 'nullable|numeric|min:0|max:100',
            'default_currency' => 'nullable|string|max:10',
        ]);

        $userId = Auth::id();

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['user_id' => $userId, 'key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
