<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Сервис публикации коротких текстов и кода">
    <meta name="keywords" content="">
    <meta name="PRAGMA" content="NO-CACHE">
    <meta name="author" content="IntroZorn - Pavel Khrolenko">
    <meta name="generator" content="IntroZorn">

    <link rel="apple-touch-icon" sizes="114x114" href="/public/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/fav/favicon-16x16.png">
    <link rel="manifest" href="/public/fav/site.webmanifest">
    <link rel="mask-icon" href="/public/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#000000">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>@yield('main-title')</title>
    <link type="text/css" rel="stylesheet" href="public/shl/styles/shCoreEclipse.css">
    <link type="text/css" rel="stylesheet" href="public/shl/styles/shThemeEclipse.css">
    <script class="javascript" src="public/shl/scripts/XRegExp.js"></script>
    <script class="javascript" src="public/shl/scripts/shLegacy.js"></script>
    <script class="javascript" src="public/shl/scripts/shCore.js"></script>
    <script class="javascript" src="public/shl/scripts/shMegaLang.js"></script>


@yield('codemirror')


<script type="text/javascript">
SyntaxHighlighter.all();
</script>
</head>
<body>
    @yield('content')
</body>
</html>
