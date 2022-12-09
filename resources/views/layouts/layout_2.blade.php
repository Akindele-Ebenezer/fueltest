<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@900&display=swap" rel="stylesheet"> 

    <link rel="shortcut icon" href="/images/fuel-test.jpg" type="image/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FUEL TEST | @yield('title')</title> 
    <link rel="stylesheet" href="/sass/style.css"/> 
</head>
<body>
    <header>
        <div><a href="{{ route('fuel_test') }}">FUEL TEST</a></div>
        <div>@yield('header_info')</div>
        <div><a href="/">DEPASA</a></div>
    </header> 
    
    @if(!(route('login')))
        <nav>
            <ul>
                <li><a href="{{ route('previous_records') }}">VIEW PREVIOUS RECORDS</a></li>
                <li><a href="{{ route('fuel_test') }}">CREATE NEW RECORD</a></li>
                <li><a href="{{ route('all_records') }}">VIEW REPORT</a></li>
                <li><a href="/logout">LOG OUT</a></li>
            </ul>
        </nav>
    @endif

    <main>
        @yield('content')
        <script src="JS/Loader.js"></script>
    </main> 
 
</body>
</html>
