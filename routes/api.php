<?php

use App\Http\Controllers\Api\BetController;
use App\Http\Controllers\Api\BetEventController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProbabilityController;
use App\Http\Controllers\Api\RecordController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\JWTController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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


Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);
});


Route::get('transaction-user/{id}', [TransactionController::class, 'transactionUser']);

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    // Puedes agregar más comandos aquí según sea necesario
    return 'Caché limpiada correctamente';
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'ok';
});

Route::put('update-event/{id}', [EventController::class, 'update']);
Route::get('inactivar-probabilidad/{id}', [ProbabilityController::class, 'inactivaProbabilidad']);

Route::get('eventos-activos', [EventController::class, 'eventosActivos']);
Route::put('actualiza-imagen', [UserController::class, 'updateImage']);
Route::post('actualiza-password/{id}', [UserController::class, 'updatePassword']);

Route::get('records/{id}', [RecordController::class, 'indexForProbability']);
Route::post('records', [RecordController::class, 'store']);
Route::put('records/{id}', [RecordController::class, 'update']);
Route::delete('records/{id}', [RecordController::class, 'destroy']);

Route::post('bet-event', [BetEventController::class, 'store']);

Route::post('cancelar-evento', [BetController::class, 'probabilidadesGanadas']);
Route::post('probabilidades-ganadoras', [BetController::class, 'probabilidadesGanadas']);
