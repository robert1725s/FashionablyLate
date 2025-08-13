<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <h1 class="header__title">FashionablyLate</h1>
    </header>
    <main>
        <div class="container">
            <h2 class="page-title">@yield('page-title')</h2>
            @yield('content')
        </div>
    </main>
</body>

</html>
