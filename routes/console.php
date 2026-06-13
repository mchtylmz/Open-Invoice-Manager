<?php

use App\Console\Commands\SendOverdueReminders;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('reminders:overdue')->dailyAt('08:00');

Artisan::command('reminders:overdue', function () {
    $this->call(SendOverdueReminders::class);
})->purpose('Send overdue invoice reminders');
