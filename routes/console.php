<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('cache:clear')->daily();
Schedule::command('view:clear')->daily();

// Atau jika ingin membuat custom command
Schedule::call(function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
})->daily();