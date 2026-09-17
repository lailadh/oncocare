<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-5">

        <div class="w-full max-w-5xl">

            <div
                class="grid grid-cols-1 overflow-hidden rounded-3xl border border-[#E5E1D8] bg-white shadow-sm lg:grid-cols-[1.1fr_1fr]">

                <div class="relative min-h-[240px] overflow-hidden bg-[#E8ECE9] lg:min-h-[560px]">
                    <img src="{{ asset('images/oncocare-proche.png') }}" alt="Famille accompagnant un proche"
                        class="absolute inset-0 h-full w-full object-cover object-center">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#7A5260]/60 via-transparent to-transparent">
                    </div>

                    <div class="absolute bottom-5 left-5 right-5 text-white lg:bottom-7 lg:left-7 lg:right-7">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-white/80">
                            Présence et soutien
                        </p>
                        <p class="mt-2 text-2xl font-semibold leading-tight">
                            Accompagnez ceux qui comptent.
                        </p>
                    </div>
                </div>

                <div class="bg-[#FDFCF9] p-4 sm:p-5 lg:p-6">

                    <div class="text-center mb-4">

                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 text-xs text-[#667085] hover:text-[#A85F76] mb-3">
                            ← Retour au choix de l'espace
                        </a>

                        <div class="flex justify-center items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-[#A85F76] text-white flex items-center justify-center">
                                🤝
                            </div>

                            <span class="text-xl font-bold text-[#263330]">
                                Onco<span class="text-[#16423C]">•</span>Care
                            </span>
                        </div>

                        <h1 class="mt-3 text-2xl font-bold text-[#263330]">
                            Créer votre espace Proche
                        </h1>

                        <p class="mt-1 text-sm text-[#667085]">
                            Créez votre compte pour pouvoir accompagner un patient autorisé.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border border-[#E5E1D8] shadow-sm p-4 md:p-5">

                        <div class="mb-4 rounded-xl bg-[#F8E9EE] border border-[#EBCFD8] p-3">
                            <p class="text-sm text-[#7A5260] leading-6">
                                Votre compte Proche n'est associé automatiquement à aucun patient.
                                L'accès aux informations d'un patient dépend des autorisations
                                accordées depuis son espace.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register.proche.store') }}" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                <div>
                                    <label for="nom" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Nom
                                    </label>

                                    <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required autofocus
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">

                                    @error('nom')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="prenom" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Prénom
                                    </label>

                                    <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">

                                    @error('prenom')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="telephone" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Téléphone
                                    </label>

                                    <input id="telephone" name="telephone" type="text" value="{{ old('telephone') }}"
                                        autocomplete="tel"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">

                                    @error('telephone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Adresse e-mail
                                    </label>

                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                        autocomplete="username"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">

                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-semibold text-[#263330] mb-1">
                                        Mot de passe
                                    </label>

                                    <input id="password" name="password" type="password" required
                                        autocomplete="new-password"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">

                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-[#263330] mb-1">
                                        Confirmer le mot de passe
                                    </label>

                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        required autocomplete="new-password"
                                        class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#A85F76] focus:ring-[#A85F76]">
                                </div>

                            </div>

                            <button type="submit"
                                class="w-full rounded-xl bg-[#A85F76] px-6 py-3 text-white font-semibold hover:bg-[#934F67] transition">
                                Créer mon compte Proche
                            </button>

                        </form>

                    </div>

                    <p class="mt-4 text-center text-sm text-[#667085]">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="font-semibold text-[#A85F76] hover:underline">
                            Se connecter
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>