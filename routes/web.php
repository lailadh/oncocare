<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Suivis - Médecin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::resource('suivis', SuiviController::class);

});


/*
|--------------------------------------------------------------------------
| Suivis - Patient
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/patient/suivis', [SuiviController::class, 'patientSuivis'])
        ->name('patient.suivis.index');

    Route::get('/patient/suivis/{suivi}', [SuiviController::class, 'patientShow'])
        ->name('patient.suivis.show');

});


/*
|--------------------------------------------------------------------------
| Rendez-vous - Médecin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::get('/rendezvous', [RendezVousController::class, 'index'])
        ->name('rendezvous.index');

    Route::get('/rendezvous/{rendezVous}', [RendezVousController::class, 'show'])
        ->name('rendezvous.show');

    Route::get('/rendezvous/{rendezVous}/edit', [RendezVousController::class, 'edit'])
        ->name('rendezvous.edit');

    Route::patch('/rendezvous/{rendezVous}', [RendezVousController::class, 'update'])
        ->name('rendezvous.update');

    Route::delete('/rendezvous/{rendezVous}', [RendezVousController::class, 'destroy'])
        ->name('rendezvous.destroy');

});


/*
|--------------------------------------------------------------------------
| Rendez-vous - Patient
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/patient/rendezvous', [RendezVousController::class, 'patientRendezVous'])
        ->name('patient.rendezvous.index');

    Route::get('/patient/rendezvous/create', [RendezVousController::class, 'create'])
        ->name('patient.rendezvous.create');

    Route::post('/patient/rendezvous', [RendezVousController::class, 'store'])
        ->name('patient.rendezvous.store');

    Route::get('/patient/rendezvous/{rendezVous}', [RendezVousController::class, 'patientShow'])
        ->name('patient.rendezvous.show');

});


require __DIR__.'/auth.php';