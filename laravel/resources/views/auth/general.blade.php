<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen ">
    <h3>CarFly</h3>
    @yield('content')
    <p class="m-t"> <small>&copy; {{ date('Y') }}</small> </p>
</div>
</body>
</html>
