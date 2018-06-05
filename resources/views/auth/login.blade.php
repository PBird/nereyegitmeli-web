@extends('layouts.app')

@section('content')


<div class="login-box">
  <div class="login-logo">
    <a href="{{route('login')}}">{{ __('Login') }}</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
         @csrf
        <div class="form-group has-feedback">
          <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" name="email" required>
          @if ($errors->has('email'))
          <span class="fa fa-envelope form-control-feedback">

              {{ $errors->first('email') }}

          </span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" required="">
           @if ($errors->has('password'))
             <span class="fa fa-lock form-control-feedback">{{ $errors->first('password') }}</span>
           @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


@endsection
