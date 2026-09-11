<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorisationProcheController;
use App\Http\Controllers\MedecinController;

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

Route::middleware(['auth'])->group(function () {
    Route::resource('suivis', SuiviController::class);

    Route::get('/medecin/patients', [MedecinController::class, 'patients'])
        ->name('medecin.patients.index');

    Route::get('/medecin/patients/{patient}', [MedecinController::class, 'showPatient'])
        ->name('medecin.patients.show');
});

/*
|--------------------------------------------------------------------------
| Suivis - Patient
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

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

Route::middleware(['auth'])->group(function () {

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

Route::middleware(['auth'])->group(function () {

    Route::get('/patient/rendezvous', [RendezVousController::class, 'patientRendezVous'])
        ->name('patient.rendezvous.index');

    Route::get('/patient/rendezvous/create', [RendezVousController::class, 'create'])
        ->name('patient.rendezvous.create');

    Route::post('/patient/rendezvous', [RendezVousController::class, 'store'])
        ->name('patient.rendezvous.store');

    Route::get('/patient/rendezvous/{rendezVous}', [RendezVousController::class, 'patientShow'])
        ->name('patient.rendezvous.show');

});



/*
|--------------------------------------------------------------------------
| Autorisations Proches
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/patient/autorisations', [AutorisationProcheController::class, 'index'])
        ->name('patient.autorisations.index');

    Route::get('/patient/autorisations/create', [AutorisationProcheController::class, 'create'])
        ->name('patient.autorisations.create');

    Route::post('/patient/autorisations', [AutorisationProcheController::class, 'store'])
        ->name('patient.autorisations.store');

    Route::get('/patient/autorisations/{autorisationProche}/edit', [AutorisationProcheController::class, 'edit'])
        ->name('patient.autorisations.edit');

    Route::patch('/patient/autorisations/{autorisationProche}', [AutorisationProcheController::class, 'update'])
        ->name('patient.autorisations.update');

    Route::delete('/patient/autorisations/{autorisationProche}', [AutorisationProcheController::class, 'destroy'])
        ->name('patient.autorisations.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/proche/autorisations', [AutorisationProcheController::class, 'index'])
        ->name('proche.autorisations.index');

    Route::get('/proche/suivis', [SuiviController::class, 'procheSuivis'])
        ->name('proche.suivis.index');

    Route::get('/proche/suivis/{suivi}', [SuiviController::class, 'procheShow'])
        ->name('proche.suivis.show');

    Route::get('/proche/rendezvous', [RendezVousController::class, 'procheRendezVous'])
        ->name('proche.rendezvous.index');

    Route::get('/proche/rendezvous/{rendezVous}', [RendezVousController::class, 'procheShow'])
        ->name('proche.rendezvous.show');
});



require __DIR__.'/auth.php';