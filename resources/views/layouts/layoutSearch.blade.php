@include("layouts.partials.head")

<body>
    <header>
        @include("layouts.partials.headerSearch")
    </header>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
    @yield('script')
</body>

</html>
