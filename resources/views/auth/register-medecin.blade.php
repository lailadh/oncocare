<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-5">

        <div class="w-full max-w-4xl">

            <div
                class="grid grid-cols-1 overflow-hidden rounded-3xl border border-[#E5E1D8] bg-white shadow-sm lg:grid-cols-[0.85fr_1.15fr]">

                <div class="relative min-h-[240px] overflow-hidden bg-[#E8ECE9] lg:min-h-[560px]">
                    <img src="{{ asset('images/register-medecin.png') }}" alt="Médecin consultant des images médicales"
                        class="absolute inset-0 h-full w-full object-cover object-center">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#16423C]/55 via-transparent to-transparent">
                    </div>

                    <div class="absolute bottom-5 left-5 right-5 text-white lg:bottom-7 lg:left-7 lg:right-7">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-white/80">
                            La médecine connectée
                        </p>
                        <p class="mt-2 text-2xl font-semibold leading-tight">
                            Accompagnez mieux vos patients.
                        </p>
                    </div>
                </div>

                <div class="bg-[#FDFCF9] p-4 sm:p-5 lg:p-6">

                    <div class="text-center mb-4">

                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 text-xs text-[#667085] hover:text-[#6C63A8] mb-3">
                            ← Retour au choix de l'espace
                        </a>

                        <div class="flex justify-center items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-[#6C63A8] text-white flex items-center justify-center">
                                🩺
                            </div>

                            <span class="text-xl font-bold text-[#263330]">
                                Onco<span class="text-[#16423C]">•</span>Care
                            </span>
                        </div>

                        <h1 class="mt-3 text-2xl font-bold text-[#263330]">
                            Espace Médecin
                        </h1>

                        <p class="mt-1 text-sm text-[#667085]">
                            Renseignez vos informations professionnelles pour créer votre compte.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border border-[#E5E1D8] shadow-sm p-4 md:p-5">

                        <div class="mb-4 rounded-xl bg-[#EEEAF8] border border-[#DDD7F0] p-3">
                            <p class="text-sm text-[#5F5A83] leading-6">
                                Cet espace est destiné aux professionnels de santé.
                                Votre spécialité sera associée à votre profil Médecin.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register.medecin.store') }}" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                {{-- Nom --}}
                                <div>
                                    <label for="nom" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Nom
                                    </label>

                                    <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required autofocus
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">

                                    @error('nom')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Prénom --}}
                                <div>
                                    <label for="prenom" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Prénom
                                    </label>

                                    <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">

                                    @error('prenom')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Téléphone --}}
                                <div>
                                    <label for="telephone" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Téléphone
                                    </label>

                                    <input id="telephone" name="telephone" type="text" value="{{ old('telephone') }}"
                                        autocomplete="tel"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">

                                    @error('telephone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Adresse e-mail
                                    </label>

                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                        autocomplete="username"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">

                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Spécialité --}}
                                <div class="md:col-span-2">
                                    <label for="specialite" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Spécialité médicale
                                    </label>

                                    <select id="specialite" name="specialite" required
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">
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
                                    <label for="password" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Mot de passe
                                    </label>

                                    <input id="password" name="password" type="password" required
                                        autocomplete="new-password"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">

                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Confirmation --}}
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-[#263330] mb-1">
                                        Confirmer le mot de passe
                                    </label>

                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        required autocomplete="new-password"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#6C63A8] focus:ring-[#6C63A8]">
                                </div>

                            </div>

                            <button type="submit"
                                class="w-full rounded-xl bg-[#6C63A8] px-6 py-3 text-white font-semibold hover:bg-[#5E5795] transition">
                                Créer mon compte Médecin
                            </button>

                        </form>

                    </div>

                    <p class="mt-4 text-center text-sm text-[#667085]">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="font-semibold text-[#6C63A8] hover:underline">
                            Se connecter
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>