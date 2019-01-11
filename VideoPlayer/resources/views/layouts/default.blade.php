<!doctype html>
<html lang="pt-br">
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <div id="main" class="row">
                @yield('content')
            </div>
        </div>
        @include('includes.footer')
    </body>
</html>
