<?php

namespace App\Console\Commands;

use App\Mail\OverdueReminderMail;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendOverdueReminders extends Command
{
    protected $signature = 'reminders:overdue
        {--user= : Send reminders only for a specific user ID}
        {--dry-run : List invoices that would receive reminders without sending}';

    protected $description = 'Send email reminders for overdue invoices';

    public function handle(): int
    {
        $overdueInvoices = Invoice::query()
            ->where('status', 'pending')
            ->where('due_date', '<', now()->startOfDay())
            ->with('customer')
            ->get();

        if ($overdueInvoices->isEmpty()) {
            $this->info('No overdue invoices found.');
            return Command::SUCCESS;
        }

        $userId = $this->option('user');
        $dryRun = $this->option('dry-run');

        $sent = 0;
        foreach ($overdueInvoices as $invoice) {
            if ($userId && (int) $invoice->user_id !== (int) $userId) {
                continue;
            }

            $daysOverdue = (int) now()->startOfDay()->diffInDays($invoice->due_date);

            if ($dryRun) {
                $this->line("[DRY-RUN] Would send reminder for {$invoice->invoice_number} ({$daysOverdue} days overdue) to user #{$invoice->user_id}");
                $sent++;
                continue;
            }

            $user = User::find($invoice->user_id);
            if (!$user || !$user->email) {
                continue;
            }

            Mail::to($user)->send(new OverdueReminderMail($invoice, $daysOverdue));
            $sent++;

            $this->info("Sent reminder for {$invoice->invoice_number} ({$daysOverdue} days overdue) to {$user->email}");
        }

        $this->info("Done. {$sent} reminder" . ($sent !== 1 ? 's' : '') . " processed.");

        return Command::SUCCESS;
    }
}
