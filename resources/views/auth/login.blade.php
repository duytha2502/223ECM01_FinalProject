@extends('layouts.app')

@section('content')
<div>
    <div class="block-banner-img">
        <img class="login-banner-img" src="./assets/img/banner/loginbanner.jpg" alt="">
    </div>
</div>
<div class="container login">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a id="card-header-title">{{ __('Login') }}
                    </a>
                </div>
                <div class="card-body">
                    <br>
                    <div class="card-body-wel row">
                        <br>
                        <br>
                        <div class="card-body-wel_txt">
                            <p class="wel-txt"> Wellcome to </p>
                        </div>
                        <div class="card-body-wel_img">
                            <img style="width:100%" src="./assets/img/logo/logo.png" alt="">
                        </div>
                    </div>
                    <br>
                    <div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                                    }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
                                    }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                            old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <div class="col-md-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    <div class="col-md-12 offset-md-1">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    <div class="sign-in-diff">  
                        <p class="sign-in-diff_txt">Or</p>
                        <div class="sign-in-diff_btn">
                            <button type="button" class="google-sign-in-button" >
                                <a href="{{ route('google-auth') }}">
                                    Sign in with Google
                                </a>
                            </button>
                            <button type="button" class="facebook-sign-in-button" >
                            <a href="">
                                Sign in with Facebook
                            </a>
                            </button>
                            <button type="button" class="github-sign-in-button" >
                                <a href="{{ route('github-auth') }}">
                                    Sign in with Github
                                </a>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="register-block">
                            @if (Route::has('register'))
                                {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                                <a class="nav-link" href="{{ route('register') }}">Don't have account yet?</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection