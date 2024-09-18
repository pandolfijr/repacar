@include('header')

<body class="hold-transition sidebar-mini layout-fixed" style="overflow-y: auto;">
    <i class="bi bi-list mobile-nav-toggle d-none" style="color: white; margin-top: 0.5em;"></i>
    <div class="content-wrapper">
        <div id="app" class="d-flex flex-column min-vh-70">
            @yield('content')
            <router-view
                :user-data="{{ json_encode([
                    'Cod' => session('Cod') ?? null,
                    'cliente' => session('cliente') ?? null,
                    'razao' => session('razao') ?? null,
                    'endereco' => session('endereco') ?? null,
                    'telefone' => session('telefone') ?? null,
                    'CIC' => session('CIC') ?? null,
                    'Cep' => session('Cep') ?? null,
                    'email' => session('email') ?? null,
                    'site_User' => session('site_User') ?? null,
                ]) }}"></router-view>

        </div>
    </div>
    @vite('resources/js/app.js')
</body>

@include('footer')

</html>
<style>
    .button-search {
        margin-right: 3em;
        margin-top: -2.6em;
        background: var(--color-primary);
    }

    body {
        min-height: 100vh;
    }
</style>
