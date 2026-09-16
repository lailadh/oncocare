<x-app-layout>

    <div class="min-h-screen bg-[#F7F6F1] py-10 px-4 sm:px-6">

        <div class="max-w-2xl mx-auto">

            {{-- Header --}}
            <div class="mb-8">
                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center text-sm font-medium text-[#667085] hover:text-[#16423C] transition"
                >
                    ← Retour aux utilisateurs
                </a>

                <div class="mt-5">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#6C63A8]">
                        Administration
                    </p>

                    <h1 class="mt-2 text-3xl font-semibold text-[#263330]">
                        Modifier le compte
                    </h1>

                    <p class="mt-2 text-sm text-[#667085]">
                        Modifier le rôle et le statut de
                        <strong class="text-[#263330]">
                            {{ $user->prenom }} {{ $user->nom }}
                        </strong>
                    </p>
                </div>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-[28px] border border-[#E5E1D8]
                        shadow-[0_15px_45px_rgba(38,51,48,0.07)]
                        p-6 sm:p-8">

                {{-- User information --}}
                <div class="mb-8 rounded-2xl bg-[#F7F6F1] border border-[#E5E1D8] p-5">

                    <div class="grid sm:grid-cols-2 gap-5">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-[#8A8F8C]">
                                Nom complet
                            </p>

                            <p class="mt-1 text-sm font-semibold text-[#263330]">
                                {{ $user->prenom }} {{ $user->nom }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-[#8A8F8C]">
                                Email
                            </p>

                            <p class="mt-1 text-sm text-[#40514B] break-all">
                                {{ $user->email }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <form
                    method="POST"
                    action="{{ route('admin.users.update', $user) }}"
                    class="space-y-6"
                >

                    @csrf
                    @method('PATCH')

                    {{-- Role --}}
                    <div>
                        <label
                            for="role"
                            class="block text-sm font-semibold text-[#263330] mb-2"
                        >
                            Rôle
                        </label>

                        <select
                            id="role"
                            name="role"
                            class="w-full rounded-2xl border border-[#D9D7CF]
                                   bg-white px-4 py-3 text-sm text-[#263330]
                                   focus:border-[#16423C] focus:ring-[#16423C]"
                        >

                            <option
                                value="patient"
                                {{ old('role', $user->role) === 'patient' ? 'selected' : '' }}
                            >
                                Patient
                            </option>

                            <option
                                value="medecin"
                                {{ old('role', $user->role) === 'medecin' ? 'selected' : '' }}
                            >
                                Médecin
                            </option>

                            <option
                                value="proche"
                                {{ old('role', $user->role) === 'proche' ? 'selected' : '' }}
                            >
                                Proche
                            </option>

                        </select>

                        @error('role')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Statut --}}
                    <div>
                        <label
                            for="statut"
                            class="block text-sm font-semibold text-[#263330] mb-2"
                        >
                            Statut du compte
                        </label>

                        <select
                            id="statut"
                            name="statut"
                            class="w-full rounded-2xl border border-[#D9D7CF]
                                   bg-white px-4 py-3 text-sm text-[#263330]
                                   focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                        >

                            <option
                                value="active"
                                {{ old('statut', $user->statut) === 'active' ? 'selected' : '' }}
                            >
                                Actif
                            </option>

                            <option
                                value="en_attente"
                                {{ old('statut', $user->statut) === 'en_attente' ? 'selected' : '' }}
                            >
                                En attente
                            </option>

                            <option
                                value="refuse"
                                {{ old('statut', $user->statut) === 'refuse' ? 'selected' : '' }}
                            >
                                Refusé
                            </option>

                        </select>

                        <p class="mt-2 text-xs leading-5 text-[#8A8F8C]">
                            Le statut « En attente » et « Refusé » est principalement utilisé
                            pour les demandes de comptes Médecin.
                        </p>

                        @error('statut')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">

                        <button
                            type="submit"
                            class="flex-1 rounded-2xl bg-[#16423C]
                                   px-5 py-3.5 text-sm font-semibold text-white
                                   hover:bg-[#123832] transition"
                        >
                            Enregistrer les modifications
                        </button>

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="flex-1 rounded-2xl border border-[#D9D7CF]
                                   bg-white px-5 py-3.5 text-center
                                   text-sm font-semibold text-[#40514B]
                                   hover:bg-[#F7F6F1] transition"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>