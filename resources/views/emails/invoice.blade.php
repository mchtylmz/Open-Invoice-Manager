<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: system-ui, sans-serif; padding: 24px;">
    <h2>Invoice {{ $invoice->invoice_number }}</h2>
    <p>Dear {{ $invoice->customer->name ?? 'Customer' }},</p>
    <p>Please find attached invoice <strong>{{ $invoice->invoice_number }}</strong> in PDF format.</p>
    <p>Total: <strong>{{ number_format($invoice->total, 2) }} {{ $invoice->currency }}</strong></p>
    <p>Due Date: {{ $invoice->due_date->format('d.m.Y') }}</p>
    <br>
    <p>Thank you for your business.</p>
</body>
</html>
