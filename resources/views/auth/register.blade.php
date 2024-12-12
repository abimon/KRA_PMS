@extends('layouts.app', ['title' => 'Register'])

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
<!-- Sign In Start -->
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-10">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="/" class="">
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>KRA PMS</h3>
                    </a>
                    <h3>Register</h3>
                </div>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cover"><b>Passport Photo</b></label>
                                <div class="ms-2 card p-3 border-dark bg-transparent shadow h-75"
                                    style="border-style:dashed;">
                                    <img id="outCard" src="" style="height: 100%; object-fit:contain;" />
                                    <input type="file" accept="image/*" name="avatar" id="cover" style="display: none;"
                                        class="form-control" onchange="loadcoverFile(event)">
                                    <div class="pt-2" id="desc">
                                        <div class="text-center" style="font-size: xxx-large; font-weight:bolder;">
                                            <i class="bi bi-upload"></i>
                                        </div>
                                        <div class="text-center">
                                            <label for="cover" class="btn btn-success text-white"
                                                title="Upload new profile image">Browse</label>
                                        </div>
                                        <div class="text-center prim">*File supported .png .jpg .webp</div>
                                    </div>
                                    <script>
                                        var loadcoverFile = function (event) {
                                            var image = document.getElementById('outCard');
                                            image.src = URL.createObjectURL(event.target.files[0]);
                                            document.getElementById('cover').value == image.src;

                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">
                                    <label for="fname"
                                        class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                    <input id="fname" type="text"
                                        class="form-control @error('fname') is-invalid @enderror" name="fname"
                                        value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="mname"
                                        class="col-form-label text-md-end">{{ __('Middle Name') }}</label>

                                    <input id="mname" type="text"
                                        class="form-control @error('mname') is-invalid @enderror" name="mname"
                                        value="{{ old('mname') }}" autocomplete="mname" autofocus>

                                    @error('mname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="lname" class="col-form-label text-md-end">{{ __('Surname') }}</label>
                                    <input id="lname" type="text"
                                        class="form-control @error('lname') is-invalid @enderror" name="lname"
                                        value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="contact"
                                        class="col-form-label text-md-end">{{ __('Phone Number') }}</label>
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
                        <div class="col-md-6 mb-2">
                            <label for="nid" class="col-form-label text-md-end">{{ __('ID number') }}</label>
                            <input id="nid" type="text" class="form-control @error('nid') is-invalid @enderror"
                                name="nid" value="{{ old('nid') }}" required autocomplete="nid" maxlength="8"
                                minlength="7">

                            @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="col-form-label text-md-end">{{ __('KRA PIN') }}</label>
                            <input id="kpin" type="text" class="form-control @error('kpin') is-invalid @enderror"
                                name="kpin" value="{{ old('kpin') }}" required autocomplete="kpin">

                            @error('kpin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="col-form-label text-md-end">{{ __("Employer's Name") }}</label>
                            <input id="employer" type="text"
                                class="form-control @error('employer') is-invalid @enderror" name="employer"
                                value="{{ old('employer') }}" required autocomplete="employer">

                            @error('employer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="col-form-label text-md-end">{{ __("Employer's KRA") }}</label>
                            <input id="employer_kra" type="text"
                                class="form-control @error('employer_kra') is-invalid @enderror" name="employer_kra"
                                value="{{ old('employer_kra') }}" required autocomplete="employer_kra">

                            @error('employer_kra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="password-confirm"
                                class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary ">
                                {{ __('Register') }}
                            </button>
                        </div>
                        <p class="text-center mb-0 mt-2">Already have an Account? <a href="{{ route('login') }}">Sign
                                In</a>
                        </p>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection