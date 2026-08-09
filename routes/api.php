<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Api\AuthController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    // return User::create([
    //     'name' => 'John Doe',
    //     'email' => 'john.doe@example.com',
    //     'password' => Hash::make("ome")
    // ]);
    $authData= ["email"=>"john.doe@example.com", "password"=>"ome"];
    $data = JwtAuth::attempt($authData);
    return response()->json($data);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'JwtMiddleware'], function () {

Route::get('/profile', [AuthController::class, 'profile']);
Route::get('/logout', [AuthController::class, 'logout']);
});

