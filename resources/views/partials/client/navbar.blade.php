<div class="navbar bg-primary">
    <div class="container flex justity-between align-center">
        <div class="menu">
            <i class="material-icons">menu</i>
        </div>
        <a href="{{ route('home') }}" class="logo mr-auto">
            <img src="{{ asset('images/client/logo_dark.svg')}}" alt="Logo">
        </a>

        @if(Auth::user()->isAdmin())
        <ul class="nav-left">
            <li class="{{ setActive('users.index') }}">
                <a href="{{ route('users.index') }}">Usuarios</a>
            </li>
            <li class="{{ setActive('inboxes.index') }}">
                <a href="{{ route('inboxes.index') }}">Correos</a>
            </li>
        </ul>
        @endif
        <ul>            
            <li>
                <a href="#">
                    <i class="material-icons-two-tone icon">notifications</i>
                </a>
            </li>
            {{-- <li class="dropdown__container" x-data="{ open: false}">
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
            </li> --}}
            <dropdown-auth :user="{{ Auth::user() }}"></dropdown-auth>
            
        </ul>
    </div>
</div>