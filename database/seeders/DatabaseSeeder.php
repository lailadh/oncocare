<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Reset des données de démonstration
        |--------------------------------------------------------------------------
        | On conserve les comptes admin.
        |--------------------------------------------------------------------------
        */

        Schema::disableForeignKeyConstraints();

        DB::table('notifications')->truncate();
        DB::table('autorisation_proches')->truncate();
        DB::table('rendez_vous')->truncate();
        DB::table('suivis')->truncate();
        DB::table('suivre')->truncate();

        DB::table('patients')->truncate();
        DB::table('medecins')->truncate();

        DB::table('users')
            ->where('role', '!=', 'admin')
            ->delete();

        Schema::enableForeignKeyConstraints();


        /*
        |--------------------------------------------------------------------------
        | 2. Création des médecins
        |--------------------------------------------------------------------------
        */

        $medecins = [
            [
                'prenom' => 'Youssef',
                'nom' => 'El Amrani',
                'email' => 'youssef.elamrani@oncocare.ma',
                'telephone' => '0612345678',
                'specialite' => 'Oncologie médicale',
            ],
            [
                'prenom' => 'Salma',
                'nom' => 'Bennani',
                'email' => 'salma.bennani@oncocare.ma',
                'telephone' => '0623456789',
                'specialite' => 'Oncologie médicale',
            ],
            [
                'prenom' => 'Amine',
                'nom' => 'Alaoui',
                'email' => 'amine.alaoui@oncocare.ma',
                'telephone' => '0634567890',
                'specialite' => 'Oncologie et chimiothérapie',
            ],
            [
                'prenom' => 'Ikram',
                'nom' => 'Tazi',
                'email' => 'ikram.tazi@oncocare.ma',
                'telephone' => '0645678901',
                'specialite' => 'Radiothérapie',
            ],
            [
                'prenom' => 'Mehdi',
                'nom' => 'El Idrissi',
                'email' => 'mehdi.elidrissi@oncocare.ma',
                'telephone' => '0656789012',
                'specialite' => 'Oncologie chirurgicale',
            ],
        ];

        $medecinIds = [];

        foreach ($medecins as $medecin) {

            $userId = DB::table('users')->insertGetId([
                'prenom' => $medecin['prenom'],
                'nom' => $medecin['nom'],
                'email' => $medecin['email'],
                'telephone' => $medecin['telephone'],
                'password' => Hash::make('password'),
                'role' => 'medecin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $medecinId = DB::table('medecins')->insertGetId([
                'specialite' => $medecin['specialite'],
                'id_utilisateur' => $userId,
            ]);

            $medecinIds[$medecin['prenom']] = $medecinId;
        }


        /*
        |--------------------------------------------------------------------------
        | 3. Création des patients
        |--------------------------------------------------------------------------
        */

        $patients = [
            [
                'prenom' => 'Sara',
                'nom' => 'Benali',
                'email' => 'sara.benali@oncocare.ma',
                'telephone' => '0667890123',
                'date_naissance' => '1987-04-12',
                'adresse' => 'Marrakech, Maroc',
            ],
            [
                'prenom' => 'Adam',
                'nom' => 'El Mansouri',
                'email' => 'adam.elmansouri@oncocare.ma',
                'telephone' => '0678901234',
                'date_naissance' => '1979-11-23',
                'adresse' => 'Casablanca, Maroc',
            ],
            [
                'prenom' => 'Lina',
                'nom' => 'Amrani',
                'email' => 'lina.amrani@oncocare.ma',
                'telephone' => '0689012345',
                'date_naissance' => '1992-06-08',
                'adresse' => 'Rabat, Maroc',
            ],
            [
                'prenom' => 'Yassine',
                'nom' => 'Berrada',
                'email' => 'yassine.berrada@oncocare.ma',
                'telephone' => '0690123456',
                'date_naissance' => '1983-02-17',
                'adresse' => 'Fès, Maroc',
            ],
            [
                'prenom' => 'Mariam',
                'nom' => 'Alaoui',
                'email' => 'mariam.alaoui@oncocare.ma',
                'telephone' => '0601234567',
                'date_naissance' => '1975-09-30',
                'adresse' => 'Meknès, Maroc',
            ],
            [
                'prenom' => 'Hamza',
                'nom' => 'Tazi',
                'email' => 'hamza.tazi@oncocare.ma',
                'telephone' => '0613456789',
                'date_naissance' => '1990-12-05',
                'adresse' => 'Tanger, Maroc',
            ],
            [
                'prenom' => 'Aya',
                'nom' => 'El Idrissi',
                'email' => 'aya.elidrissi@oncocare.ma',
                'telephone' => '0624567890',
                'date_naissance' => '1988-07-21',
                'adresse' => 'Agadir, Maroc',
            ],
        ];

        $patientIds = [];

        foreach ($patients as $patient) {

            $userId = DB::table('users')->insertGetId([
                'prenom' => $patient['prenom'],
                'nom' => $patient['nom'],
                'email' => $patient['email'],
                'telephone' => $patient['telephone'],
                'password' => Hash::make('password'),
                'role' => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $patientId = DB::table('patients')->insertGetId([
                'date_naissance' => $patient['date_naissance'],
                'adresse' => $patient['adresse'],
                'id_utilisateur' => $userId,
            ]);

            $patientIds[$patient['prenom']] = $patientId;
        }


        /*
        |--------------------------------------------------------------------------
        | 4. Création des proches
        |--------------------------------------------------------------------------
        */

        $proches = [
            [
                'prenom' => 'Nadia',
                'nom' => 'Benali',
                'email' => 'nadia.benali@oncocare.ma',
                'telephone' => '0635678901',
            ],
            [
                'prenom' => 'Karim',
                'nom' => 'El Mansouri',
                'email' => 'karim.elmansouri@oncocare.ma',
                'telephone' => '0646789012',
            ],
            [
                'prenom' => 'Imane',
                'nom' => 'Amrani',
                'email' => 'imane.amrani@oncocare.ma',
                'telephone' => '0657890123',
            ],
            [
                'prenom' => 'Souad',
                'nom' => 'Berrada',
                'email' => 'souad.berrada@oncocare.ma',
                'telephone' => '0668901234',
            ],
            [
                'prenom' => 'Othmane',
                'nom' => 'Alaoui',
                'email' => 'othmane.alaoui@oncocare.ma',
                'telephone' => '0679012345',
            ],
        ];

        $procheIds = [];

        foreach ($proches as $proche) {

            $userId = DB::table('users')->insertGetId([
                'prenom' => $proche['prenom'],
                'nom' => $proche['nom'],
                'email' => $proche['email'],
                'telephone' => $proche['telephone'],
                'password' => Hash::make('password'),
                'role' => 'proche',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $procheIds[$proche['prenom']] = $userId;
        }


        /*
        |--------------------------------------------------------------------------
        | 5. Relation médecins <-> patients
        |--------------------------------------------------------------------------
        */

        $relations = [
            ['Sara', 'Youssef'],
            ['Sara', 'Mehdi'],

            ['Adam', 'Youssef'],

            ['Lina', 'Salma'],
            ['Lina', 'Mehdi'],

            ['Yassine', 'Salma'],

            ['Mariam', 'Amine'],

            ['Hamza', 'Amine'],

            ['Aya', 'Ikram'],
        ];

        foreach ($relations as [$patient, $medecin]) {
            DB::table('suivre')->insert([
                'id_patient' => $patientIds[$patient],
                'id_medecin' => $medecinIds[$medecin],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 6. Suivis médicaux
        |--------------------------------------------------------------------------
        */

        $suivis = [
            [
                'date_suivi' => '2026-06-18',
                'type_cancer' => 'Cancer du sein',
                'stade' => 'Stade II',
                'observation' => 'État général stable. Surveillance clinique recommandée.',
                'evolution' => 'Évolution favorable.',
                'traitement' => 'Poursuite du protocole thérapeutique.',
                'patient' => 'Sara',
                'medecin' => 'Youssef',
            ],
            [
                'date_suivi' => '2026-08-05',
                'type_cancer' => 'Cancer du sein',
                'stade' => 'Stade II',
                'observation' => 'Bilan de contrôle satisfaisant.',
                'evolution' => 'Amélioration clinique.',
                'traitement' => 'Traitement maintenu.',
                'patient' => 'Sara',
                'medecin' => 'Youssef',
            ],
            [
                'date_suivi' => '2026-07-02',
                'type_cancer' => 'Cancer colorectal',
                'stade' => 'Stade III',
                'observation' => 'Suivi régulier après début du protocole.',
                'evolution' => 'Évolution stable.',
                'traitement' => 'Chimiothérapie en cours.',
                'patient' => 'Adam',
                'medecin' => 'Youssef',
            ],
            [
                'date_suivi' => '2026-08-20',
                'type_cancer' => 'Cancer colorectal',
                'stade' => 'Stade III',
                'observation' => 'Contrôle biologique réalisé.',
                'evolution' => 'Réponse thérapeutique satisfaisante.',
                'traitement' => 'Poursuite du protocole.',
                'patient' => 'Adam',
                'medecin' => 'Youssef',
            ],
            [
                'date_suivi' => '2026-07-15',
                'type_cancer' => 'Cancer du poumon',
                'stade' => 'Stade II',
                'observation' => 'Évaluation clinique périodique.',
                'evolution' => 'Évolution stable.',
                'traitement' => 'Traitement en cours.',
                'patient' => 'Lina',
                'medecin' => 'Salma',
            ],
            [
                'date_suivi' => '2026-08-28',
                'type_cancer' => 'Cancer du poumon',
                'stade' => 'Stade II',
                'observation' => 'Bonne tolérance du traitement.',
                'evolution' => 'Amélioration.',
                'traitement' => 'Poursuite du traitement.',
                'patient' => 'Lina',
                'medecin' => 'Salma',
            ],
            [
                'date_suivi' => '2026-06-30',
                'type_cancer' => 'Cancer de la prostate',
                'stade' => 'Stade III',
                'observation' => 'Suivi oncologique régulier.',
                'evolution' => 'Évolution stable.',
                'traitement' => 'Traitement hormonal en cours.',
                'patient' => 'Yassine',
                'medecin' => 'Salma',
            ],
            [
                'date_suivi' => '2026-08-12',
                'type_cancer' => 'Cancer du foie',
                'stade' => 'Stade II',
                'observation' => 'Bilan de suivi effectué.',
                'evolution' => 'Évolution stable.',
                'traitement' => 'Surveillance et traitement en cours.',
                'patient' => 'Mariam',
                'medecin' => 'Amine',
            ],
            [
                'date_suivi' => '2026-07-22',
                'type_cancer' => 'Lymphome',
                'stade' => 'Stade II',
                'observation' => 'Contrôle clinique satisfaisant.',
                'evolution' => 'Réponse favorable.',
                'traitement' => 'Protocole thérapeutique poursuivi.',
                'patient' => 'Hamza',
                'medecin' => 'Amine',
            ],
            [
                'date_suivi' => '2026-08-25',
                'type_cancer' => 'Cancer de la thyroïde',
                'stade' => 'Stade I',
                'observation' => 'État général satisfaisant.',
                'evolution' => 'Évolution favorable.',
                'traitement' => 'Surveillance régulière.',
                'patient' => 'Aya',
                'medecin' => 'Ikram',
            ],
        ];

        foreach ($suivis as $suivi) {
            DB::table('suivis')->insert([
                'date_suivi' => $suivi['date_suivi'],
                'type_cancer' => $suivi['type_cancer'],
                'stade' => $suivi['stade'],
                'observation' => $suivi['observation'],
                'evolution' => $suivi['evolution'],
                'traitement' => $suivi['traitement'],
                'id_patient' => $patientIds[$suivi['patient']],
                'id_medecin' => $medecinIds[$suivi['medecin']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 7. Rendez-vous
        |--------------------------------------------------------------------------
        */

        $rendezVous = [
            [
                'date_heure' => '2026-09-15 10:00:00',
                'statut' => 'confirme',
                'motif' => 'Consultation de suivi',
                'patient' => 'Sara',
                'medecin' => 'Youssef',
            ],
            [
                'date_heure' => '2026-09-17 09:30:00',
                'statut' => 'en_attente',
                'motif' => 'Contrôle après traitement',
                'patient' => 'Adam',
                'medecin' => 'Youssef',
            ],
            [
                'date_heure' => '2026-09-18 11:00:00',
                'statut' => 'confirme',
                'motif' => 'Bilan oncologique',
                'patient' => 'Lina',
                'medecin' => 'Salma',
            ],
            [
                'date_heure' => '2026-09-21 14:00:00',
                'statut' => 'en_attente',
                'motif' => 'Consultation de contrôle',
                'patient' => 'Yassine',
                'medecin' => 'Salma',
            ],
            [
                'date_heure' => '2026-09-23 10:30:00',
                'statut' => 'confirme',
                'motif' => 'Suivi du traitement',
                'patient' => 'Mariam',
                'medecin' => 'Amine',
            ],
            [
                'date_heure' => '2026-09-25 15:00:00',
                'statut' => 'confirme',
                'motif' => 'Consultation de suivi',
                'patient' => 'Hamza',
                'medecin' => 'Amine',
            ],
            [
                'date_heure' => '2026-09-29 09:00:00',
                'statut' => 'en_attente',
                'motif' => 'Bilan de contrôle',
                'patient' => 'Aya',
                'medecin' => 'Ikram',
            ],
            [
                'date_heure' => '2026-08-10 10:00:00',
                'statut' => 'termine',
                'motif' => 'Consultation oncologique',
                'patient' => 'Sara',
                'medecin' => 'Youssef',
            ],
            [
                'date_heure' => '2026-08-18 09:30:00',
                'statut' => 'termine',
                'motif' => 'Bilan de suivi',
                'patient' => 'Lina',
                'medecin' => 'Salma',
            ],
        ];

        foreach ($rendezVous as $rdv) {
            DB::table('rendez_vous')->insert([
                'date_heure' => $rdv['date_heure'],
                'statut' => $rdv['statut'],
                'motif' => $rdv['motif'],
                'id_patient' => $patientIds[$rdv['patient']],
                'id_medecin' => $medecinIds[$rdv['medecin']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 8. Autorisations des proches
        |--------------------------------------------------------------------------
        */

        $autorisations = [
            [
                'proche' => 'Nadia',
                'patient' => 'Sara',
                'acces_suivi' => true,
                'acces_rendez_vous' => true,
            ],
            [
                'proche' => 'Karim',
                'patient' => 'Adam',
                'acces_suivi' => true,
                'acces_rendez_vous' => false,
            ],
            [
                'proche' => 'Imane',
                'patient' => 'Lina',
                'acces_suivi' => true,
                'acces_rendez_vous' => true,
            ],
            [
                'proche' => 'Souad',
                'patient' => 'Yassine',
                'acces_suivi' => false,
                'acces_rendez_vous' => true,
            ],
            [
                'proche' => 'Othmane',
                'patient' => 'Mariam',
                'acces_suivi' => true,
                'acces_rendez_vous' => true,
            ],
        ];

        foreach ($autorisations as $autorisation) {
            DB::table('autorisation_proches')->insert([
                'acces_suivi' => $autorisation['acces_suivi'],
                'acces_rendez_vous' => $autorisation['acces_rendez_vous'],
                'statut' => 'active',
                'date_autorisation' => '2026-09-01',
                'id_patient' => $patientIds[$autorisation['patient']],
                'id_proche' => $procheIds[$autorisation['proche']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 9. Notifications
        |--------------------------------------------------------------------------
        */

        $notifications = [
            [
                'user_email' => 'sara.benali@oncocare.ma',
                'titre' => 'Rendez-vous confirmé',
                'type' => 'rendezvous',
                'message' => 'Votre rendez-vous du 15/09/2026 à 10:00 avec Dr. Youssef El Amrani est confirmé.',
                'lu' => false,
                'date' => '2026-09-10 09:30:00',
            ],
            [
                'user_email' => 'adam.elmansouri@oncocare.ma',
                'titre' => 'Demande de rendez-vous',
                'type' => 'rendezvous',
                'message' => 'Votre demande de rendez-vous du 17/09/2026 est en attente de confirmation.',
                'lu' => false,
                'date' => '2026-09-12 11:15:00',
            ],
            [
                'user_email' => 'lina.amrani@oncocare.ma',
                'titre' => 'Nouveau suivi médical',
                'type' => 'suivi',
                'message' => 'Un nouveau suivi médical a été enregistré dans votre dossier.',
                'lu' => true,
                'date' => '2026-08-28 16:00:00',
            ],
            [
                'user_email' => 'nadia.benali@oncocare.ma',
                'titre' => 'Accès autorisé',
                'type' => 'autorisation',
                'message' => 'Vous avez accès au suivi et aux rendez-vous de Sara Benali.',
                'lu' => false,
                'date' => '2026-09-01 10:00:00',
            ],
            [
                'user_email' => 'karim.elmansouri@oncocare.ma',
                'titre' => 'Accès au suivi',
                'type' => 'autorisation',
                'message' => 'Vous avez accès aux informations de suivi de Adam El Mansouri.',
                'lu' => true,
                'date' => '2026-09-01 10:30:00',
            ],
            [
                'user_email' => 'imane.amrani@oncocare.ma',
                'titre' => 'Rendez-vous confirmé',
                'type' => 'rendezvous',
                'message' => 'Le rendez-vous de Lina Amrani du 18/09/2026 à 11:00 est confirmé.',
                'lu' => false,
                'date' => '2026-09-11 14:20:00',
            ],
        ];

        foreach ($notifications as $notification) {

            $user = DB::table('users')
                ->where('email', $notification['user_email'])
                ->first();

            if ($user) {
                DB::table('notifications')->insert([
                    'titre' => $notification['titre'],
                    'type' => $notification['type'],
                    'message' => $notification['message'],
                    'lu' => $notification['lu'],
                    'date_notification' => $notification['date'],
                    'id_utilisateur' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Fin
        |--------------------------------------------------------------------------
        */

        $this->command?->info('');
        $this->command?->info('==============================================');
        $this->command?->info('       ONCOCARE DEMO DATA CREATED');
        $this->command?->info('==============================================');
        $this->command?->info('Médecins : 5');
        $this->command?->info('Patients  : 7');
        $this->command?->info('Proches   : 5');
        $this->command?->info('Suivis    : 10');
        $this->command?->info('RDV       : 9');
        $this->command?->info('Autorisations : 5');
        $this->command?->info('Notifications : 6');
        $this->command?->info('');
        $this->command?->info('Mot de passe des comptes démo : password');
        $this->command?->info('==============================================');
    }
}