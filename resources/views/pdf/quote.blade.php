<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quote {{ $quote->quote_number }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; line-height: 1.6; color: #333; margin: 0; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; }
        .header-left h1 { font-size: 28px; color: #1a1a1a; margin: 0 0 5px 0; text-transform: uppercase; letter-spacing: 2px; }
        .header-left p { color: #666; margin: 0; font-size: 14px; }
        .header-right { text-align: right; }
        .header-right .status { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .status-draft { background: #e5e7eb; color: #374151; }
        .status-sent { background: #dbeafe; color: #1e40af; }
        .status-accepted { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .parties { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .party { width: 45%; }
        .party h3 { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #999; margin: 0 0 8px 0; }
        .party p { margin: 2px 0; color: #333; }
        .party .name { font-weight: bold; font-size: 14px; }
        .dates { margin-bottom: 30px; }
        .dates table { width: 100%; }
        .dates td { width: 33%; padding: 8px 12px; background: #f9fafb; border: 1px solid #e5e7eb; font-size: 11px; }
        .dates td strong { display: block; font-size: 13px; color: #1a1a1a; }
        .dates td span { color: #999; text-transform: uppercase; letter-spacing: 0.5px; font-size: 10px; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table.items th { background: #1a1a1a; color: #fff; padding: 10px 12px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; }
        table.items th.right { text-align: right; }
        table.items td { padding: 10px 12px; border-bottom: 1px solid #e5e7eb; font-size: 12px; }
        table.items td.right { text-align: right; }
        table.items tr:nth-child(even) td { background: #f9fafb; }
        .totals { width: 300px; margin-left: auto; }
        .totals table { width: 100%; }
        .totals td { padding: 6px 12px; font-size: 12px; }
        .totals td.label { color: #666; }
        .totals td.value { text-align: right; }
        .totals tr.total td { font-weight: bold; font-size: 16px; border-top: 2px solid #1a1a1a; padding-top: 10px; color: #1a1a1a; }
        .notes { margin-top: 40px; padding: 16px; background: #f9fafb; border-radius: 4px; }
        .notes h4 { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #999; margin: 0 0 8px 0; }
        .notes p { margin: 0; font-size: 11px; color: #666; }
        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #999; border-top: 1px solid #e5e7eb; padding-top: 20px; }
        @media print { body { padding: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <h1>QUOTE</h1>
            <p>{{ $quote->quote_number }}</p>
        </div>
        <div class="header-right">
            <div class="status status-{{ $quote->status }}">{{ ucfirst($quote->status) }}</div>
        </div>
    </div>

    <div class="parties">
        <div class="party">
            <h3>From</h3>
            <p class="name">{{ auth()->user()->company_name ?? auth()->user()->name }}</p>
            @if(auth()->user()->company_address)
                <p>{!! nl2br(e(auth()->user()->company_address)) !!}</p>
            @endif
            @if(auth()->user()->company_phone)
                <p>{{ auth()->user()->company_phone }}</p>
            @endif
            @if(auth()->user()->company_email)
                <p>{{ auth()->user()->company_email }}</p>
            @endif
            @if(auth()->user()->company_tax_number)
                <p>Tax: {{ auth()->user()->company_tax_number }}</p>
            @endif
        </div>
        <div class="party">
            <h3>Bill To</h3>
            <p class="name">{{ $quote->customer->name }}</p>
            @if($quote->customer->address)
                <p>{!! nl2br(e($quote->customer->address)) !!}</p>
            @endif
            @if($quote->customer->email)
                <p>{{ $quote->customer->email }}</p>
            @endif
            @if($quote->customer->phone)
                <p>{{ $quote->customer->phone }}</p>
            @endif
            @if($quote->customer->tax_number)
                <p>Tax: {{ $quote->customer->tax_number }}</p>
            @endif
        </div>
    </div>

    <div class="dates">
        <table>
            <tr>
                <td><span>Issue Date</span><strong>{{ $quote->issue_date->format('d.m.Y') }}</strong></td>
                <td><span>Valid Until</span><strong>{{ $quote->valid_until ? $quote->valid_until->format('d.m.Y') : '-' }}</strong></td>
                <td><span>Currency</span><strong>{{ $quote->currency }}</strong></td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Description</th>
                <th class="right">Quantity</th>
                <th class="right">Unit Price</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quote->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">{{ number_format($item->unit_price, 2) }}</td>
                    <td class="right">{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td class="label">Subtotal</td>
                <td class="value">{{ number_format($quote->items->sum(fn($i) => $i->quantity * $i->unit_price), 2) }}</td>
            </tr>
            <tr>
                <td class="label">Tax ({{ $quote->tax_rate }}%)</td>
                <td class="value">{{ number_format($quote->items->sum(fn($i) => $i->quantity * $i->unit_price) * $quote->tax_rate / 100, 2) }}</td>
            </tr>
            <tr class="total">
                <td class="label">Total</td>
                <td class="value">{{ number_format($quote->total, 2) }} {{ $quote->currency }}</td>
            </tr>
        </table>
    </div>

    @if($quote->notes)
        <div class="notes">
            <h4>Notes</h4>
            <p>{!! nl2br(e($quote->notes)) !!}</p>
        </div>
    @endif

    <div class="footer">
        Thank you for considering our proposal!
    </div>
</body>
</html>
