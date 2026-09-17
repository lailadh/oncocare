# OncoCare

OncoCare est une plateforme Laravel de suivi et d'accompagnement des patients atteints de cancer. Elle permet aux patients, medecins, proches autorises et administrateurs d'utiliser un espace adapte a leur role.

## Fonctionnalites

- Creation de comptes Patient, Proche et Medecin.
- Authentification et espaces proteges par role.
- Gestion des rendez-vous.
- Suivi medical des patients.
- Gestion des autorisations donnees aux proches.
- Notifications et gestion des utilisateurs par l'administrateur.

## Prerequis

- PHP 8.3 ou une version plus recente compatible.
- Composer.
- Node.js et npm.
- SQLite ou une autre base de donnees configuree dans `.env`.

## Installation

Depuis le dossier du projet :

```bash
composer install
```

Copier le fichier d'environnement :

```powershell
Copy-Item .env.example .env
```

Sur macOS/Linux, utiliser :

```bash
cp .env.example .env
```

Generer la cle de l'application et preparer la base de donnees :

```bash
php artisan key:generate
php artisan migrate
```

Installer les dependances frontend et compiler les assets :

```bash
npm install
npm run build
```

## Demarrage en local

Lancer le serveur Laravel :

```bash
php artisan serve
```

Puis ouvrir [http://localhost:8000](http://localhost:8000).

Pour le developpement frontend avec rechargement automatique :

```bash
npm run dev
```

Une commande de developpement complete est aussi disponible :

```bash
composer run dev
```

## Pages principales

- `/` : page d'accueil.
- `/register` : choix du type de compte.
- `/register/patient` : inscription Patient.
- `/register/proche` : inscription Proche.
- `/register/medecin` : inscription Medecin.
- `/login` : connexion.
- `/dashboard` : espace utilisateur apres connexion.

Les pages protegees necessitent une authentification et, selon la fonctionnalite, le role correspondant.

## Images

Les images publiques se trouvent dans `public/images`.

L'image principale de la page d'inscription est :

```text
public/images/oncocare-register-hero.png
```

Elle est utilisee dans les vues d'inscription et de connexion. Pour la remplacer, conserver ce nom de fichier ou modifier le chemin `asset('images/oncocare-register-hero.png')` dans les vues concernees.

## Tests

Lancer toute la suite :

```bash
php artisan test
```

Lancer un test cible :

```bash
vendor/bin/phpunit tests/Unit/RendezVousPolicyTest.php --testdox
```

## Formatage PHP

Verifier et corriger le formatage des fichiers PHP modifies :

```bash
vendor/bin/pint --dirty --format agent
```

## Structure utile

```text
app/                  Logique applicative Laravel
database/             Migrations, factories et seeders
resources/views/      Vues Blade
public/images/        Images accessibles publiquement
routes/               Routes web et authentification
tests/                Tests PHPUnit
```

## Licence

Projet prive OncoCare.
