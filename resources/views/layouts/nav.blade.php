<nav class="border-b border-green-800 ">
    <div class="nav-container">
        <div class="nav-content">
            <div class="logo-section">
                <img src="{{ asset('logo_1.svg') }}" alt="Psych AI Logo">
            </div>

            <div class="nav-links">
                @role('admin')
                    <a href="{{ route('admin.users') }}" class="nav-link">لوحة التحكم</a>
                @endrole

                <a href="{{ route('home') }}" class="nav-link">الرئيسية</a>
                <a href="{{ route('video.index') }}" class="nav-link">الفيديوهات</a>
                <a href="{{ route('articles.index') }}" class="nav-link">المقالات</a>
                <a href="#" class="nav-link">المتخصصون</a>
            </div>

            <div class="action-buttons">
                <a href="{{ route('chat') }}" class="btn-primary">فضفض </a>
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn-secondary">تسجيل الخروج</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary">تسجيل الدخول</a>
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
        <a href="{{ route('home') }}">الرئيسية</a>
        <a href="{{ route('video.index') }}">الفيديوهات</a>
        <a href="{{ route('articles.index') }}">المقالات</a>
        <a href="#">المتخصصون</a>
        <a href="{{ route('chat') }}" class="btn-primary">فضفض </a>
        @auth
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn-secondary">تسجيل الخروج</a>
        @else
            <a href="{{ route('login') }}" class="btn-secondary">تسجيل الدخول</a>
        @endauth
    </div>
</nav>

