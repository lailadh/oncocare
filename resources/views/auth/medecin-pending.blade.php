<x-guest-layout>

    <div class="min-h-screen bg-[#F7F6F1] flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-xl">

            <div
                class="bg-white rounded-[30px] border border-[#E5E1D8]
                       shadow-[0_15px_45px_rgba(38,51,48,0.08)]
                       p-8 md:p-10 text-center"
            >

                {{-- Icon --}}
                <div
                    class="mx-auto flex h-20 w-20 items-center justify-center
                           rounded-3xl bg-[#EEEAF8] text-3xl"
                >
                    🩺
                </div>

                {{-- Label --}}
                <p class="mt-7 text-sm font-semibold uppercase tracking-[0.16em] text-[#6C63A8]">
                    Espace Médecin
                </p>

                {{-- Title --}}
                <h1 class="mt-3 text-3xl font-semibold text-[#263330]">
                    Votre demande est en attente
                </h1>

                {{-- Description --}}
                <p class="mt-4 text-sm leading-7 text-[#667085]">
                    Bonjour {{ $user->prenom }},
                    votre demande d’accès à l’espace Médecin
                    a bien été enregistrée.
                </p>

                {{-- Info --}}
                <div
                    class="mt-6 rounded-2xl border border-[#DDD9EF]
                           bg-[#F5F3FB] p-5 text-left"
                >
                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⏳
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-[#514B70]">
                                Validation administrative
                            </p>

                            <p class="mt-1 text-xs leading-5 text-[#6B6A7D]">
                                Un administrateur doit valider votre compte
                                avant que vous puissiez accéder aux
                                fonctionnalités réservées aux médecins.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Buttons --}}
                <div class="mt-7 flex flex-col sm:flex-row gap-3">

                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex-1 rounded-2xl border border-[#D9D7CF]
                               px-5 py-3.5 text-sm font-semibold
                               text-[#40514B] hover:bg-[#F7F6F1]
                               transition"
                    >
                        Se déconnecter
                    </a>

                    <a
                        href="{{ route('home') }}"
                        class="flex-1 rounded-2xl bg-[#16423C]
                               px-5 py-3.5 text-sm font-semibold text-white
                               hover:bg-[#123832] transition"
                    >
                        Retour à l'accueil
                    </a>

                </div>

                {{-- Logout form --}}
                <form
                    id="logout-form"
                    method="POST"
                    action="{{ route('logout') }}"
                    class="hidden"
                >
                    @csrf
                </form>

            </div>

        </div>

    </div>

</x-guest-layout>