<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold">
            Dashboard Administrateur
        </h1>

        <p class="mt-2 text-gray-600">
            Bienvenue {{ auth()->user()->prenom }} 👋
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">

            {{-- Utilisateurs --}}
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


            {{-- Patients --}}
            <a href="{{ route('admin.patients.index') }}"
               class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">

                <p class="text-gray-500">Patients</p>

                <p class="text-3xl font-bold">
                    {{ $totalPatients }}
                </p>

                <p class="mt-2 text-sm text-blue-600">
                    Consulter les patients →
                </p>

            </a>


            {{-- Médecins --}}
            <a href="{{ route('admin.medecins.index') }}"
               class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">

                <p class="text-gray-500">Médecins</p>

                <p class="text-3xl font-bold">
                    {{ $totalMedecins }}
                </p>

                <p class="mt-2 text-sm text-blue-600">
                    Consulter les médecins →
                </p>

            </a>


            {{-- Proches --}}
            <a href="{{ route('admin.proches.index') }}"
               class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">

                <p class="text-gray-500">Proches</p>

                <p class="text-3xl font-bold">
                    {{ $totalProches }}
                </p>

                <p class="mt-2 text-sm text-blue-600">
                    Consulter les proches →
                </p>

            </a>

        </div>

    </div>

</x-app-layout>
