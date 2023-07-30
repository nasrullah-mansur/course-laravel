<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Nasrullah Mansur">
    <title>Divine Coder :: Course Outline</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/welcome.css') }}">
    <link rel="shortcut icon" href="{{ asset('front/images/favicon.png') }}" type="image/x-icon">

    @stack('plugin_css')
</head>
<body>

    @include('front.component.head')

    <main class="main-content-area">
        @yield('component')
    </main>

    <footer class="bg-light">
        <p class="m-0 py-3 text-center">&copy; All right reserved | <a href="https://divinecoder.com/" target="_blank">Nasrullah Mansur</a> | <a href="tel:+8801728619733">+8801728619733</a> | <a href="mailto:nasrullah.cit.bd@gmail.com">nasrullah.cit.bd@gmail.com</a></p>
    </footer>

    @include('front.component.script')
</body>
</html>