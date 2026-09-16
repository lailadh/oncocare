<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-4xl">

            {{-- Header --}}
            <div class="text-center mb-8">

                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-[#667085] hover:text-[#16423C] mb-5">
                    ← Retour au choix de l'espace
                </a>

                <div class="flex justify-center items-center gap-2">
                    <div class="w-10 h-10 rounded-2xl bg-[#16423C] text-white flex items-center justify-center">
                        +
                    </div>

                    <span class="text-2xl font-bold text-[#263330]">
                        Onco<span class="text-[#16423C]">•</span>Care
                    </span>
                </div>

                <h1 class="mt-6 text-3xl font-bold text-[#263330]">
                    Créer votre espace Patient
                </h1>

                <p class="mt-2 text-[#667085]">
                    Renseignez vos informations pour créer votre compte.
                </p>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-3xl border border-[#E5E1D8] shadow-sm p-6 md:p-8">

                <form method="POST" action="{{ route('register.patient.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

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
                                autocomplete="family-name"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >

                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
                                autocomplete="given-name"
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >

                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >

                            @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
                                class="w-full rounded-2xl border-[#D9D7CF] focus:border-[#16423C] focus:ring-[#16423C]"
                            >
                        </div>

                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-[#16423C] px-6 py-3.5 text-white font-semibold hover:bg-[#123832] transition"
                        >
                            Créer mon compte Patient
                        </button>
                    </div>

                </form>

            </div>

            <p class="mt-6 text-center text-sm text-[#667085]">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold text-[#16423C] hover:underline">
                    Se connecter
                </a>
            </p>

        </div>

    </div>

</x-guest-layout>