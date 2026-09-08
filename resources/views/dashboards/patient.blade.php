<h1>Dashboard Patient</h1>

<p>Bienvenue {{ auth()->user()->prenom }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>