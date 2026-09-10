<x-app-layout>

    <div class="p-6">
        <h1 class="text-2xl font-bold">Dashboard Administrateur</h1>

        <p class="mt-2 text-gray-600">
            Bienvenue {{ auth()->user()->prenom }}.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold">Utilisateurs</h2>
                <p class="text-gray-500 mt-2">
                    Gestion des comptes utilisateurs
                </p>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold">Médecins</h2>
                <p class="text-gray-500 mt-2">
                    Gestion des médecins
                </p>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold">Patients</h2>
                <p class="text-gray-500 mt-2">
                    Suivi global de la plateforme
                </p>
            </div>

        </div>
    </div>

</x-app-layout>