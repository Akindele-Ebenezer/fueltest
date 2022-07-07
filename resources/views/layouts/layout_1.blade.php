<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">

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
    <link rel="stylesheet" href="/sass/style.css" /> 
</head>
<body>
    <header>
        <div>FUEL TEST</div>
        <div>@yield('header_info')</div>
        <div>DEPASA</div>
    </header> 
     
    <nav>
        <ul>
            <li class="{{ Request::is('previous_records') ? 'active-bg' : '' }}"><a href="{{ route('previous_records') }}" class="{{ Request::is('previous_records') ? 'active' : '' }}">VIEW PREVIOUS RECORDS</a></li>
            <li class="{{ Request::is('fuel_test') ? 'active-bg' : '' }}"><a href="{{ route('fuel_test') }}" class="{{ Request::is('fuel_test') ? 'active' : '' }}">CREATE NEW RECORD</a></li>
            <li class="{{ Request::is('all_records') ? 'active-bg' : '' }}"><a href="{{ route('all_records') }}" class="{{ Request::is('all_records') ? 'active' : '' }}">VIEW ALL RECORDS</a></li>
            <li><a href="/logout">LOG OUT</a></li>
        </ul>
    </nav>

    <main>
        <section class="fuel-test">
             
            <div class="fuel-test-left-nav">
            <center><img src="/images/depasa-logo.png"></center> <br>
                <ul>
                    <a href="{{ route('previous_records') }}"><li class="{{ Request::is('previous_records') ? 'active-dashboard' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M256 0v128h128L256 0zM288 256H96v64h192V256zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM64 72C64 67.63 67.63 64 72 64h80C156.4 64 160 67.63 160 72v16C160 92.38 156.4 96 152 96h-80C67.63 96 64 92.38 64 88V72zM64 136C64 131.6 67.63 128 72 128h80C156.4 128 160 131.6 160 136v16C160 156.4 156.4 160 152 160h-80C67.63 160 64 156.4 64 152V136zM320 440c0 4.375-3.625 8-8 8h-80C227.6 448 224 444.4 224 440v-16c0-4.375 3.625-8 8-8h80c4.375 0 8 3.625 8 8V440zM320 240v96c0 8.875-7.125 16-16 16h-224C71.13 352 64 344.9 64 336v-96C64 231.1 71.13 224 80 224h224C312.9 224 320 231.1 320 240z"/></svg>VIEW PREVIOUS RECORDS <em>{{ $number_of_previous_records }}</em></li></a>
                    <a href="{{ route('fuel_test') }}"><li class="{{ Request::is('fuel_test') ? 'active-dashboard' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/></svg>CREATE NEW RECORD</li></a>
                    <a href="{{ route('all_records') }}"><li class="{{ Request::is('all_records') ? 'active-dashboard' : '' }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256z"/></svg>VIEW ALL RECORDS &nbsp;&nbsp; <em>{{ $number_of_all_records }}</em></li></a>
                    <a href="/logout"><li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM99.5 144.8C77.15 176.1 64 214.5 64 256C64 362 149.1 448 256 448C297.5 448 335.9 434.9 367.2 412.5L99.5 144.8zM448 256C448 149.1 362 64 256 64C214.5 64 176.1 77.15 144.8 99.5L412.5 367.2C434.9 335.9 448 297.5 448 256V256z"/></svg>LOG OUT</li></a>
                    <li class="">STATUS : ONLINE</li>
                    <li>USER : @yield('name')</li>
                    <li>EMAIL : @yield('email')</li>
                    @if(Session::get('email') == 'awadhesh@depasamarine.com') 
                    <li>ADMIN</li>
                    @endif 
                </ul>   
            </div> 
            
            @yield('content')
        </section>
    </main> 
 
</body>
</html>
