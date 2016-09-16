@extends('template.layouts.container')

<!-- Main Content -->
@section('content')

@if (session('status'))
  <div class="alert">
      {{ session('status') }}
  </div>
@endif

<form method="POST" action="{{ url('/password/email') }}">
    {!! csrf_field() !!}
    <label>E-Mail Address
      <input type="email" name="email" value="{{ old('email') }}">
    </label>
    <button type="submit" class="button">
        Send Password Reset Link
    </button>
</form>

@endsection
