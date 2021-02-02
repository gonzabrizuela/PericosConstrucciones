@extends('layouts.app', ['bodyclass' => 'bg-dark', 'hidenav' => true])

@section('content')

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <!--<input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">-->
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>Credenciales no v&aacute;lidas.</strong>
                    </span>
                    @endif  
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <!--<input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">-->
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <!--<div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Remember Password</label>
                    </div>-->
                </div>

                <!--<a class="btn btn-primary btn-block" href="{{ url('/') }}">Login</a>-->

                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
                </button>
                
            </form>

            <div class="text-center">
                <!--<a class="d-block small mt-3" href="{{ url('/admin/register') }}">Register an Account</a>
                <a class="d-block small" href="{{ url('/admin/forgot-password') }}">Forgot Password?</a>-->
            </div>
        </div>
    </div>
</div>

@endsection
