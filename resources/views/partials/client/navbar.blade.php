<div class="navbar bg-primary">
    <div class="container flex justity-between align-center">
        <div class="menu">
            <i class="material-icons">menu</i>
        </div>
        <a href="#" class="logo mr-auto">
            <img src="{{ asset('images/client/logo_dark.svg')}}" alt="Logo">
        </a>
        <ul class="nav-left">
            <li class="{{ setActive('users.index') }}">
                <a href="{{ route('users.index') }}">Usuarios</a>
            </li>
            <li class="{{ setActive('inboxes.index') }}">
                <a href="{{ route('inboxes.index') }}">Correos</a>
            </li>
        </ul>
        <ul>            
            <li>
                <a href="#">
                    <i class="material-icons-two-tone icon">notifications</i>
                </a>
            </li>
            <li class="dropdown__container" x-data="{ open: false}">
                <a class="cursor-pointer" @click="open = true">
                    <i class="material-icons-two-tone icon text-invalid">verified_user</i>
                    <span>
                       {{ Auth::user()->name}} 
                    </span>   
                    <i class="material-icons-two-tone icon transition" :class="{'rotate-180': open}">expand_more</i>   
                </a>

                <div class="dropdown" 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition:enter="transition"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition"
                    x-transition:leave-end="opacity-0 -translate-y-3"
                    >
                    <div class="dropdown__head">
                        <h4>DNI {{ Auth::user()->dni }}</h4>
                        <livewire:users.show-status :status="Auth::user()->status" />
                    </div>
                    <div class="divider-x"></div>
                    <ul class="dropdown__menu">
                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="material-icons">face</i>
                                <span>Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a 
                                href="{{ route('logout') }}" 
                                onclick="
                                event.preventDefault(); 
                                document.getElementById('logout-form').submit();"
                                >
                                <i class="material-icons">exit_to_app</i>
                                <span>Salir</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>                    
                </div>
            </li>
            
        </ul>
    </div>
</div>

{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        </nav> --}}