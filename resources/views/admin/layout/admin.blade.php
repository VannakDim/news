<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>កូនខ្មែរ - Admin Dashboard</title>

    @include('admin.layout.head')

    @yield('link')

    @livewireStyles

</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">


        @include('admin.layout.sidebar')


        <div class="page-wrapper">

            @include('admin.layout.navbar')

            <div class="content-wrapper">
                @yield('main_body')
            </div>

            @include('admin.layout.footer')

        </div>
    </div>

    @include('admin.layout.script')    
    
    @livewireScripts
    
    @yield('script')

</body>

</html>
