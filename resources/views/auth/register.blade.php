@extends('template.layouts.container')

@section('content')
<h1 class="text-center">Register</h1>
<div class="row">
  <div class="medium-5 small-10 small-centered columns">


    <form data-abide method="POST" action="{{ url('/register') }}"  class="register-form">
        {!! csrf_field() !!}

        <label>First Name
          <input type="text" name="first_name" value="{{ old('first_name') }}">
        </label>
        <label>Last Name
          <input type="text" name="last_name" value="{{ old('last_name') }}">
        </label>


        <label>Phone #
          <input type="text" name="phone" value="{{ old('phone') }}">
        </label>

        <label>Address
          <input type="text" name="address" value="{{ old('address') }}">
        </label>
        <label>City
          <input type="text" name="city" value="{{ old('city') }}">
        </label>
        <label>State
          <input type="text" name="state" value="{{ old('state') }}">
        </label>
        <label>Zip
          <input type="text" name="zip" value="{{ old('zip') }}">
        </label>
        <label>E-Mail Address
          <input type="email" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
            <span class="alert label expanded">
              {{ $errors->first('email') }}
            </span>
          @endif
        </label>
        <label>What Industry Are You In?
          <input type="text" name="industry" value="{{ old('industry') }}">
        </label>
          <label>Password
            <input type="password" name="password" required>
            @if ($errors->has('password'))
              <span class="alert label expanded">{{ $errors->first('password') }}</span>
            @endif
          </label>

        <label>Confirm Password
          <input type="password" name="password_confirmation" required>
          @if ($errors->has('password_confirmation'))
            <span class="alert label expanded">{{ $errors->first('password_confirmation') }}</strong>
          @endif
        </label>
        <button type="submit" class="button">
             Register
        </button>

    </form>

  </div>
</div>
@endsection
