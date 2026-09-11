<x-app-layout>

```
<x-slot name="header">
    <div>
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            Dashboard Patient
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Votre espace personnel OncoCare
        </p>
    </div>
</x-slot>

<div class="py-10 bg-slate-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Bienvenue --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">

            <h1 class="text-2xl font-bold text-slate-800">
                Bonjour {{ auth()->user()->prenom }} 👋
            </h1>

            <p class="text-slate-500 mt-2">
                Bienvenue dans votre espace personnel.
                Consultez facilement votre suivi médical,
                vos rendez-vous et les accès accordés à vos proches.
            </p>

        </div>

        {{-- Fonctionnalités --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Suivis --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">🩺</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Mes suivis médicaux
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Consultez l'historique de vos suivis médicaux.
                </p>

                <a href="{{ route('patient.suivis.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-blue-600 text-white text-sm font-medium
                          hover:bg-blue-700 transition">
                    Consulter mes suivis →
                </a>

            </div>


            {{-- Rendez-vous --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">📅</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Mes rendez-vous
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Consultez vos rendez-vous et vos demandes.
                </p>

                <a href="{{ route('patient.rendezvous.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-green-600 text-white text-sm font-medium
                          hover:bg-green-700 transition">
                    Voir mes rendez-vous →
                </a>

            </div>


            {{-- Proches --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">👥</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Mes proches
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Gérez les autorisations d'accès accordées à vos proches.
                </p>

                <a href="{{ route('patient.autorisations.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-pink-600 text-white text-sm font-medium
                          hover:bg-pink-700 transition">
                    Gérer mes proches →
                </a>

            </div>

        </div>

    </div>

</div>
```

</x-app-layout>
