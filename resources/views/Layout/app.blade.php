<html>
    <head>
        <title>Contact Manager Application</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Contact Management application for ostad task">
        <meta name="author" content="Faruk Hossen">

        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    </head>
    <body>
       @include('Layout.header')
            @yield('content');
       @include('Layout.footer')
        <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    </body>
</html>