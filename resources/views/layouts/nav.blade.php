<nav class="border-b border-green-800 ">
    <div class="nav-container">
        <div class="nav-content">
            <div class="logo-section">
                <img src="{{ asset('logo_1.svg') }}" alt="Psych AI Logo">
            </div>

            <div class="nav-links">
                <a href="{{ route('video') }}" class="nav-link">Video</a>
                <a href="{{ route('article') }}" class="nav-link">Articles</a>
                {{-- <a href="{{ route('category') }}" class="nav-link">Categories</a> --}}
                <a href="#" class="nav-link">Specialists</a>
            </div>

            <div class="action-buttons">
                <a href="{{ route('chat') }}" class="btn-primary">Chat with AI</a>
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn-secondary">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                @endauth
            </div>

            <button class="mobile-menu-button">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" />
                </svg>
            </button>
        </div>
    </div>

    <div class="mobile-menu">
        <a href="{{ route('video') }}">Video</a>
        <a href="{{ route('article') }}">Articles</a>
        {{-- <a href="{{ route('category') }}">Categories</a> --}}
        <a href="#">Specialists</a>
        <a href="{{ route('chat') }}" class="btn-primary">Chat with AI</a>
        @auth
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn-secondary">Logout</a>
        @else
            <a href="{{ route('login') }}" class="btn-secondary">Login</a>
        @endauth
    </div>
</nav>
