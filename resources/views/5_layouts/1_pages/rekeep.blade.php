<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ReKeep</title>

    @yield('header')

</head>
<body>
    <div class="rk-app">
        @yield('menubar')

        <div class="rk-layout">

            <div class="rk-sidebar"
                 :style="{ left: showsidebar.offcanvas + 'px' }"
                 transition="rk-sidebar--fade">

                @yield('logo')

                <div class="rk-sidebar__content">
                    @yield('sidebar')
                </div> <!-- END .rk-sidebar__content -->

            </div> <!-- END .rk-sidebar -->

            @yield('menusettings')
            @yield('pagesettings')

            <div class="rk-content">
                @yield('contentbar')
                @yield('content')
            </div>

            @yield('nodedetails')

        </div> <!-- END .layout-->

        @yield('flashmessages')
    </div>

    @yield('scripts')

</body>
</html>
