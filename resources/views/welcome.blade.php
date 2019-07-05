@extends('layouts.master')

@section('title')
Welcome
@endsection

@section('content')
@include('includes.message-block')
<div class="row">
    <div class="col-md-6">
        <h3>Sign Up</h3>
        <hr>
        <form action="{{route('signup')}}" method="post">
            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                <label for="email-register">Your E-mail</label>
                <input type="email" class="form-control" id="email-register" name="email" value="{{Request::old('email')}}">
            </div>
            <div class="form-group {{$errors->has('first_name_register')?'has-error':''}}">
                <label for="first-name-register">Your First Name</label>
                <input type="text" class="form-control" id="first-name-register" name="first_name_register" value="{{Request::old('first_name_register')}}">
            </div>
            <div class="form-group {{$errors->has('password_register')?'has-error':''}}">
                <label for="password-register">Your Password</label>
                <input type="password" class="form-control" id="password-register" name="password_register" value="{{Request::old('password_register')}}">
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
    <div class="col-md-6">
        <h3>Sign In</h3>
        <hr>
        <form action="{{route('signin')}}" method="post">
            <div class="form-group {{$errors->has('email_login')?'has-error':''}}">
                <label for="email-login">Your E-mail</label>
                <input type="email" class="form-control" id="email-login" name="email_login" value="{{Request::old('email_login')}}">
            </div>
            <div class="form-group {{$errors->has('password_login')?'has-error':''}}">
                <label for="password-login">Your Password</label>
                <input type="password" class="form-control" id="password-login" name="password_login" value="{{Request::old('password_login')}}">
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>
@endsection