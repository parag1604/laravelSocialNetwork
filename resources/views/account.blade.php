@extends('layouts.master')

@section('title')
Account
@endsection

@section('content')
@include('includes.message-block')
<section class="row">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Your account</h3></header>
        @if(Storage::disk('local')->has($user->id . '.jpg'))
        <section>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <img src="{{ route('account.image', ['filename' => $user->id . '.jpg']) }}" alt="My profile photo" height="200px">
                </div>
            </div>
        </section>
        @endif
        <form action="{{route('account.save')}}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{$user->first_name}}">
            </div>
            <div class="form-group">
                <label for="image">Image (only *.jpg)</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save Account</button>
            <input type="hidden" name="_token" value={{ Session::token() }}>
        </form>
    </div>
</section>
@endsection