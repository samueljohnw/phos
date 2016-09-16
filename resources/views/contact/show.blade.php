@extends('template.layouts.container')
@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
tinymce.init(
  {
    selector:'textarea',
    height:250,
    plugins: 'code',
    toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
    menubar: false
  }
);
</script>
<small><a href="{{route('account.index')}}">Accounts</a> &rsaquo;&rsaquo;<a href="{{route('account.show',$account->id)}}"> {{$account->name()}}</a> &rsaquo;&rsaquo; <a href="{{route('account.{account_id}.contact.index',$account->id)}}">Contacts</a>  &rsaquo;&rsaquo; {{$contact->name()}}</small><br/>
<h1>{{$contact->name()}}</h1>

<a class="button" data-open="scheduleModal"><span class="fa fa-envelope fa-6"></span> Schedule Message</a>
<a class="float-right tiny alert button" data-open="deleteModal">Delete Contact</a>

<div class="row">
  <div class="medium-4 columns">
    <form class="" action="{{route('account.{account_id}.contact.update',[$account->id, $contact->id])}}" method="post">
      {{csrf_field()}}
      {{method_field('PUT')}}
      First Name:
      <input type="text" name="first_name" value="{{$contact->first_name}}">
      Last Name:
      <input type="text" name="last_name" value="{{$contact->last_name}}">
      Email:
      <input type="email" name="email" value="{{$contact->email}}">
      <input class="button" type="submit" value="submit">
    </form>
  </div>
</div>

<hr>

<table>
  <thead>
    <th>
      Subject
    </th>
    <th class="text-right">
      Status
    </th>
  </thead>
  <tbody>
    @foreach($contact->emails as $email)
      <tr>
        <td>
          <a data-open="emailModal{{$email->id}}">{{$email->subject}}</a>
        </td>
        <td class="text-right">
          {{$email->status()}}
        </td>
      </tr>
      <div class="reveal" id="emailModal{{$email->id}}" data-reveal style="border:1px solid #333;padding:10px">
        @if(!$email->sent)
          <a class="float-right tiny alert button" data-open="deleteEmailModal">Delete Email</a>
        @else
          <span class="float-right secondary label">Sent {{$email->scheduled_at->format('F jS Y')}}</span>
        @endif
        To: {{$email->contact->name()}}<br/>
        Subject: {!!$email->subject!!}<br/>

        <hr/>
        {!!$email->body!!}
        <div class="reveal" id="deleteEmailModal" data-reveal>
          <h5>Are you sure you want to delete this email?</h5>
          <form class="" action="{{route('account.{account_id}.email.destroy',[$account->id,$email->id])}}" method="post">
              {{csrf_field()}}
              {{method_field('DELETE')}}
            <button class="button" type="submit">YES</button>
          </form>
          <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    @endforeach
  </tbody>
</table>



<div class="reveal" id="scheduleModal" data-reveal>
  <h1>Schedule a Message</h1>
  <form class="" action="{{route('account.{account_id}.email.store',$account->id)}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="contact_id" value="{{$contact->id}}">

    Subject:
    <input type="text" name="subject" ><br/>

    Message:
    <textarea name="body" rows="8" cols="40"></textarea><br/>
    <div class="row">
      <div class="small-6 columns">
        Date:
        <input type="date" name="date">
      </div>
      <div class="small-6 columns">
        Time:
        <input type="time" name="time">
      </div>
    </div>
    <button class="button" type="submit">Create</button>
  </form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="reveal" id="deleteModal" data-reveal>
  <h5>Are you sure you want to delete this contact?</h5>
  <form class="" action="{{route('account.{account_id}.contact.destroy',[$account->id,$contact->id])}}" method="post">
    {{csrf_field()}}
    {{method_field('DELETE')}}
  <button class="button" type="submit">YES</button>
  </form>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@stop
