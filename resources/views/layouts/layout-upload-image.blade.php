@include("layouts.partials.head-upload-image")

<body>
    <header>
        @include("layouts.partials.header")
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include("layouts.partials.footer")
    </footer>
    @yield('script')
    @include("layouts.partials.script-upload-image")
</body>

</html>
