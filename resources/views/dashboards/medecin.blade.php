<x-app-layout>
<x-slot name="header">
    <div>
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            Dashboard Médecin
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Espace professionnel de suivi des patients
        </p>
    </div>
</x-slot>

<div class="py-10 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Bienvenue --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
            <h1 class="text-2xl font-bold text-slate-800">
                Bonjour Dr. {{ auth()->user()->prenom }} 👋
            </h1>

            <p class="text-slate-500 mt-2">
                Bienvenue dans votre espace médecin.
                Gérez facilement vos patients, leurs suivis et vos rendez-vous.
            </p>
        </div>

        {{-- Fonctionnalités --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Mes patients --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6
                        hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">👥</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Mes patients
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Consultez la liste des patients que vous suivez.
                </p>

                <a href="{{ route('medecin.patients.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-pink-600 text-white text-sm font-medium
                          hover:bg-pink-700 transition">
                    Voir mes patients →
                </a>
            </div>

            {{-- Suivis --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6
                        hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">🩺</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Suivis médicaux
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Ajoutez et consultez les informations de suivi de vos patients.
                </p>

                <a href="{{ route('suivis.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-blue-600 text-white text-sm font-medium
                          hover:bg-blue-700 transition">
                    Gérer les suivis →
                </a>
            </div>

            {{-- Rendez-vous --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6
                        hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4">
                    <span class="text-2xl">📅</span>
                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Rendez-vous
                </h3>

                <p class="text-sm text-slate-500 mt-2 mb-5">
                    Consultez et gérez les rendez-vous avec vos patients.
                </p>

                <a href="{{ route('rendezvous.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg
                          bg-green-600 text-white text-sm font-medium
                          hover:bg-green-700 transition">
                    Voir les rendez-vous →
                </a>
            </div>

        </div>

    </div>
</div>

</x-app-layout>
