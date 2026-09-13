<x-app-layout>

    <div class="p-6 max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Mes autorisations
            </h1>

            <p class="mt-1 text-gray-600">
                Gérez les autorisations accordées à vos proches.
            </p>
        </div>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="mb-5 bg-green-100 border border-green-300
                        text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="mb-5 bg-red-100 border border-red-300
                        text-red-700 px-4 py-3 rounded-lg">

                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        {{-- Liste --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            @if($autorisations->isEmpty())

                <div class="p-8 text-center">

                    <div class="text-4xl mb-3">
                        👥
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800">
                        Aucune autorisation
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Vous n'avez encore accordé aucune autorisation à un proche.
                    </p>

                </div>

            @else

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-gray-50 border-b">

                            <tr>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Proche
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Date d'autorisation
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Suivis
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Rendez-vous
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-700">
                                    Statut
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y">

                            @foreach($autorisations as $autorisation)

                                <tr class="hover:bg-gray-50">

                                    {{-- Proche --}}
                                    <td class="px-6 py-4">

                                        <div class="font-medium text-gray-800">

                                            {{ $autorisation->proche->prenom }}
                                            {{ $autorisation->proche->nom }}

                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $autorisation->proche->email }}
                                        </div>

                                    </td>

                                    {{-- Date --}}
                                    <td class="px-6 py-4 text-gray-600">

                                        {{ \Carbon\Carbon::parse($autorisation->date_autorisation)->format('d/m/Y') }}

                                    </td>

                                    {{-- Accès suivis --}}
                                    <td class="px-6 py-4">

                                        @if($autorisation->acces_suivis)

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-green-100 text-green-800">
                                                Autorisé
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-gray-100 text-gray-600">
                                                Non autorisé
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Accès rendez-vous --}}
                                    <td class="px-6 py-4">

                                        @if($autorisation->acces_rendez_vous)

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-green-100 text-green-800">
                                                Autorisé
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-gray-100 text-gray-600">
                                                Non autorisé
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Statut --}}
                                    <td class="px-6 py-4">

                                        @if($autorisation->statut === 'active')

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-green-100 text-green-800">
                                                Active
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1
                                                         rounded-full text-sm
                                                         font-medium
                                                         bg-gray-100 text-gray-600">
                                                {{ ucfirst($autorisation->statut) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        {{-- Retour --}}
        <div class="mt-6">

            <a href="{{ route('dashboard') }}"
               class="text-gray-600 hover:text-gray-900">
                ← Retour au dashboard
            </a>

        </div>

    </div>

</x-app-layout>