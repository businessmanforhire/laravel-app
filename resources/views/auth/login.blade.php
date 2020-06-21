@extends('layouts.auth_app')

@section('content')
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <fieldset class="form-group position-relative has-icon-left">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="form-control-position">
                    <i class="la la-user"></i>
                </div>
            </fieldset>
            <fieldset class="form-group position-relative has-icon-left">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <div class="form-control-position">
                    <i class="la la-key"></i>
                </div>
            </fieldset>
            <div class="form-group row">
{{--                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>--}}
            </div>
            <button type="submit" class="btn btn-outline-amber btn-block"><i class="ft-unlock"></i> Login</button>
            <br><br>
        </form>
    </div>
@endsection
