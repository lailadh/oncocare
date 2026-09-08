<h1>Demander un rendez-vous</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('patient.rendezvous.store') }}">

    @csrf

    <div>
        <label>Médecin :</label>

        <select name="id_medecin" required>
            <option value="">-- Choisir un médecin --</option>

            @foreach ($medecins as $medecin)
                <option value="{{ $medecin->id_medecin }}">
                    Dr. {{ $medecin->utilisateur->nom }}
                    {{ $medecin->utilisateur->prenom }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Date et heure :</label>

        <input
            type="datetime-local"
            name="date_heure"
            required
        >
    </div>

    <br>

    <div>
        <label>Motif :</label>

        <textarea
            name="motif"
            required
        ></textarea>
    </div>

    <br>

    <button type="submit">
        Envoyer la demande
    </button>

</form>

<br>

<a href="{{ route('patient.rendezvous.index') }}">
    ← Mes rendez-vous
</a>