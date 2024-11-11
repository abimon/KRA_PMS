@extends('layouts.app')

@section('content')
<style>
    .success {
        outline: 2px solid green;
    }

    .error {
        outline: 2px solid red;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Define regular expression
        var regex = /^\d*[.]?\d*$/;

        $("#contact").on("input", function () {
            // Get input value
            var inputVal = $(this).val();

            // Test input value against regular expression
            if (regex.test(inputVal)) {
                $(this).removeClass("error").addClass("success");
            } else {
                $(this).removeClass("success").addClass("error");
                document.getElementById('errorPhone').style.display = '';
            }
        });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h3 class="card-header fw-bold text-center">{{ __('Register') }}</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="fname"
                                        class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                    <div class="col-md-8">
                                        <input id="fname" type="text"
                                            class="form-control @error('fname') is-invalid @enderror" name="fname"
                                            value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="mname"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>

                                    <div class="col-md-8">
                                        <input id="mname" type="text"
                                            class="form-control @error('mname') is-invalid @enderror" name="mname"
                                            value="{{ old('mname') }}" required autocomplete="mname" autofocus>

                                        @error('mname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="lname"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                                    <div class="col-md-8">
                                        <input id="lname" type="text"
                                            class="form-control @error('lname') is-invalid @enderror" name="lname"
                                            value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="contact"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                                    <div class="col-md-8">
                                        <input id="contact" type="text"
                                            class="form-control @error('contact') is-invalid @enderror" name="contact"
                                            value="{{ old('contact') }}" required autocomplete="contact" minlength="9"
                                            maxlength="13">
                                        <small class="text-danger" id="errorPhone" style="display:none;">Only
                                            digits(0-9)
                                            are required</small>
                                        @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="nid"
                                        class="col-md-4 col-form-label text-md-end">{{ __('ID number') }}</label>

                                    <div class="col-md-8">
                                        <input id="nid" type="text"
                                            class="form-control @error('nid') is-invalid @enderror" name="nid"
                                            value="{{ old('nid') }}" required autocomplete="nid" maxlength="8"
                                            minlength="7">

                                        @error('nid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('KRA PIN') }}</label>
                                    <div class="col-md-8">
                                        <input id="kpin" type="text"
                                            class="form-control @error('kpin') is-invalid @enderror" name="kpin"
                                            value="{{ old('kpin') }}" required autocomplete="kpin">

                                        @error('kpin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                    <div class="col-md-8">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="text-end">
                                <a class="btn btn-link text-secondary" href="{{ route('login') }}">
                                    {{ __('Login instead?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection