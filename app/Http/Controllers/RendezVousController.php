<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\AutorisationProche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class RendezVousController extends Controller
{
    /**
     * Liste des rendez-vous du médecin connecté.
     */
    public function index()
    {
        Gate::authorize('viewAny', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $rendezVous = RendezVous::with([
            'patient.utilisateur',
        ])
            ->where(
                'id_medecin',
                $user->medecin->id_medecin
            )
            ->latest('date_heure')
            ->get();

        return view(
            'rendezvous.index',
            compact('rendezVous')
        );
    }

    /**
     * Formulaire de création directe d'un rendez-vous
     * par le médecin.
     */
    public function create()
    {
        Gate::authorize('create', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Uniquement les patients suivis par ce médecin.
        $patients = $user->medecin
            ->patients()
            ->with('utilisateur')
            ->get();

        return view(
            'rendezvous.create',
            compact('patients')
        );
    }

    /**
     * Créer directement un rendez-vous par le médecin.
     *
     * Ce rendez-vous est créé directement avec le statut
     * "confirme".
     */
    public function store(Request $request)
    {
        Gate::authorize('create', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $request->validate([
            'id_patient' => [
                'required',
                'exists:patients,id_patient',
            ],

            'date_heure' => [
                'required',
                'date',
                'after:now',
            ],

            'motif' => [
                'required',
                'string',
                'max:1000',
            ],
        ], [
            'id_patient.required' =>
                'Veuillez sélectionner un patient.',

            'id_patient.exists' =>
                'Le patient sélectionné est invalide.',

            'date_heure.required' =>
                'Veuillez choisir une date et une heure.',

            'date_heure.date' =>
                'La date et l’heure sont invalides.',

            'date_heure.after' =>
                'Le rendez-vous doit être programmé dans le futur.',

            'motif.required' =>
                'Veuillez préciser le motif du rendez-vous.',

            'motif.max' =>
                'Le motif ne doit pas dépasser 1000 caractères.',
        ]);

        // Vérifier que le patient est bien suivi par ce médecin.
        $patientExiste = $user->medecin
            ->patients()
            ->where(
                'patients.id_patient',
                $request->id_patient
            )
            ->exists();

        if (!$patientExiste) {
            abort(403);
        }

        // Vérifier si le médecin a déjà un rendez-vous
        // à cette date et cette heure.
        $rendezVousExiste = RendezVous::where(
            'id_medecin',
            $user->medecin->id_medecin
        )
            ->where(
                'date_heure',
                $request->date_heure
            )
            ->where(
                'statut',
                'confirme'
            )
            ->exists();

        if ($rendezVousExiste) {
            return back()
                ->withInput()
                ->withErrors([
                    'date_heure' =>
                        'Ce créneau est déjà occupé par un autre rendez-vous.',
                ]);
        }

        // Créer le rendez-vous directement confirmé.
        $rendezVous = RendezVous::create([
            'date_heure' => $request->date_heure,
            'statut' => 'confirme',
            'motif' => $request->motif,
            'id_patient' => $request->id_patient,
            'id_medecin' => $user->medecin->id_medecin,
        ]);

        // Récupérer le patient.
        $patient = Patient::with('utilisateur')
            ->findOrFail($request->id_patient);

        // Notification au patient.
        Notification::create([
            'titre' => 'Nouveau rendez-vous',
            'type' => 'rendezvous',

            'message' =>
                'Dr ' .
                $user->prenom . ' ' .
                $user->nom .
                ' vous a programmé un rendez-vous le ' .
                $rendezVous->date_heure->format('d/m/Y à H:i') .
                '.',

            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $patient->id_utilisateur,
        ]);

        return redirect()
            ->route('rendezvous.index')
            ->with(
                'success',
                'Rendez-vous créé avec succès. Le patient a été notifié.'
            );
    }

    /**
     * Afficher un rendez-vous pour le médecin.
     */
    public function show(RendezVous $rendezVous)
    {
        Gate::authorize('view', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient
        // au médecin connecté.
        if (
            $rendezVous->id_medecin !==
            $user->medecin->id_medecin
        ) {
            abort(403);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'rendezvous.show',
            compact('rendezVous')
        );
    }

    /**
     * Formulaire permettant au médecin de traiter
     * une demande de rendez-vous en attente.
     */
    public function edit(RendezVous $rendezVous)
    {
        Gate::authorize('view', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient
        // au médecin connecté.
        if (
            $rendezVous->id_medecin !==
            $user->medecin->id_medecin
        ) {
            abort(403);
        }

        // Seules les demandes en attente peuvent être traitées.
        if ($rendezVous->statut !== 'en_attente') {
            return redirect()
                ->route('rendezvous.show', $rendezVous)
                ->withErrors([
                    'rendezVous' =>
                        'Cette demande de rendez-vous a déjà été traitée.',
                ]);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'rendezvous.edit',
            compact('rendezVous')
        );
    }

    /**
     * Traiter une demande de rendez-vous.
     *
     * Le médecin peut :
     * - confirmer avec une date et une heure ;
     * - refuser la demande.
     */
    public function update(
        Request $request,
        RendezVous $rendezVous
    ) {
        Gate::authorize('view', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient
        // au médecin connecté.
        if (
            $rendezVous->id_medecin !==
            $user->medecin->id_medecin
        ) {
            abort(403);
        }

        // Seules les demandes en attente peuvent être traitées.
        if ($rendezVous->statut !== 'en_attente') {
            return redirect()
                ->route('rendezvous.show', $rendezVous)
                ->withErrors([
                    'rendezVous' =>
                        'Cette demande de rendez-vous a déjà été traitée.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'statut' => [
                'required',
                Rule::in([
                    'confirme',
                    'refuse',
                ]),
            ],

            'date_heure' => [
                'nullable',
                'date',
                'after:now',
            ],
        ], [
            'statut.required' =>
                'Veuillez sélectionner une décision.',

            'statut.in' =>
                'La décision sélectionnée est invalide.',

            'date_heure.date' =>
                'La date et l’heure sélectionnées sont invalides.',

            'date_heure.after' =>
                'Le rendez-vous doit être programmé dans le futur.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CONFIRMATION
        |--------------------------------------------------------------------------
        */

        if ($request->statut === 'confirme') {

            // La date et l'heure sont obligatoires pour confirmer.
            if (!$request->filled('date_heure')) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'date_heure' =>
                            'Veuillez choisir une date et une heure pour confirmer le rendez-vous.',
                    ]);
            }

            // Vérifier si le créneau est déjà occupé.
            $creneauOccupe = RendezVous::where(
                'id_medecin',
                $user->medecin->id_medecin
            )
                ->where(
                    'id_rendez_vous',
                    '!=',
                    $rendezVous->id_rendez_vous
                )
                ->where(
                    'date_heure',
                    $request->date_heure
                )
                ->where(
                    'statut',
                    'confirme'
                )
                ->exists();

            if ($creneauOccupe) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'date_heure' =>
                            'Ce créneau est déjà occupé par un autre rendez-vous.',
                    ]);
            }

            // Confirmer le rendez-vous.
            $rendezVous->update([
                'date_heure' => $request->date_heure,
                'statut' => 'confirme',
            ]);

            // Patient concerné.
            $patient = $rendezVous
                ->patient()
                ->with('utilisateur')
                ->firstOrFail();

            // Notification au patient.
            Notification::create([
                'titre' => 'Rendez-vous confirmé',
                'type' => 'rendezvous',

                'message' =>
                    'Votre demande de rendez-vous avec Dr ' .
                    $user->prenom . ' ' .
                    $user->nom .
                    ' a été confirmée pour le ' .
                    $rendezVous->date_heure->format('d/m/Y à H:i') .
                    '.',

                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $patient->id_utilisateur,
            ]);

            return redirect()
                ->route('rendezvous.show', $rendezVous)
                ->with(
                    'success',
                    'La demande a été confirmée. Le patient a été notifié.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | REFUS
        |--------------------------------------------------------------------------
        */

        if ($request->statut === 'refuse') {

            $rendezVous->update([
                'date_heure' => null,
                'statut' => 'refuse',
            ]);

            // Patient concerné.
            $patient = $rendezVous
                ->patient()
                ->with('utilisateur')
                ->firstOrFail();

            // Notification au patient.
            Notification::create([
                'titre' => 'Demande de rendez-vous refusée',
                'type' => 'rendezvous',

                'message' =>
                    'Votre demande de rendez-vous avec Dr ' .
                    $user->prenom . ' ' .
                    $user->nom .
                    ' a été refusée.',

                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $patient->id_utilisateur,
            ]);

            return redirect()
                ->route('rendezvous.show', $rendezVous)
                ->with(
                    'success',
                    'La demande de rendez-vous a été refusée. Le patient a été notifié.'
                );
        }

        return back();
    }

    /**
     * Supprimer un rendez-vous.
     */
    public function destroy(RendezVous $rendezVous)
    {
        Gate::authorize('delete', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient
        // au médecin connecté.
        if (
            $rendezVous->id_medecin !==
            $user->medecin->id_medecin
        ) {
            abort(403);
        }

        $rendezVous->delete();

        return redirect()
            ->route('rendezvous.index')
            ->with(
                'success',
                'Rendez-vous supprimé avec succès.'
            );
    }

    /**
     * Formulaire pour demander un rendez-vous côté patient.
     */
    public function patientCreate()
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        // Afficher uniquement les médecins qui suivent ce patient.
        $medecins = $user->patient
            ->medecins()
            ->with('utilisateur')
            ->get();

        return view(
            'patient.rendezvous.demande',
            compact('medecins')
        );
    }

    /**
     * Enregistrer une demande de rendez-vous côté patient.
     */
    public function patientStore(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $motifsAutorises = [
            'Consultation de suivi',
            'Contrôle médical',
            'Suivi du traitement',
            'Bilan / examens',
            'Effets secondaires du traitement',
            'Demande d’information',
            'Renouvellement / adaptation du suivi',
            'Autre',
        ];

        $request->validate([
            'id_medecin' => [
                'required',
                'exists:medecins,id_medecin',
            ],

            'motif' => [
                'required',
                'string',
                Rule::in($motifsAutorises),
            ],

            'motif_autre' => [
                'nullable',
                'required_if:motif,Autre',
                'string',
                'max:1000',
            ],
        ], [
            'id_medecin.required' =>
                'Veuillez sélectionner un médecin.',

            'id_medecin.exists' =>
                'Le médecin sélectionné est invalide.',

            'motif.required' =>
                'Veuillez sélectionner un motif.',

            'motif.in' =>
                'Le motif sélectionné est invalide.',

            'motif_autre.required_if' =>
                'Veuillez préciser votre motif.',

            'motif_autre.max' =>
                'Le motif ne doit pas dépasser 1000 caractères.',
        ]);

        $patient = $user->patient;

        // Vérifier que le médecin suit bien le patient.
        $medecinExiste = $patient
            ->medecins()
            ->where(
                'medecins.id_medecin',
                $request->id_medecin
            )
            ->exists();

        if (!$medecinExiste) {
            abort(403);
        }

        // Empêcher plusieurs demandes en attente.
        $demandeExiste = RendezVous::where(
            'id_patient',
            $patient->id_patient
        )
            ->where(
                'id_medecin',
                $request->id_medecin
            )
            ->where(
                'statut',
                'en_attente'
            )
            ->exists();

        if ($demandeExiste) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_medecin' =>
                        'Vous avez déjà une demande de rendez-vous en attente avec ce médecin.',
                ]);
        }

        // Déterminer le motif.
        if ($request->motif === 'Autre') {
            $motif = trim($request->motif_autre);
        } else {
            $motif = $request->motif;
        }

        // Créer la demande.
        RendezVous::create([
            'date_heure' => null,
            'statut' => 'en_attente',
            'motif' => $motif,
            'id_patient' => $patient->id_patient,
            'id_medecin' => $request->id_medecin,
        ]);

        // Récupérer le médecin.
        $medecin = $patient
            ->medecins()
            ->with('utilisateur')
            ->findOrFail($request->id_medecin);

        // Notification au médecin.
        Notification::create([
            'titre' => 'Nouvelle demande de rendez-vous',
            'type' => 'rendezvous',

            'message' =>
                $user->prenom . ' ' .
                $user->nom .
                ' a demandé un rendez-vous. ' .
                'Veuillez choisir une date et une heure.',

            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $medecin->id_utilisateur,
        ]);

        return redirect()
            ->route('patient.rendezvous.index')
            ->with(
                'success',
                'Votre demande de rendez-vous a été envoyée au médecin.'
            );
    }

    /**
     * Liste des rendez-vous du patient connecté.
     */
    public function patientRendezVous()
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        // Le patient ne voit que ses propres rendez-vous.
        $rendezVous = RendezVous::with([
            'medecin.utilisateur',
        ])
            ->where(
                'id_patient',
                $user->patient->id_patient
            )
            ->latest('date_heure')
            ->get();

        return view(
            'patient.rendezvous.index',
            compact('rendezVous')
        );
    }

    /**
     * Détails d'un rendez-vous pour le patient.
     */
    public function patientShow(RendezVous $rendezVous)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        // Le patient ne peut consulter que ses propres rendez-vous.
        if (
            $rendezVous->id_patient !==
            $user->patient->id_patient
        ) {
            abort(403);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'patient.rendezvous.show',
            compact('rendezVous')
        );
    }

    /**
     * Liste des rendez-vous accessibles au proche.
     */
    public function procheRendezVous()
    {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        // Récupérer uniquement les autorisations actives
        // permettant l'accès aux rendez-vous.
        $autorisations = AutorisationProche::where(
            'id_proche',
            $user->id
        )
            ->where(
                'statut',
                'active'
            )
            ->where(
                'acces_rendez_vous',
                1
            )
            ->get();

        $patientIds = $autorisations->pluck(
            'id_patient'
        );

        $rendezVous = RendezVous::with([
            'patient.utilisateur',
            'medecin.utilisateur',
        ])
            ->whereIn(
                'id_patient',
                $patientIds
            )
            ->latest('date_heure')
            ->get();

        return view(
            'proche.rendezvous.index',
            compact('rendezVous')
        );
    }

    /**
     * Détails d'un rendez-vous accessible au proche.
     */
    public function procheShow(
        RendezVous $rendezVous
    ) {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        Gate::authorize(
            'view',
            $rendezVous
        );

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'proche.rendezvous.show',
            compact('rendezVous')
        );
    }
}