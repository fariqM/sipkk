@extends('layouts.guest.guest')

@section('content')

<div class="app">
    <div class="app-login">
        <div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">
            <h6 class="f-4 m-a-0">SIPKK</h6>
            <h4>Sistem Pengelolaan Keuangan Komunitas</h4>
            <form class="text-left" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group has-feedback">
                    @error('email')
                    <label class="label-error" for="email">{{ $message }}</label>
                    @enderror
                    <input name="email" class="form-control @error('email') input-error @enderror" placeholder="Email"
                        type="email" required value="{{ old('email') }}">
                    <span class="form-control-feedback">
                        <i class="fa fa-fw fa-envelope"></i>
                    </span>
                </div>
                <div class="form-group has-feedback">
                    @error('password')
                    <label class="label-error" for="password">{{ $message }}</label>
                    @enderror
                    <input name="password" class="form-control @error('password') input-error @enderror" placeholder="Password" type="password">
                    <span class="form-control-feedback">
                        <i class="fa fa-fw fa-key"></i>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary btn-block m-b-15">Login</button>
                {{-- <a href="app-forgot.html"><small>Forgot password?</small></a> --}}
                {{-- <p class="text-muted text-right">
                    Do not have an account?
                    <a href="app-register.html">Create an account</a>
                </p> --}}
            </form>

        </div>
    </div>

    <!-- Modal -->

</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
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

                        <div class="row mb-3">
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

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection