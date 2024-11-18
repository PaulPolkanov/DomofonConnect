<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styless.css">
    <title>Auth error</title>
</head>
<body>
    <header>
        <div class="logo">DomofonConnect</div>
    </header>
    <main>
    <section class="hero">
        <h1>Доступ запрешен</h1>
        
        @switch($erorrs)
            @case("not auth")
                <p>Авторизуйтесь и входите через Telegram Bot</p>
                <p>Ссылка: <a href="https://t.me/DomofonConnectBot">@DomofonConnectBot</a></p>
                @break
            @case("not phone")
                <p>Авторизуйтесь в Telegram Bot</p>
                <p>И предоставте номер телефона</p>
                <p>Через команду <a href="#">/auth</a></p>
                <p>Ссылка: <a href="https://t.me/DomofonConnectBot">@DomofonConnectBot</a></p>
                @break
            @case("not tenant")
                <p>Вы не являетесь зарегестрированным пользователем</p>
                <p>Обратитесь к управляющей компании , чтобы вам выдали доступ</p>
                <p>И попробуйте еще раз</p>
                @break
            @default
                
        @endswitch
       
    </section>
</main>
<footer>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <p>&copy; 2024 DomofonConnect.</p>
    <p>проект студентов ВВФ МТУСИ</p>
    <p>Algorithm Avengers</p>
</footer>
</body>
</html>