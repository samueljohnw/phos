@extends('template.layouts.container')
@section('content')

<small><a href="{{route('account.index')}}"> Accounts</a> &rsaquo;&rsaquo; <a href="{{route('account.show',$account->id)}}"> {{$account->name()}}</a> &rsaquo;&rsaquo; Settings</small>

<h1>Settings</h1>

<form class="" action="" method="post">
{{csrf_field()}}

Email Provider
<select class="" name="emailProvider">
  <option value="">Select A Provider</option>
  <option value="mailchimp" @if($account->settings()->get('emailProvider') == 'mailchimp') selected  @endif>MailChimp</option>
</select>
API KEY
<input type="text" name="api_key" value="{{$account->settings()->get('api_key')}}">
List Id
<input type="text" name="listID" value="{{$account->settings()->get('listID')}}">
<input type="submit" name="name" value="Submit" class="button">
</form>
@stop
