<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Quran Cindy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->is('surat') || request()->is('surat/*') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('surat') }}">Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}/api/documentation">Documentation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
