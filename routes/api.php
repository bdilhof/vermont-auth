<?php

use Illuminate\Http\Request;
use VermontDevelopment\Auth\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware([
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \VermontDevelopment\Auth\Http\Middleware\SetLocale::class,
        \Fruitcake\Cors\HandleCors::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Session\Middleware\StartSession::class
    ]);
});
