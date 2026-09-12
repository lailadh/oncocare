<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold">
            Dashboard Administrateur
        </h1>

        <p class="mt-2 text-gray-600">
            Bienvenue {{ auth()->user()->prenom }} 👋
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">

           <a href="{{ route('admin.users.index') }}"
   class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">

    <p class="text-gray-500">Utilisateurs</p>

    <p class="text-3xl font-bold">
        {{ $totalUsers }}
    </p>

    <p class="mt-2 text-sm text-blue-600">
        Gérer les utilisateurs →
    </p>

</a>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Patients</p>
                <p class="text-3xl font-bold">{{ $totalPatients }}</p>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Médecins</p>
                <p class="text-3xl font-bold">{{ $totalMedecins }}</p>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Proches</p>
                <p class="text-3xl font-bold">{{ $totalProches }}</p>
            </div>

        </div>

    </div>

</x-app-layout>