<?php

use App\Http\Controllers\Api\BetController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProbabilityController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('bets', BetController::class)->parameters([
    'bets' => 'item'
])->names('bets');

Route::apiResource('events', EventController::class)->parameters([
    'events' => 'item'
])->names('events');

Route::apiResource('probabilities', ProbabilityController::class)->parameters([
    'probabilities' => 'item'
])->names('probabilities');

Route::apiResource('roles', RoleController::class)->parameters([
    'roles' => 'item'
])->names('roles');

Route::apiResource('transactions', TransactionController::class)->parameters([
    'transactions' => 'item'
])->names('transactions');

Route::apiResource('users', UserController::class)->parameters([
    'users' => 'item'
])->names('users');