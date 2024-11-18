<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header>
        <div class="logo">DomofonConnect</div>
        {{-- <nav>
            <ul>
                <li><a href="#{{$id}}">Intercom</a></li>
                <li><a href="#{{$id}}">Profile</a></li>
                <li><a href="#{{$id}}">Residents</a></li>
                <li><a href="#{{$id}}">Details intercom</a></li>
            </ul>
        </nav> --}}
    </header>
    <main style="margin-bottom:20px;">
        @yield('content')
    </main>
    <footer>
        <p>&copy; 2024 DomofonConnect.</p>
        <p>проект студентов ВВФ МТУСИ</p>
    <p>Algorithm Avengers</p>
    </footer>
</body>
</html>