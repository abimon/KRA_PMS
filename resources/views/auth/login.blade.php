@extends('layouts.app', ['title' => 'Login'])

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="floatingInput"
            placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating mb-4">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <a href="{{ route('password.request') }}">Forgot Password</a>
    </div>
    <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
    <p class="text-center mb-0">Don't have an Account? <a href="{{route('register')}}">Sign Up</a></p>
</form>
@endsection