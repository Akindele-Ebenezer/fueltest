@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content') 
        <section class="show-record hide">
            <section class="show-record-side-bar"> 
                <div>
                    <span class="CancelRecordModal">✖</span>
                </div>
                <br><br>
                <em>USER PROFILE</em>
                <hr><br>
                <center class="UserName_PROFILE"></center>
                <br>
                <ul> 
                    <form class="UpdateUser"> 
                        <p>
                            This User created "<em class="Total"></em> Records" so far..
                             
                            <br><br>
                            Approved Tests => <span class="Approved"></span>   
                            <br>
                            Waived Tests => <span class="Waived_"></span>  
                            <br>
                            Failed Tests => <span class="Rejected"></span>  
                        </p>
                        <br> 
                        <li>
                            USERNAME: <br>
                            <input type="text" name="UserName">
                        </li>
                        <li>
                            EMAIL: <br>
                            <input type="text" name="UserEmail">
                        </li>
                        <li>
                            PASSWORD: <br>
                            <input type="text" name="UserPassword">
                        </li>
                        <li>
                            ROLE: <br>
                            <select name="UserRole">
                                <option value="Assign Role..">Assign Role</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="USER">USER</option>
                            </select> 
                        </li>
                        <button type="submit" name="UpdateUser">Update</button>
                    </form>
                </ul>
            </section>
        </section> 
    <section class="previous-records">
        @include('PageTitle')
        @if(Session::get('Role') === 'ADMIN') 
        <section class="add-user">
            <p class="error-message">{{ $ErrorMessage }}</p>
            <form action="/AddUser" method="post"> @csrf 
                <input type="text" placeholder="Username.." name="Name">
                <input type="email" placeholder="Email.." name="Email"> 
                <input type="password" placeholder="Password.." name="Password"> 
                <br>
                <select name="Role">
                    <option value="Assign Role..">Assign Role..</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="USER">USER</option>
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
                            {{-- <label>
                                <input type="submit" name="SortByStatus" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label> --}}
                        Records
                        {{-- <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                        </div> --}}
                    </th> 
                    <th class="resizable">
                            {{-- <label>
                                <input type="submit" name="SortByStatus" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label> --}}
                        Approved
                        {{-- <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                        </div> --}}
                    </th> 
                    <th class="resizable">
                            {{-- <label>
                                <input type="submit" name="SortByStatus" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label> --}}
                        Waived
                        {{-- <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                        </div> --}}
                    </th> 
                    <th class="resizable">
                            {{-- <label>
                                <input type="submit" name="SortByStatus" class="hide">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label> --}}
                        Rejected
                        {{-- <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                        </div> --}}
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
                    @php 
                        $UserId = $User->id; 
    
                        $APPROVED_TESTS = \App\Models\FuelTestRecord::select('id')->where('uid', $UserId)
                                                            ->where('ApprovalForUse', 'APPROVED')
                                                            ->count(); 
                                                            
                        $WAIVED_TESTS = \App\Models\FuelTestRecord::select('id')->where('uid', $UserId)
                                                            ->where('ApprovalForUse', 'WAIVED')
                                                            ->count(); 
    
                        $FAILED_TESTS = \App\Models\FuelTestRecord::select('id')->where('uid', $UserId)
                                                            ->where('ApprovalForUse', 'REJECTED')
                                                            ->count(); 
    
                        $TOTAL_TESTS = \App\Models\FuelTestRecord::select('id')->where('uid', $UserId) 
                                                            ->count(); 
                    @endphp  
                    <td class="action"> 
                        <input type="checkbox" name="DeleteUser[]" value="{{ $User->id }}"> 
                        <img class="admin-edit" src="images/edit.png">
                        {{-- <input type="hidden" name="UserId" value="{{ $User->id }}">  --}}
                        <span class="hide">{{ $User->Name }}</span>
                        <span class="hide">{{ $APPROVED_TESTS }}</span>
                        <span class="hide">{{ $WAIVED_TESTS }}</span>
                        <span class="hide">{{ $FAILED_TESTS }}</span>
                        <span class="hide">{{ $TOTAL_TESTS }}</span>
                        <span class="hide">{{ $User->id }}</span>
                        <span class="hide">{{ $User->Email }}</span>
                        <span class="hide">{{ $User->Password }}</span>
                        <span class="hide">{{ $User->Role }}</span>
                    </td>
                    @endif
                    <td class="user-email">{{ $User->Email }}</td>
                    <td class="user-name">{{ $User->Name }}</td>  
                    @php
                        $NumberOfRecordsCreatedByCurrentUser = \App\Models\FuelTestRecord::select('id')->where('uid', $User->id)
                                                                                        ->count();

                        $NumberOfRecordsCreatedByCurrentUser_APPROVED = \App\Models\FuelTestRecord::select('id')->where('uid', $User->id)
                                                                                        ->where('ApprovalForUse', 'APPROVED')
                                                                                        ->count();

                        $NumberOfRecordsCreatedByCurrentUser_WAIVED = \App\Models\FuelTestRecord::select('id')->where('uid', $User->id)
                                                                                        ->where('ApprovalForUse', 'WAIVED')
                                                                                        ->count();

                        $NumberOfRecordsCreatedByCurrentUser_REJECTED = \App\Models\FuelTestRecord::select('id')->where('uid', $User->id)
                                                                                        ->where('ApprovalForUse', 'REJECTED')
                                                                                        ->count();

                        $NumberOfRecordsCreatedByCurrentUser__PERCENTAGE =  $number_of_all_records_absolute === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser / $number_of_all_records_absolute * 100);

                        $NumberOfRecordsCreatedByCurrentUser_APPROVED__PERCENTAGE =  $number_of_all_records_absolute === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_APPROVED / $number_of_all_records_absolute * 100);

                        $NumberOfRecordsCreatedByCurrentUser_WAIVED__PERCENTAGE =  $number_of_all_records_absolute === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_WAIVED / $number_of_all_records_absolute * 100);

                        $NumberOfRecordsCreatedByCurrentUser_REJECTED__PERCENTAGE =  $number_of_all_records_absolute === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_REJECTED / $number_of_all_records_absolute * 100);

                        $NumberOfRecordsCreatedByCurrentUser__PERCENTAGE_ =  $NumberOfRecordsCreatedByCurrentUser === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser / $NumberOfRecordsCreatedByCurrentUser * 100);

                        $NumberOfRecordsCreatedByCurrentUser_APPROVED__PERCENTAGE_ =  $NumberOfRecordsCreatedByCurrentUser === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_APPROVED / $NumberOfRecordsCreatedByCurrentUser * 100);

                        $NumberOfRecordsCreatedByCurrentUser_WAIVED__PERCENTAGE_ =  $NumberOfRecordsCreatedByCurrentUser === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_WAIVED / $NumberOfRecordsCreatedByCurrentUser * 100);

                        $NumberOfRecordsCreatedByCurrentUser_REJECTED__PERCENTAGE_ =  $NumberOfRecordsCreatedByCurrentUser === 0 ? 0 : ($NumberOfRecordsCreatedByCurrentUser_REJECTED / $NumberOfRecordsCreatedByCurrentUser * 100);

                    @endphp
                    <td class="records">{{ $NumberOfRecordsCreatedByCurrentUser }} ({{ round($NumberOfRecordsCreatedByCurrentUser__PERCENTAGE_, 1) }})% &nbsp;&nbsp; <em> + {{ round($NumberOfRecordsCreatedByCurrentUser__PERCENTAGE, 1) }}%</em></td>  
                    <td class="approved"><span class="Passed">{{ $NumberOfRecordsCreatedByCurrentUser_APPROVED }} ({{ round($NumberOfRecordsCreatedByCurrentUser_APPROVED__PERCENTAGE_, 1) }})%</span> &nbsp;&nbsp; <em> + {{ round($NumberOfRecordsCreatedByCurrentUser_APPROVED__PERCENTAGE, 1) }}%</em></td>  
                    <td class="waived"><span class="Waived">{{ $NumberOfRecordsCreatedByCurrentUser_WAIVED }} ({{ round($NumberOfRecordsCreatedByCurrentUser_WAIVED__PERCENTAGE_, 1) }})%</span> &nbsp;&nbsp; <em> + {{ round($NumberOfRecordsCreatedByCurrentUser_WAIVED__PERCENTAGE, 1) }}%</em></td>  
                    <td class="rejected"><span class="Failed">{{ $NumberOfRecordsCreatedByCurrentUser_REJECTED }} ({{ round($NumberOfRecordsCreatedByCurrentUser_REJECTED__PERCENTAGE_, 1) }})%</span> &nbsp;&nbsp; <em> + {{ round($NumberOfRecordsCreatedByCurrentUser_REJECTED__PERCENTAGE, 1) }}%</em></td>  
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
    <script src="JS/EditUsers.js"></script>
@endsection