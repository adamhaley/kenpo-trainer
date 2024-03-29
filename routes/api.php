<?php

use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\TechniqueController;
use App\Models\Technique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/techniques', function (Request $request) {
    return Technique::all();
});

Route::resource( 'techniques', TechniqueController::class );

Route::resource('training-sessions', TrainingSessionController::class);

//training session set done route
Route::post('training-sessions/set-technique-done/{training_session_id}/{technique_id}', [TrainingSessionController::class, 'setTechniqueDone'])->name('training-sessions.set-technique-done');

//route to get random technique that is not already set to done for the current session
Route::get('training-sessions/get-random-technique/{training_session_id}', [TrainingSessionController::class, 'getRandomTechnique'])->name('training-sessions.get-random-technique');
