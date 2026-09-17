<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-5">

        <div class="w-full max-w-5xl">

            <div class="grid grid-cols-1 overflow-hidden rounded-3xl border border-[#E5E1D8] bg-white shadow-sm lg:grid-cols-[0.85fr_1.15fr]">

                <div class="relative min-h-[260px] overflow-hidden bg-[#E8ECE9] lg:min-h-[620px]">
                    <img
                        src="{{ asset('images/register-patient.png') }}"
                        alt="Medecin accompagnant une patiente"
                        class="absolute inset-0 h-full w-full object-cover object-center"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#16423C]/55 via-transparent to-transparent"></div>

                    <div class="absolute bottom-5 left-5 right-5 text-white lg:bottom-7 lg:left-7 lg:right-7">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-white/80">
                            Un accompagnement humain
                        </p>
                        <p class="mt-2 text-2xl font-semibold leading-tight">
                            Votre parcours, mieux accompagne.
                        </p>
                    </div>
                </div>

                <div class="bg-[#FDFCF9] p-4 sm:p-5 lg:p-7">

            {{-- Header --}}
            <div class="text-center mb-4">

                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 text-xs text-[#667085] hover:text-[#16423C] mb-3">
                    ← Retour au choix de l'espace
                </a>

                <div class="flex justify-center items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-[#16423C] text-white flex items-center justify-center">
                        +
                    </div>

                    <span class="text-xl font-bold text-[#263330]">
                        Onco<span class="text-[#16423C]">•</span>Care
                    </span>
                </div>

                <h1 class="mt-3 text-2xl font-bold text-[#263330]">
                    Créer votre espace Patient
                </h1>

                <p class="mt-1 text-sm text-[#667085]">
                    Renseignez vos informations pour créer votre compte.
                </p>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-2xl border border-[#E5E1D8] shadow-sm p-4 md:p-5">

                <form method="POST" action="{{ route('register.patient.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                        <div>
                            <label for="nom" class="block text-sm font-semibold text-[#263330] mb-1">
                                Nom
                            </label>

                            <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required autofocus
                                autocomplete="family-name"
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">

                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="prenom" class="block text-sm font-semibold text-[#263330] mb-1">
                                Prénom
                            </label>

                            <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required
                                autocomplete="given-name"
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">

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
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">

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
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-[#263330] mb-1">
                                Mot de passe
                            </label>

                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-[#263330] mb-1">
                                Confirmer le mot de passe
                            </label>

                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                autocomplete="new-password"
                                class="w-full rounded-xl border-[#D9D7CF] px-3 py-2.5 focus:border-[#16423C] focus:ring-[#16423C]">
                        </div>

                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-[#16423C] px-6 py-3 text-white font-semibold hover:bg-[#123832] transition">
                            Créer mon compte Patient
                        </button>
                    </div>

                </form>

            </div>

            <p class="mt-4 text-center text-sm text-[#667085]">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold text-[#16423C] hover:underline">
                    Se connecter
                </a>
            </p>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>