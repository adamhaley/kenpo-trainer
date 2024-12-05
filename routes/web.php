<?php

use App\Http\Controllers\ProfileController;
use App\Models\TrainingSession;
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

Route::get('/training/{training_session_id?}', function () {
    //get training_session_id if passed
    $training_session_id = request()->training_session_id? request()->training_session_id : null;
    //if training session id is null, get the training session that has the most techniques attached
    if($training_session_id == null){
        $training_session_id = TrainingSession::withCount('techniques')->orderBy('techniques_count', 'desc')->first()->id;
    }

    //get the training session
    $session = TrainingSession::find($training_session_id);
    $technique = $session->getRandomTechnique();

    $doneTechniques = $session->techniques()->wherePivot('done', 1)->orderBy('technique_training_session.order', 'asc')->get();
    return view('welcome', ['technique' => $technique, 'doneTechniques' => $doneTechniques, 'training_session_id' => $training_session_id]);
});

Route::get('/', function () {
    //redirect to training session
    return redirect('/training');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
