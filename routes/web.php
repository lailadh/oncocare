<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\AutorisationProcheController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

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
| Notifications
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.readAll');

});


/*
|--------------------------------------------------------------------------
| Médecin - Suivis
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::resource('suivis', SuiviController::class);

});


/*
|--------------------------------------------------------------------------
| Médecin - Patients
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::get('/medecin/patients', [MedecinController::class, 'patients'])
        ->name('medecin.patients.index');

    Route::get('/medecin/patients/{patient}', [MedecinController::class, 'showPatient'])
        ->name('medecin.patients.show');

});


/*
|--------------------------------------------------------------------------
| Patient - Suivis
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
| Médecin - Rendez-vous
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
| Patient - Rendez-vous
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


/*
|--------------------------------------------------------------------------
| Patient - Autorisations des proches
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

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


/*
|--------------------------------------------------------------------------
| Proche
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:proche'])->group(function () {

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


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard administrateur
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Gestion des utilisateurs
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    // Modifier le rôle d'un utilisateur
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::patch('/admin/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');

});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';