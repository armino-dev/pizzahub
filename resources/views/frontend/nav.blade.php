<nav class="navbar fixed-top navbar-dark navbar-expand-md bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-home d-inline-block align-center text-primary"></i>
            {{ config('app.name', 'PizzaHub') }}
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- left side --}}
            @auth
            <ul class="navbar-nav mr-auto">                
                <li class="nav-item"><a class="nav-link" href="#">Order history</a></li>
            </ul>
            @endauth

            {{-- right side --}}
            <ul class="navbar-nav ml-auto">
                {{-- authentication links --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle"
                            id="userDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
								<span class="btn btn-primary rounded-circle p-0"
									style="width:24px;height:24px;line-height:24px;font-size:12px;">
									{{ Auth::user()->initials() }}
								</span>
								<span class="d-none d-md-inline">{{ Auth::user()->name }}</span><span class="caret"></span>
						</a>
                        {{--
                            <a id="userDropdown"
                            class="nav-link dropdown-toggle"
                            href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>--}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a href="{{ route('manage.dashboard') }}" class="dropdown-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
