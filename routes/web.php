<?php

use App\Models\TrainingSession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingSessionController;

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

Route::get('/{training_session_id?}', function () {

    //get training_session_id if passed
    $training_session_id = request()->training_session_id? request()->training_session_id : null;

    //if training session id is null, get the training session that has the most techniques attached
    if($training_session_id == null){
        $training_session_id = TrainingSession::withCount('techniques')->orderBy('techniques_count', 'desc')->first()->id;
    }

    //get the training session
    $session = TrainingSession::find($training_session_id);
    $technique = $session->getRandomTechnique();

    $doneTechniques = $session->techniques()->where('techniques.id', '!=',$technique->id)->wherePivot('done', 1)->get();

    return view('welcome', ['technique' => $technique, 'doneTechniques' => $doneTechniques, 'training_session_id' => $training_session_id]);
});
