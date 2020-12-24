@include('inc.head')

<body>
    <div id="app">
    @include('inc.navbar')
        @include('inc.messages')
        @yield('content')
        @include('inc.footer')

    </div>
</body>
</html>

