<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center p-4 md:p-6">

        <div class="w-full max-w-[1450px] overflow-hidden rounded-[32px] bg-white border border-[#E8E3D8] shadow-[0_20px_60px_rgba(38,51,48,0.08)]">

            <div class="grid grid-cols-1 lg:grid-cols-[0.95fr_1.05fr] min-h-[720px]">

                {{-- ========================================================= --}}
                {{-- LEFT : IMAGE --}}
                {{-- ========================================================= --}}
                <div class="relative min-h-[560px] lg:min-h-full overflow-hidden bg-[#DCE8E6]">

                    <img
                        src="{{ asset('images/oncocare-register-hero.png') }}"
                        alt="Accompagnement OncoCare"
                        class="absolute inset-0 h-full w-full object-cover object-center"
                    >

                    {{-- General overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-b from-white/20 via-transparent to-[#F7F6F1]/95"></div>

                    {{-- Bottom readability overlay --}}
                    <div class="absolute inset-x-0 bottom-0 h-[62%] bg-gradient-to-t from-[#F7F6F1] via-[#F7F6F1]/90 to-transparent"></div>

                    <div class="relative z-10 flex h-full flex-col justify-between p-7 md:p-10 lg:p-12">

                        {{-- Logo --}}
                        <div>

                            <div class="inline-flex items-center gap-3 rounded-2xl bg-white/90 backdrop-blur-sm px-4 py-3 shadow-[0_8px_25px_rgba(38,51,48,0.08)]">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#16423C] text-white">
                                    <span class="text-lg font-bold">+</span>
                                </div>

                                <div>
                                    <div class="text-xl md:text-2xl font-bold tracking-tight text-[#263330] leading-none">
                                        Onco<span class="text-[#C49A5A]">•</span>Care
                                    </div>

                                    <div class="mt-1 text-xs text-[#667085]">
                                        Suivi & accompagnement
                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- Message --}}
                        <div class="mt-auto max-w-xl pt-[300px] md:pt-[350px] lg:pt-[380px]">

                            <div class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-4 py-2 shadow-sm">

                                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[#5C8177]">
                                    Bienvenue sur OncoCare
                                </span>

                            </div>


                            <div class="mt-4 rounded-[28px] bg-[#F7F6F1]/95 backdrop-blur-md p-6 md:p-7 shadow-[0_15px_40px_rgba(38,51,48,0.10)]">

                                <h2 class="text-4xl md:text-5xl xl:text-6xl font-semibold leading-[1.03] text-[#263330]">

                                    Votre espace,

                                    <span class="block text-[#5D8C7E]">
                                        toujours à vos côtés.
                                    </span>

                                </h2>

                                <p class="mt-5 max-w-lg text-sm md:text-base leading-7 text-[#465650]">
                                    Retrouvez vos informations, votre suivi et vos rendez-vous
                                    dans un espace pensé pour vous accompagner sereinement.
                                </p>

                            </div>


                            {{-- Values --}}
                            <div class="mt-4 grid grid-cols-3 gap-3">

                                <div class="rounded-2xl bg-white/90 backdrop-blur-sm border border-white/70 px-3 py-3 shadow-sm">
                                    <div class="text-lg text-[#16423C]">♧</div>

                                    <p class="mt-1 text-[11px] md:text-xs font-semibold leading-5 text-[#40514B]">
                                        Suivi personnalisé
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-white/90 backdrop-blur-sm border border-white/70 px-3 py-3 shadow-sm">
                                    <div class="text-lg text-[#B26E83]">♡</div>

                                    <p class="mt-1 text-[11px] md:text-xs font-semibold leading-5 text-[#40514B]">
                                        Soutien humain
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-white/90 backdrop-blur-sm border border-white/70 px-3 py-3 shadow-sm">
                                    <div class="text-lg text-[#C49A5A]">♧</div>

                                    <p class="mt-1 text-[11px] md:text-xs font-semibold leading-5 text-[#40514B]">
                                        Données sécurisées
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- RIGHT : LOGIN --}}
                {{-- ========================================================= --}}
                <div class="bg-white p-6 sm:p-8 md:p-10 lg:p-14 flex items-center">

                    <div class="w-full max-w-md mx-auto">

                        {{-- Header --}}
                        <div class="text-center">

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E6F0E9] text-2xl">
                                🔐
                            </div>

                            <p class="mt-6 text-sm font-semibold uppercase tracking-[0.18em] text-[#5C8177]">
                                Espace sécurisé
                            </p>

                            <h1 class="mt-3 text-3xl md:text-4xl font-semibold text-[#263330]">
                                Bon retour
                            </h1>

                            <p class="mt-3 text-sm leading-6 text-[#667085]">
                                Connectez-vous à votre espace OncoCare.
                            </p>

                        </div>


                        {{-- Session Status --}}
                        @if (session('status'))
                            <div class="mt-6 rounded-2xl bg-[#EEF7F0] border border-[#D5E8D8] p-4 text-sm text-[#3F6750]">
                                {{ session('status') }}
                            </div>
                        @endif


                        {{-- Login form --}}
                        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                            @csrf

                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="block text-sm font-semibold text-[#263330] mb-2"
                                >
                                    Adresse e-mail
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="w-full rounded-2xl border-[#D9D7CF] bg-white px-4 py-3.5 text-[#263330] placeholder-[#98A09D] focus:border-[#16423C] focus:ring-[#16423C]"
                                    placeholder="exemple@email.com"
                                >

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Password --}}
                            <div>

                                <div class="flex items-center justify-between mb-2">

                                    <label
                                        for="password"
                                        class="block text-sm font-semibold text-[#263330]"
                                    >
                                        Mot de passe
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a
                                            href="{{ route('password.request') }}"
                                            class="text-xs font-semibold text-[#16423C] hover:underline"
                                        >
                                            Mot de passe oublié ?
                                        </a>
                                    @endif

                                </div>

                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    class="w-full rounded-2xl border-[#D9D7CF] bg-white px-4 py-3.5 text-[#263330] placeholder-[#98A09D] focus:border-[#16423C] focus:ring-[#16423C]"
                                    placeholder="Votre mot de passe"
                                >

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Remember --}}
                            <div class="flex items-center">

                                <label class="inline-flex items-center cursor-pointer">

                                    <input
                                        id="remember"
                                        name="remember"
                                        type="checkbox"
                                        class="rounded border-[#CFCFC7] text-[#16423C] focus:ring-[#16423C]"
                                    >

                                    <span class="ml-2 text-sm text-[#667085]">
                                        Se souvenir de moi
                                    </span>

                                </label>

                            </div>


                            {{-- Button --}}
                            <button
                                type="submit"
                                class="w-full rounded-2xl bg-[#16423C] px-6 py-3.5 text-white font-semibold shadow-sm hover:bg-[#123832] hover:-translate-y-0.5 transition-all duration-200"
                            >
                                Se connecter
                            </button>

                        </form>


                        {{-- Register --}}
                        <div class="mt-8 text-center">

                            <p class="text-sm text-[#667085]">

                                Vous n'avez pas encore de compte ?

                                <a
                                    href="{{ route('register') }}"
                                    class="font-semibold text-[#16423C] hover:underline"
                                >
                                    Créer un compte
                                </a>

                            </p>

                        </div>


                        {{-- Security note --}}
                        <div class="mt-8 rounded-2xl bg-[#F7F6F1] border border-[#E8E3D8] p-4">

                            <div class="flex items-start gap-3">

                                <div class="mt-0.5 text-[#C49A5A]">
                                    🔒
                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-[#40514B]">
                                        Espace protégé
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-[#667085]">
                                        Vos informations sont accessibles uniquement
                                        selon votre rôle et vos autorisations.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>