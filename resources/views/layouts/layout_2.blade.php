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
        <div>FUEL TEST</div>
        <div>@yield('header_info')</div>
        <div>DEPASA</div>
    </header> 
    
    @if(!(route('login')))
        <nav>
            <ul>
                <li><a href="{{ route('previous_records') }}">VIEW PREVIOUS RECORDS</a></li>
                <li><a href="{{ route('fuel_test') }}">CREATE NEW RECORD</a></li>
                <li><a href="{{ route('all_records') }}">VIEW ALL RECORDS</a></li>
                <li><a href="/logout">LOG OUT</a></li>
            </ul>
        </nav>
    @endif

    <main>
        @yield('content')
    </main> 
 
</body>
</html>
