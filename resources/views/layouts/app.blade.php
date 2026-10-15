<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduQuiz')</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @stack('page-css')
</head>
<body>
    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>