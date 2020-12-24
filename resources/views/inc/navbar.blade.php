<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a href="{{url("/")}}"><img src="{{asset("img/Logo.png")}}" alt="Logo" width="130px"></a>
    <div class="container">

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li><a class="nav-link pr-3" href="{{url('/')}}">Home</a></li>
                <li><a class="nav-link pr-4" href="{{url('bracelets')}}">Bracelets</a></li>
                <li><a class="nav-link pr-4" href="{{url('articles')}}">Articles</a></li>
                <li><a class="nav-link pr-4" href="{{url('partners')}}">Partners</a></li>

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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('profile/'.Auth::user()->id)}}">{{ __('Settings') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{__('Logout')}}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
{{--                Adding bracelet to the cart--}}
{{--                <li class="navbar-item pr-3"><a class="nav-link" href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i></a></li>--}}
            </ul>
        </div>
    </div>
</nav>

