<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle request
$response = $kernel->handle(
    $request = Request::capture()
);

// Send response
$response->send();

// Terminate
$kernel->terminate($request, $response);