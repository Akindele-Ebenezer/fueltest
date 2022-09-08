@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        @include('PageTitle')
        @if(Session::get('email') == 'awadhesh@depasamarine.com') 
        <section class="add-user">
            <form action="/AddUser" method="post"> @csrf 
                <label for="Name">Name</label>
                <input type="text" name="Name">
                <label for="Email">Email</label>
                <input type="email" name="Email"> 
                <label for="Password">Password</label>
                <input type="password" name="Password"> 
                <button>Add User</button>
            </form>
        </section>
        @endif
        <div> 
            <table class="users"> 
                <tr>  
                    <th>#</th>
                    <th>Email</th>
                    <th class="user-name">User Name</th> 
                </tr>  
                @foreach($fuel_test_users as $User)
                <tr> 
                    <td class="user-id">{{ $User->id }}</td>
                    <td class="user-email">{{ $User->Email }}</td>
                    <td class="user-name">{{ $User->Name }}</td>  
                </tr>  
                @endforeach
            </table> 
            <!-- Pagination links -->
        </div>
    </section>
@endsection