<x-app-layout>

    <div class="p-6">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-2xl font-bold">
                    Gestion des utilisateurs
                </h1>

                <p class="mt-1 text-gray-600">
                    Consultez les comptes utilisateurs de la plateforme.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="text-blue-600 hover:underline">
                ← Retour Dashboard
            </a>

        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">

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

                    @forelse($users as $user)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $user->prenom }} {{ $user->nom }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->telephone ?? '—' }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full text-sm bg-gray-100">
                                    {{ ucfirst($user->role) }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                @if($user->id !== auth()->id())

                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="text-blue-600 hover:underline">
                                        Modifier
                                    </a>

                                @else

                                    <span class="text-gray-400">
                                        Compte actuel
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-6 text-center text-gray-500">

                                Aucun utilisateur trouvé.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>