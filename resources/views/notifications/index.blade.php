<x-app-layout>

    <div class="p-6 max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Mes notifications
                </h1>

                <p class="text-gray-600 mt-1">
                    Retrouvez ici les notifications liées à votre activité sur OncoCare.
                </p>
            </div>

            @if($notifications->where('lu', false)->count() > 0)
                <form method="POST" action="{{ route('notifications.readAll') }}">
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>


        @if($notifications->isEmpty())

            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center">
                <div class="text-4xl mb-3">🔔</div>

                <h2 class="text-lg font-semibold text-gray-800">
                    Aucune notification
                </h2>

                <p class="text-gray-500 mt-1">
                    Vous n'avez aucune nouvelle notification pour le moment.
                </p>
            </div>

        @else

            <div class="space-y-4">

                @foreach($notifications as $notification)

                    <div class="
                        rounded-xl border p-5
                        {{ !$notification->lu
                            ? 'bg-blue-50 border-blue-200'
                            : 'bg-white border-gray-200'
                        }}
                    ">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex gap-3">

                                <div class="text-2xl">
                                    @if($notification->type === 'rendezvous')
                                        📅
                                    @elseif($notification->type === 'suivi')
                                        🩺
                                    @elseif($notification->type === 'autorisation')
                                        👥
                                    @else
                                        🔔
                                    @endif
                                </div>

                                <div>

                                    <div class="flex items-center gap-2">

                                        <h2 class="font-semibold text-gray-800">
                                            {{ $notification->titre }}
                                        </h2>

                                        @if(!$notification->lu)
                                            <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded-full">
                                                Nouveau
                                            </span>
                                        @endif

                                    </div>

                                    <p class="text-gray-600 mt-1">
                                        {{ $notification->message }}
                                    </p>

                                    <p class="text-sm text-gray-400 mt-2">
                                        {{ $notification->date_notification?->format('d/m/Y à H:i') }}
                                    </p>

                                </div>

                            </div>


                            @if(!$notification->lu)

                                <form
                                    method="POST"
                                    action="{{ route('notifications.read', $notification->id_notification) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="text-sm text-blue-600 hover:text-blue-800 whitespace-nowrap"
                                    >
                                        Marquer comme lue
                                    </button>
                                </form>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>