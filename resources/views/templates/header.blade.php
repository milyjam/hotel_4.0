<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/hoteis">Hoteis</a>
                </li>
                @if (auth()->user()->profile == "administrador")
                    <li>
                        <a class="nav-link" href="/admin">Administrativo</a>
                    </li>
                @endif
                @if (auth()->check())
                    <li>
                        <a class="nav-link">{{ auth()->user()->nome }}</a>
                    </li>
                @else
                    <p>Usuário não logado</p>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
