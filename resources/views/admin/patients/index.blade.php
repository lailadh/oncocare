<x-app-layout>

    <div class="p-6">

        <div class="max-w-7xl mx-auto">

            {{-- Retour --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                ← Retour Dashboard
            </a>

            {{-- Titre --}}
            <div class="mt-6">
                <h1 class="text-2xl font-bold">
                    Gestion des patients
                </h1>

                <p class="mt-2 text-gray-600">
                    Consultez les comptes des patients de la plateforme.
                </p>
            </div>

            {{-- Message succès --}}
            @if(session('success'))
                <div class="mt-4 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Message erreur --}}
            @if(session('error'))
                <div class="mt-4 rounded-lg bg-red-100 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Liste des patients --}}
            <div class="mt-6 overflow-hidden rounded-lg bg-white shadow">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>

                            <th class="px-6 py-3 text-left">
                                Nom
                            </th>

                            <th class="px-6 py-3 text-left">
                                Email
                            </th>

                            <th class="px-6 py-3 text-left">
                                Téléphone
                            </th>

                            <th class="px-6 py-3 text-left">
                                Rôle
                            </th>

                            <th class="px-6 py-3 text-left">
                                Action
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($patients as $patient)

                            <tr class="border-t">

                                <td class="px-6 py-4">
                                    {{ $patient->prenom }}
                                    {{ $patient->nom }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $patient->email }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $patient->telephone ?? '—' }}
                                </td>

                                <td class="px-6 py-4">
                                    Patient
                                </td>

                                <td class="px-6 py-4">

                                    <a
                                        href="{{ route('admin.users.edit', $patient) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Modifier
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="px-6 py-8 text-center text-gray-500"
                                >
                                    Aucun patient enregistré.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
