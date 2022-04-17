@extends('layouts.adminhead')
@section('content')
        <div class="user-main-container">
            
            @forelse ($users as $user)
                <div class="form-container">
                    <p>Name : {{ $user->name }}</p>
                    <p>Email : {{ $user->email }}</p>
                    <p>ID : {{ $user->id }}</p>
                    <p>
                        @if ($user->admin)
                            Admin
                        @else
                            User
                        @endif</p>
                    @if ($user->admin === 0)
                    <form action="{{  asset('admin/users/makeAdmin/' .$user->id)}}" method="post" class="width100">
                        @csrf
                        @method('patch')
                        <button type="submit" class="form-btn make-btn">MAKE ADMIN</button>
                    </form> 
                    @else    
                    <form action="{{  asset('admin/users/removeAdmin/' .$user->id)}}" method="post" class="width100">
                        @csrf
                        @method('patch')
                        <button type="submit" class="form-btn remove-btn" >REMOVE ADMIN</button>
                    </form>
                    @endif     
                
                </div>
                @empty
                <h1 class="error-msg">No users Other Than you</h1>
            @endforelse
            
 @endsection