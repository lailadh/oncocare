<h1>Dashboard Médecin</h1>

<p>Bienvenue Docteur {{ auth()->user()->prenom }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>