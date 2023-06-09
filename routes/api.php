<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Api routes for projects list
Route::apiResource('projects', ProjectController::class);

// Api route single project
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

//Api route recover projects of one type
Route::get('/types/{id}/projects', [ProjectController::class, 'typeProjectsIndex']);
