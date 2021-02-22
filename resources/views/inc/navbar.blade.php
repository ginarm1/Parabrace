<?php
   if(\Illuminate\Support\Facades\Auth::user() != null){
       if( session()-> has('cart-items-count') ){
           session(['cart-items-count'=>
               count(\App\Model\Item::where(['user_id'=>\Illuminate\Support\Facades\Auth::user()->id,'sold'=>0]) -> get())]);
       }else{
           session(['cart-items-count'=> 0]);
       }
   }
?>
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
                <li><a class="nav-link pr-4" href="{{route('bracelets')}}">Bracelets</a></li>
                <li><a class="nav-link pr-4" href="{{route('articles')}}">Articles</a></li>
                <li><a class="nav-link pr-4" href="{{url('partners')}}">Partners</a></li>

                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user() -> role_id == 2)
                    <li><a class="nav-link pr-4" href="{{route('sales')}}">Reports</a></li>
                @endif

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
                    <li><a class="nav-link pr-4" href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i>
                            <span class="badge ml-2 rounded-circle bg-secondary text-white"><?php echo session('cart-items-count');?></span></a></li>
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
            </ul>
        </div>
    </div>
</nav>

