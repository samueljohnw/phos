@extends('template.layouts.container')

@section('content')
<br/>
<center><img width="150px" class="logo" src="/light.svg"></center>
<h1 class="text-center" style="color:#fff;">Login Here</h1>

<div class="row">

  <div class="login-container medium-5 small-10 small-centered columns">

    <form method="POST" action="{{ url('/login') }}" class="login-form">

      {!! csrf_field() !!}

      <label>
        E-Mail Address
        <input type="email" name="email" value="{{ old('email') }}">
      </label>

      @if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
      @endif

      <label>Password
        <input type="password" name="password">
      </label>

      @if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
      @endif

      <label>
          <input type="checkbox" name="remember"> Remember Me
      </label>

      <button type="submit" class="button">
          Login
      </button>

      <a class="hide" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
    </form>
  </div>
</div>
@endsection
