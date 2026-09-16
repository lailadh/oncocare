<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-4xl">

            <div class="text-center mb-8">

                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-[#667085] hover:text-[#6C63A8] mb-5">
                    ← Retour au choix de l'espace
                </a>

                <div class="flex justify-center items-center gap-2">
                    <div class="w-10 h-10 rounded-2xl bg-[#6C63A8] text-white flex items-center justify-center">
                        🩺
                    </div>

                    <span class="text-2xl font-bold text-[#263330]">
                        Onco<span class="text-[#16423C]">•</span>Care
                    </span>
                </div>

                <h1 class="mt-6 text-3xl font-bold text-[#263330]">
                    Espace Médecin
                </h1>

                <p class="mt-2 text-[#667085]">
                    Renseignez vos informations professionnelles pour créer votre compte.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-[#E5E1D8] shadow-sm p-6 md:p-8">

                <div class="mb-6 rounded-2xl bg-[#EEEAF8] border border-[#DDD7F0] p-4">
                    <p class="text-sm text-[#5F5A83] leading-6">
                        Cet espace est destiné aux professionnels de santé.
                        Votre spécialité sera associée à votre profil Médecin.
                    </p>
                </div>

                <form method="POST" action="{{ route('register.medecin.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Nom --}}
                        <div>
                            <label for="nom" class="block text-sm font-semibold text-[#263330] mb-2">
                                Nom
                            </label>

                            <input
                                id="nom"
                                name="nom"
                                type="text"
                                value="{{ old('nom') }}"
                                required
                                autofocus
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >

                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Prénom --}}
                        <div>
                            <label for="prenom" class="block text-sm font-semibold text-[#263330] mb-2">
                                Prénom
                            </label>

                            <input
                                id="prenom"
                                name="prenom"
                                type="text"
                                value="{{ old('prenom') }}"
                                required
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >

                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Téléphone --}}
                        <div>
                            <label for="telephone" class="block text-sm font-semibold text-[#263330] mb-2">
                                Téléphone
                            </label>

                            <input
                                id="telephone"
                                name="telephone"
                                type="text"
                                value="{{ old('telephone') }}"
                                autocomplete="tel"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >

                            @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#263330] mb-2">
                                Adresse e-mail
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Spécialité --}}
                        <div class="md:col-span-2">
                            <label for="specialite" class="block text-sm font-semibold text-[#263330] mb-2">
                                Spécialité médicale
                            </label>

                            <select
                                id="specialite"
                                name="specialite"
                                required
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >
                                <option value="">Sélectionnez votre spécialité</option>

                                <option value="Oncologie" {{ old('specialite') === 'Oncologie' ? 'selected' : '' }}>
                                    Oncologie
                                </option>

                                <option value="Chirurgie oncologique" {{ old('specialite') === 'Chirurgie oncologique' ? 'selected' : '' }}>
                                    Chirurgie oncologique
                                </option>

                                <option value="Hématologie" {{ old('specialite') === 'Hématologie' ? 'selected' : '' }}>
                                    Hématologie
                                </option>

                                <option value="Radiothérapie" {{ old('specialite') === 'Radiothérapie' ? 'selected' : '' }}>
                                    Radiothérapie
                                </option>

                                <option value="Médecine générale" {{ old('specialite') === 'Médecine générale' ? 'selected' : '' }}>
                                    Médecine générale
                                </option>

                                <option value="Autre" {{ old('specialite') === 'Autre' ? 'selected' : '' }}>
                                    Autre
                                </option>
                            </select>

                            @error('specialite')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-[#263330] mb-2">
                                Mot de passe
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirmation --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-[#263330] mb-2">
                                Confirmer le mot de passe
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#6C63A8] focus:ring-[#6C63A8]"
                            >
                        </div>

                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-[#6C63A8] px-6 py-3.5 text-white font-semibold hover:bg-[#5E5795] transition"
                    >
                        Créer mon compte Médecin
                    </button>

                </form>

            </div>

            <p class="mt-6 text-center text-sm text-[#667085]">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold text-[#6C63A8] hover:underline">
                    Se connecter
                </a>
            </p>

        </div>

    </div>

</x-guest-layout>