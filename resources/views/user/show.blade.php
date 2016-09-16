@extends('template.layouts.container')

@section('content')
<h1>{{$user->name()}}</h1>

<div class="row">
  <div class="medium-4 columns">
    <img src="{{$user->logo}}" alt="" />

    <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      {{method_field('PUT')}}
      <div class="row">
        <div class="small-6 columns">
        First Name:<br/>
        <input type="text" name="first_name" value="{{$user->first_name}}">
        </div>
        <div class="small-6 columns">
        Last Name:<br/>
        <input type="text" name="last_name" value="{{$user->last_name}}">
        </div>
      </div>
      Email:<br/>
      <input type="text" name="email" value="{{$user->email}}">
      Password:<br/>
      <input type="password" name="password" value="">      
      <button type="submit" class="float-left small button">Update</button>
    </form>
    <div class="switch tiny float-right">
      <input class="switch-input" id="active" type="checkbox" name="activeSwitch" value="{{$user->active}}"  {{($user->active == 1) ? 'checked': '' }} >
      <label class="switch-paddle" for="active">
        <span class="show-for-sr">Active User</span>
        <span class="switch-active" aria-hidden="true">On</span>
        <span class="switch-inactive" aria-hidden="true">Off</span>
      </label>
    </div>
  </div>
</div>

@stop
@section('footer-scripts')
<script type="text/javascript">

var active = $('input[name="activeSwitch"]');

active.change(function()
{
  if($(this).val() == '0'){
    $(this).val('1');
  }
  else{
    $(this).val('0');
  }
  var isActive = $(this).val();
  console.log(isActive);
  $.post( "{{route('user.update',$user->id)}}",
    {
      _token: "{{csrf_token()}}",
      _method: "PUT",
      active: isActive,
    })
  .done(function( data ) {
    'returned value '+ console.log(data);
  });

});

</script>
@stop
