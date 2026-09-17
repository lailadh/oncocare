<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AutorisationProcheController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeSuiviController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SuiviController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// =====================================================
// DASHBOARD
// =====================================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// =====================================================
// PROFILE
// =====================================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// =====================================================
// NOTIFICATIONS
// =====================================================

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.readAll');
});

// =====================================================
// SUIVIS — MEDECIN
// =====================================================

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::resource('suivis', SuiviController::class);
});

// =====================================================
// PATIENTS — MEDECIN
// =====================================================

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::get('/medecin/patients', [MedecinController::class, 'patients'])
        ->name('medecin.patients.index');

    Route::get('/medecin/patients/{patient}', [MedecinController::class, 'showPatient'])
        ->name('medecin.patients.show');
});

// =====================================================
// SUIVIS — PATIENT
// =====================================================

Route::middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/patient/suivis', [SuiviController::class, 'patientSuivis'])
        ->name('patient.suivis.index');

    Route::get('/patient/suivis/{suivi}', [SuiviController::class, 'patientShow'])
        ->name('patient.suivis.show');
});

// =====================================================
// MÉDECINS — PATIENT (recherche + demande de suivi)
// =====================================================

Route::middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/patient/medecins', [DemandeSuiviController::class, 'medecinsIndex'])
        ->name('patient.medecins.index');

    Route::get('/patient/medecins/{medecin}', [DemandeSuiviController::class, 'medecinShow'])
        ->name('patient.medecins.show');

    Route::get('/patient/demandes-suivi', [DemandeSuiviController::class, 'patientIndex'])
        ->name('patient.demandes-suivi.index');

    Route::post('/patient/demandes-suivi', [DemandeSuiviController::class, 'store'])
        ->name('patient.demandes-suivi.store');
});

// =====================================================
// DEMANDES DE SUIVI — MEDECIN
// =====================================================

Route::middleware(['auth', 'role:medecin'])->group(function () {

    Route::get('/medecin/demandes-suivi', [DemandeSuiviController::class, 'medecinIndex'])
        ->name('medecin.demandes-suivi.index');

    Route::post('/medecin/demandes-suivi/{demandeSuivi}/accepter', [DemandeSuiviController::class, 'accepter'])
        ->name('medecin.demandes-suivi.accepter');

    Route::post('/medecin/demandes-suivi/{demandeSuivi}/refuser', [DemandeSuiviController::class, 'refuser'])
        ->name('medecin.demandes-suivi.refuser');
});

// =====================================================
// RENDEZ-VOUS — MEDECIN
// =====================================================

Route::middleware(['auth', 'role:medecin'])->group(function () {

    // Liste des rendez-vous du médecin
    Route::get('/rendezvous', [RendezVousController::class, 'index'])
        ->name('rendezvous.index');

    // Création directe d'un rendez-vous par le médecin
    Route::get('/rendezvous/create', [RendezVousController::class, 'create'])
        ->name('rendezvous.create');

    Route::post('/rendezvous', [RendezVousController::class, 'store'])
        ->name('rendezvous.store');

    // Détail d'un rendez-vous
    Route::get('/rendezvous/{rendezVous}', [RendezVousController::class, 'show'])
        ->name('rendezvous.show');

    // Modifier / traiter une demande de rendez-vous
    Route::get('/rendezvous/{rendezVous}/edit', [RendezVousController::class, 'edit'])
        ->name('rendezvous.edit');

    // Confirmer une demande avec une date et une heure
    Route::patch('/rendezvous/{rendezVous}', [RendezVousController::class, 'update'])
        ->name('rendezvous.update');

    // Suppression d'un rendez-vous
    Route::delete('/rendezvous/{rendezVous}', [RendezVousController::class, 'destroy'])
        ->name('rendezvous.destroy');
});

// =====================================================
// RENDEZ-VOUS — PATIENT
// =====================================================

Route::middleware(['auth', 'role:patient'])->group(function () {

    // Liste des rendez-vous du patient
    Route::get('/patient/rendezvous', [RendezVousController::class, 'patientRendezVous'])
        ->name('patient.rendezvous.index');

    // Détail d'un rendez-vous
    Route::get('/patient/rendezvous/{rendezVous}', [RendezVousController::class, 'patientShow'])
        ->name('patient.rendezvous.show');
});

// =====================================================
// AUTORISATIONS — PATIENT
// =====================================================

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

// =====================================================
// ESPACE PROCHE
// =====================================================

Route::middleware(['auth', 'role:proche'])->group(function () {

    // Autorisations
    Route::get('/proche/autorisations', [AutorisationProcheController::class, 'index'])
        ->name('proche.autorisations.index');

    // Suivis autorisés
    Route::get('/proche/suivis', [SuiviController::class, 'procheSuivis'])
        ->name('proche.suivis.index');

    Route::get('/proche/suivis/{suivi}', [SuiviController::class, 'procheShow'])
        ->name('proche.suivis.show');

    // Rendez-vous autorisés
    Route::get('/proche/rendezvous', [RendezVousController::class, 'procheRendezVous'])
        ->name('proche.rendezvous.index');

    Route::get('/proche/rendezvous/{rendezVous}', [RendezVousController::class, 'procheShow'])
        ->name('proche.rendezvous.show');
});

// =====================================================
// ADMIN
// =====================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Gestion des utilisateurs
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    // Gestion des médecins
    Route::get('/admin/medecins', [AdminUserController::class, 'medecins'])
        ->name('admin.medecins.index');

    // Gestion des patients
    Route::get('/admin/patients', [AdminUserController::class, 'patients'])
        ->name('admin.patients.index');

    // Gestion des proches
    Route::get('/admin/proches', [AdminUserController::class, 'proches'])
        ->name('admin.proches.index');

    // Modifier un utilisateur
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::patch('/admin/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');
});

// =====================================================
// AUTH
// =====================================================

require __DIR__.'/auth.php';
