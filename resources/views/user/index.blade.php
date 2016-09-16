@extends('template.layouts.container')

@section('content')
<h1>Users</h1>

<p><a class="button" data-open="createUserModal">Create User</a></p>


<div class="reveal" id="createUserModal" data-reveal>
  <h1>New User</h1>
  <form class="" action="{{route('user.store')}}" method="post">
    {{csrf_field()}}
    <div class="small-6 columns">
      First Name:
      <input type="text" name="first_name" required>
      Last Name:
      <input type="text" name="last_name" required>
      Password:
      <input type="password" name="password" required>
    </div>        
    <div class="small-12 columns">
      Email Address:
      <input type="email" name="email" required >
    </div>
    <button type="submit" class="expanded button">Create</button>
  </form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@foreach($users as $user)
  <a href="{{route('user.show',$user->id)}}">{{$user->first_name}} {{$user->last_name}}</a><br/>
@endforeach
@stop
