<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

// --------------------------------------------
// LOGIN API (sem CSRF, sem sanctum, só sessão)
// --------------------------------------------
Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $request->session()->regenerate();

    return response()->json([
        'message' => 'Login OK',
        'user' => Auth::user()
    ]);
});

// --------------------------------------------
// ROTAS PROTEGIDAS (USANDO O GUARD WEB)
// --------------------------------------------
Route::middleware('auth:web')->group(function () {

    // Eventos
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy']);

    // Usuários
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
