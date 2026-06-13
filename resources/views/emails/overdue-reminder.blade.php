<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; color: #1f2937; }
        .container { max-width: 560px; margin: 0 auto; padding: 32px 24px; }
        h1 { font-size: 20px; margin: 0 0 8px; color: #dc2626; }
        p { margin: 0 0 16px; color: #4b5563; }
        .details { background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0; }
        .details th { text-align: left; padding: 4px 12px 4px 0; font-weight: 600; white-space: nowrap; color: #374151; }
        .details td { padding: 4px 0; color: #4b5563; }
        .btn { display: inline-block; padding: 10px 24px; background: #6366f1; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .footer { margin-top: 24px; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Overdue Invoice Reminder</h1>
        <p>The following invoice is <strong>{{ $daysOverdue }} day{{ $daysOverdue > 1 ? 's' : '' }} overdue</strong>.</p>

        <div class="details">
            <table>
                <tr><th>Invoice</th><td>{{ $invoice->invoice_number }}</td></tr>
                <tr><th>Customer</th><td>{{ $invoice->customer?->name ?? '—' }}</td></tr>
                <tr><th>Amount</th><td>{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</td></tr>
                <tr><th>Due Date</th><td>{{ $invoice->due_date->format('M d, Y') }}</td></tr>
                <tr><th>Days Overdue</th><td>{{ $daysOverdue }}</td></tr>
            </table>
        </div>

        <p>
            <a href="{{ route('invoices.show', $invoice) }}" class="btn">View Invoice</a>
        </p>

        <p class="footer">Open Invoice Manager &mdash; Automated reminder</p>
    </div>
</body>
</html>
