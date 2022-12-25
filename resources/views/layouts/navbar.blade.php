<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            Home
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                {{-- <li class="nav-item">
                     <a class="nav-link" href="{{ route('channels.index') }}">Channels</a>
                 </li>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Notifications
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span>{{auth()->user()->unreadNotifications->count()}}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('discussions.show' ,['id' => $notification->data['discussion_id']]) }}"
                                   class="dropdown-item">
                                    {{ $notification->data['user_name'] }} {{$notification->data['subject']}}
                                    <span
                                        class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
                                </a>
                            @empty
                                <p class="dropdown-item">no new notifications</p>
                            @endforelse
                            <div class="dropdown-divider"></div>
                            @livewire('notifications')
                            <a href="#" class="dropdown-item dropdown-footer">see all notifications</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
