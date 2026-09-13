<x-app-layout>

    <div class="p-6">

        <div class="mb-8">
            <a href="{{ route('admin.dashboard') }}"
               class="text-sm text-gray-500 hover:text-gray-700">
                ← Retour Dashboard
            </a>

            <h1 class="mt-3 text-3xl font-bold text-gray-800">
                Gestion des proches
            </h1>

            <p class="mt-2 text-gray-600">
                Consultez les comptes des proches de la plateforme.
            </p>
        </div>

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    Liste des proches
                </h2>
            </div>

            @if ($proches->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">
                                    Nom
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">
                                    Téléphone
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">
                                    Rôle
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @foreach ($proches as $proche)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        <span class="font-medium text-gray-800">
                                            {{ $proche->prenom }} {{ $proche->nom }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $proche->email }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $proche->telephone ?? 'Non renseigné' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                            Proche
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="px-6 py-12 text-center">

                    <div class="text-4xl">
                        👥
                    </div>

                    <h3 class="mt-4 text-lg font-semibold text-gray-800">
                        Aucun proche
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Aucun compte proche n'est actuellement enregistré.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
