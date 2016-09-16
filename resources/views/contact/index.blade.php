@extends('template.layouts.container')
@section('content')

@if (session('status'))
    <div class="alert callout">
        {{ session('status') }}
    </div>
@endif
<small><a href="{{route('account.index')}}"> Accounts</a> &rsaquo;&rsaquo;<a href="{{route('account.show',$account->id)}}"> {{$account->name()}}</a> &rsaquo;&rsaquo; Contacts</small>


<div class="reveal" id="contactModal" data-reveal>
  <h1>Add New Contact</h1>
  <form class="" action="{{route('account.{account_id}.contact.store',$account->id)}}" method="post">
    {{csrf_field()}}
    First Name:
    <input type="text" name="first_name" required>
    Last Name:
    <input type="text" name="last_name" required>
    Email:
    <input type="email" name="email" required>
    <button class="button" type="submit">Create</button>
  </form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<h1>{{$account->name()}}'s Contacts</h1>
<p><a class="button" data-open="contactModal"><span class="fa fa-user fa-6"></span> Add New Contact</a></p>

<table class="hover">
  <thead>
    <tr>
      <th width="150">Name</th>
      <th width="150">Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach($contacts as $contact)
    <tr>
      <td>
        @if($contact->deleted_at)
          {{$contact->name()}} - Unsubscribed/Deleted<br/>
        @else
          <a href="/account/{{$account->id}}/contact/{{$contact->id}}">{{$contact->name()}}</a><br/>
        @endif
      </td>
      <td>
        {{$contact->email}}
      </td>
    </tr>

    @endforeach
  </tbody>
</table>

@stop
