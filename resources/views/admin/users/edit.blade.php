<x-app-layout>

    <div class="p-6 max-w-2xl mx-auto">

        <div class="mb-6">

            <h1 class="text-2xl font-bold">
                Modifier le rôle
            </h1>

            <p class="mt-1 text-gray-600">
                Modifier le rôle de
                <strong>
                    {{ $user->prenom }} {{ $user->nom }}
                </strong>
            </p>

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <form method="POST"
                  action="{{ route('admin.users.update', $user) }}">

                @csrf

                @method('PATCH')

                <div>

                    <label for="role"
                           class="block font-medium text-gray-700 mb-2">
                        Rôle
                    </label>

                    <select id="role"
                            name="role"
                            class="w-full border-gray-300 rounded-lg">

                        <option value="patient"
                            {{ $user->role === 'patient' ? 'selected' : '' }}>
                            Patient
                        </option>

                        <option value="medecin"
                            {{ $user->role === 'medecin' ? 'selected' : '' }}>
                            Médecin
                        </option>

                        <option value="proche"
                            {{ $user->role === 'proche' ? 'selected' : '' }}>
                            Proche
                        </option>

                        <option value="admin"
                            {{ $user->role === 'admin' ? 'selected' : '' }}>
                            Administrateur
                        </option>

                    </select>

                    @error('role')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="flex gap-3 mt-6">

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enregistrer
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Annuler
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>