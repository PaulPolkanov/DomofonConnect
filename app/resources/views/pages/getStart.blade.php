@extends('layouts.main')
@section('title')
    Login
@endsection
@section('styles')
<link rel="stylesheet" href="styles.css">
@endsection
@section('content')
    <section class="hero">
        <h1>Welcome to DomofonConnect</h1>
        <p>Your smart home solution</p>
        <button>Get Started</button>
    </section>
    <section class="features">
        <p><h2>Домофоны</h2></p>
        <p id="error"></p>
        <br>
        @foreach ($domofons as $key => $item)
        <div class="feature">
            <h3>Домофон: {{$item['name']}}</h3>
            <p>{{$item['location']['readable_address']}}</p>
            <img src="{{$photos[$item['id']]}}" width="200px" alt="">
            <button id="domfon{{$item['id']}}" style="background:green;padding: 10px 40px;">Open</button>
            
        </div>
        <script>
            $( "#domfon{{$item['id']}}" ).on( "click", function() {
                $.get( "/open_domofon?chat_id={{$id}}&domofon_id={{ $item['id'] }}", function( data ) {
                    alert( data );
                });
            });
        </script>
        @endforeach
    </section>
@endsection