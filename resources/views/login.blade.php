@php

    $title = 'Log In';
    $header_info = 'Manage all your Records effectively. Log In';
 
@endphp

@extends('layouts.layout_2')

@section('header_info', $header_info)
@section('title', $title)
@section('content')
    <section class="log-in">
        <div style="background-image: url('/images/fuel-test.jpg')"></div>
        <div>
            <form action="/login" method="post">
                @csrf
                <span>{{ $WrongCredentials }}</span>
                <p>Create active records! &nbsp;&nbsp;&nbsp; <button class="log-in-button">Log In</button> </p>
                <br>
                <h2>Log In</h2>
                <span>{{ $EmailError }}</span><br>
                <label for="Email">Email</label> <br>
                <input type="email" name="Email" placeholder="example@depasamarine.com"> <br>
                <span>{{ $PasswordError }}</span><br>
                <label for="Password">Password</label> <br>
                <input type="password" name="Password" placeholder="8+ Characters..">
                <br>
                <button type="submit" class="log-in-button" name="Submit">Log In</button>
            </form>
        </div>
    </section>
    <script src="/JS/LogIn.js"></script> 
    {{-- <script src="js-loading-overlay.min.js"></script>
    <script>
        JsLoadingOverlay.show({'spinnerIcon': 'triangle-skew-spin'});
    </script> --}}
@endsection