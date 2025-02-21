<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/orders', function () {
//     $response = Http::get(env('API_HOST') . '/api/orders', [
//         'dateFrom' => '2025-02-13',
//         'dateTo' => '2025-02-21',
//         'page' => 1,
//         'key' => env('API_KEY'),
//         'limit' => 150,
//     ]);
    
//     if ($response->successful()) {
//         $data = $response->json();
//         // dd($data);
//         return new JsonResponse($data);
//     } else {
//         dd($response->status(), $response->body());
//     }
// });