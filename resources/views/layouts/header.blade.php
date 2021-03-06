<header>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm navigation-menu">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" class="app-logo" alt="app-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav">
                    <a class="text-decoration-none nav-item nav-link" href="{{ route('questions.index') }}">
                        <span class="mb-0 home-button">{{ __('All Questions') }}</span>
                    </a>

                    <a class="text-decoration-none nav-item nav-link ml-3"
                       href="{{ route('leaderboard.index') }}">
                        <span class="mb-0 leaderboard-link">{{ __('Leaderboard') }}</span>
                    </a>

                    @if (Auth::check())
                        <a class="text-decoration-none nav-item nav-link ml-3"
                           href="{{ route('favorites.index', Auth::user()) }}">
                            <span class="mb-0 favorites-link">{{ __('My Favorites') }}</span>
                        </a>
                    @endif
                </div>

                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link h5 text-white mr-2 user-actions" href="{{ route('login') }}">
                                    {{ __('Sign In') }}
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link h5 text-white user-actions"
                                   href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle h5 text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="User avatar"
                                     class="user-avatar-mini user-avatar">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile.show', Auth::id()) }}">
                                    {{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
