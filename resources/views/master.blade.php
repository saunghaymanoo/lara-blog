<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    @stack('style')
    <!-- Scripts -->
    @vite(['resources/sass/theme.scss', 'resources/js/theme.js'])
    
</head>

<body>
    @include('navbar-nav')
    @yield('content')
    <script src="../../node_modules/venobox/dist/venobox.js"></script>
    <script>
        new VenoBox({
            selector: ".venobox"
        });
    </script>
</body>

</html>