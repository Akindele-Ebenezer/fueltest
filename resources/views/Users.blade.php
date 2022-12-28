@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        @include('PageTitle')
        @if(Session::get('Role') === 'ADMIN') 
        <section class="add-user">
            <p class="error-message">{{ $ErrorMessage }}</p>
            <form action="/AddUser" method="post"> @csrf 
                <label for="Name">Name</label>
                <input type="text" name="Name">
                <label for="Email">Email</label>
                <input type="email" name="Email"> 
                <label for="Password">Password</label>
                <input type="password" name="Password"> 
                <br>
                <label for="Role">Role</label>
                <select name="Role">
                    <option value="Assign Role..">Assign Role..</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="User">User</option>
                </select>
                <button>Add User</button>
            </form>
        </section>
        @endif
        @include('Search')
        <div class="table other-tables"> 
            <form class="DeleteRecords_" action="">
            <table class="users"> 
                <tr>  
                    <th class="resizable">#</th>
                    @if(Session::get('Role') === 'ADMIN') 
                    <th class="resizable">
                        Action
                    </th>
                    @endif
                    <th class="resizable">
                            <label>
                                <input type="submit" name="SortByEmail" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        Email
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-email">
                            <ul>
                                    <h1>Emails</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('users') }}">Cancel</a></button> <button name="FilterEmails">Filter</button>
                                    </center>
                                    @foreach($FilterEmails as $filter)
                                        @if ($filter->Email === NULL)
                                            @continue
                                        @endif
                                        <li>
                                            <input type="checkbox" name="CheckEmails[]" value="{{ $filter->Email }}"> {{ $filter->Email }}
                                        </li>   
                                    @endforeach
                            </ul>
                        </div> 
                    </th>
                    <th class="resizable user-name">
                            <label>
                                <input type="submit" name="SortByName" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        User Name
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-user-name">
                            <ul>
                                    <h1>Usernames</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('users') }}">Cancel</a></button> <button name="FilterUserNames">Filter</button>
                                    </center>
                                    @foreach($FilterUserNames as $filter)
                                        @if ($filter->Name === NULL)
                                            @continue
                                        @endif
                                        <li>
                                            <input type="checkbox" name="CheckUserNames[]" value="{{ $filter->Name }}"> {{ $filter->Name }}
                                        </li>   
                                    @endforeach
                            </ul>
                        </div> 
                    </th> 
                    <th class="resizable">
                            <label>
                                <input type="submit" name="SortByStatus" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        Status
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-staus">
                            <ul>
                                    <h1>Status</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('users') }}">Cancel</a></button> <button name="FilterStatus">Filter</button>
                                    </center> 
                                        <li>
                                            <input type="checkbox" name="CheckStatus[]" value="1"> Online
                                        </li>    
                                        <li>
                                            <input type="checkbox" name="CheckStatus[]" value="0"> Offline
                                        </li>    
                            </ul>
                        </div>
                    </th>
                    <th class="resizable">
                            <label>
                                <input type="submit" name="SortByRole" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        Role
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-role">
                            <ul>
                                    <h1>Role</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('users') }}">Cancel</a></button> <button name="FilterRole">Filter</button>
                                    </center> 
                                        <li>
                                            <input type="checkbox" name="CheckRole[]" value="ADMIN"> ADMIN
                                        </li>    
                                        <li>
                                            <input type="checkbox" name="CheckRole[]" value="USER"> USER
                                        </li>    
                            </ul>
                        </div>
                    </th>
                </tr>  
                @if($number_of_fuel_test_users == 0)
                <tr>
                    <td>
                         There are no USERS.. 
                    </td>
                </tr>
                @endif  
                @foreach($fuel_test_users as $User)
                <tr> 
                    <td class="user-id">{{ $User->id }}</td>
                    @if(Session::get('Role') === 'ADMIN') 
                    <td class="action"> 
                        <input type="checkbox" name="DeleteUser[]" value="{{ $User->id }}">
                    </td>
                    @endif
                    <td class="user-email">{{ $User->Email }}</td>
                    <td class="user-name">{{ $User->Name }}</td>  
                    <td class="status"><p class="{{ $User->Status === 1 ? 'online' : 'offline' }}"></p></td>  
                    <td class="role">{{ $User->Role }}</td>  
                </tr>  
                @endforeach 
                <div class="links">  
                    {{ $fuel_test_users->onEachSide(1)->links() }}   
                </div>  
            </table>  
            @if(Session::get('Role') === 'ADMIN')  
            <button type="submit" name="Delete_">Delete</button>
            @endif
            </form>
        </div>
    </section>
    <script src="JS/Resizable.js"></script>
    <script src="JS/Filter.js"></script>
@endsection