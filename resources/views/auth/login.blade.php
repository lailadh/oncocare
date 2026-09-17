<x-guest-layout>
    <div class="min-h-screen bg-[#F7F4F2] lg:grid lg:grid-cols-[1.05fr_0.95fr]">
        <section class="relative hidden min-h-screen overflow-hidden bg-[#D7E6E1] lg:block">
            <img src="{{ asset('images/oncocare-register-hero.png') }}" alt="Accompagnement OncoCare"
                class="absolute inset-0 h-full w-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-[#123832]/90 via-[#16423C]/15 to-transparent"></div>
            <div class="relative z-10 flex min-h-screen flex-col justify-between p-8 xl:p-10">
                <a href="{{ route('home') }}" class="flex w-fit items-center gap-3 text-white"
                    aria-label="OncoCare accueil">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-2xl font-semibold text-[#16423C]">+</span>
                    <span>
                        <span class="block font-serif text-2xl font-semibold tracking-tight">Onco<span
                                class="text-[#D9C18D]">Care</span></span>
                        <span class="block text-xs font-medium uppercase tracking-[0.16em] text-white/75">Suivi &
                            accompagnement</span>
                    </span>
                </a>
                <div class="max-w-xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#D9C18D]">Bienvenue dans votre
                        espace</p>
                    <h1 class="mt-3 font-serif text-4xl font-medium leading-[1.05] text-white xl:text-5xl">Votre suivi,
                        toujours à vos côtés.</h1>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-white/80">Retrouvez vos informations, vos
                        rendez-vous et votre accompagnement dans un espace pensé pour vous.</p>
                </div>
            </div>
        </section>

        <main class="flex min-h-screen items-center justify-center px-5 py-8 sm:px-8 lg:px-12 xl:px-16">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="flex items-center gap-3 lg:hidden" aria-label="OncoCare accueil">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#16423C] text-xl font-semibold text-white">+</span>
                    <span class="font-serif text-2xl font-semibold text-[#263330]">Onco<span
                            class="text-[#C49A5A]">Care</span></span>
                </a>
                <div class="mt-8 lg:mt-0">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#5D8177]">Espace sécurisé</p>
                    <h2 class="mt-2 font-serif text-4xl font-medium tracking-tight text-[#263330]">Bon retour.</h2>
                    <p class="mt-3 text-sm leading-6 text-[#66756F]">Connectez-vous à votre espace OncoCare pour
                        continuer votre suivi.</p>
                </div>

                @if (session('status'))
                    <div class="mt-6 border-l-4 border-[#5D8177] bg-[#EAF2EE] px-4 py-3 text-sm text-[#31584D]">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-7 space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-[#263330]">Adresse
                            e-mail</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="exemple@email.com"
                            class="w-full rounded-lg border-[#D4DED9] bg-white px-4 py-3 text-[#263330] placeholder-[#98A09D] shadow-sm focus:border-[#16423C] focus:ring-[#16423C]">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-4">
                            <label for="password" class="block text-sm font-semibold text-[#263330]">Mot de
                                passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-[#16423C] hover:underline">Mot de passe oublié ?</a>
                            @endif
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="Votre mot de passe"
                            class="w-full rounded-lg border-[#D4DED9] bg-white px-4 py-3 text-[#263330] placeholder-[#98A09D] shadow-sm focus:border-[#16423C] focus:ring-[#16423C]">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <label class="flex cursor-pointer items-center gap-2 text-sm text-[#66756F]">
                        <input id="remember" name="remember" type="checkbox"
                            class="rounded border-[#CFCFC7] text-[#16423C] focus:ring-[#16423C]">
                        <span>Se souvenir de moi</span>
                    </label>
                    <button type="submit"
                        class="w-full rounded-lg bg-[#16423C] px-6 py-3 font-semibold text-white shadow-lg shadow-[#16423C]/10 transition hover:-translate-y-0.5 hover:bg-[#123832]">Se
                        connecter</button>
                </form>

                <p class="mt-6 text-center text-sm text-[#66756F]">Vous n'avez pas encore de compte ? <a
                        href="{{ route('register') }}" class="font-semibold text-[#16423C] hover:underline">Créer un
                        compte</a></p>
                <div class="mt-7 flex items-start gap-3 border-t border-[#E1DCD7] pt-4 text-sm text-[#66756F]">
                    <span class="mt-0.5 text-[#C49A5A]">&#10003;</span>
                    <p><strong class="font-semibold text-[#40514B]">Espace protégé.</strong> Vos informations sont
                        accessibles selon votre rôle et vos autorisations.</p>
                </div>
            </div>
        </main>
    </div>
</x-guest-layout>