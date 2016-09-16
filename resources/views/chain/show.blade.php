@extends('template.layouts.container')
@section('content')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
tinymce.init(
  {
    selector:'.wysiwyg',
    height:250,
    plugins: 'code',
    toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
    menubar: false
  }
);
</script>

<small><a href="{{route('account.index')}}">Accounts</a> <a href="{{route('account.show',$account->id)}}">&rsaquo;&rsaquo; {{$account->name()}}</a> &rsaquo;&rsaquo;<a href="{{route('account.{account_id}.chain.index',$account->id)}}"> Chains</a> &rsaquo;&rsaquo; {{$chain->name}}</small><br/>
<h1>{{$chain->name}}'s Email Chain</h1>
<div class="row">
  <a class="float-left button" data-open="scheduleModal"><span class="fa fa-email fa-6"></span>Add Message</a>

  <div class="reveal" id="scheduleModal" data-reveal>
    <h1>Add a Message</h1>
    <form class="" action="{{route('account.{account_id}.message.store',$account->id)}}" method="post">
      <br>
      {{csrf_field()}}
      <input type="hidden" name="chain_id" value="{{$chain->id}}">
      Subject:
      <input type="text" name="subject" ><br/>

      Message:
      <textarea class="wysiwyg" name="body" rows="8" cols="40"></textarea><br/>
      <select id="days" name="days">
        <option value="">Select Days After Signup</option>
        <option value="0">Immediately</option>
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{$i}}">{{$i}}</option>
        @endfor
      </select>
      <input type="time" name="time">
      <button class="button" type="submit">Create</button>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <a class="float-right tiny alert button" data-open="deleteModal">Delete Chain</a>
  <div class="reveal" id="deleteModal" data-reveal>

    <form class="" action="{{route('account.{account_id}.chain.destroy',[$account->id,$chain->id])}}" method="post">
        <h5>Are you sure you want to delete this email chain?</h5>
        {{csrf_field()}}
        {{method_field('DELETE')}}
      <button class="button" type="submit">YES</button>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
<div class="row">


<b class="float-left">Copy and Paste this form:</b>

<textarea rows="7" id="reaper-form" readonly>
  <form action="{{env("URL")}}/chain/{{$chain->token}}" method="POST"><br/>
    First Name:<input type="text" name="first_name"><br/>
    Last Name:<input type="text" name="last_name"><br/>
    Email:<input type="email" name="email"><br/>
  <input type="submit" value="submit"><br/>
  </form>
</textarea>


<button class="float-right tiny clipboard-btn button" data-clipboard-target="#reaper-form">
    Copy Form to Clipboard
</button>


<a target="_blank" href="/form/{{$chain->token}}/">Form Link</a>
<p>Copy and paste this form into your website or just send people to this form link.</p>
</div>
<hr>
@foreach($chain->messages->sortBy('days') as $message)
  <b>{{$message->subject}}</b> - @if($message->days == 0)  Immediately @else{{$message->days}} days later @endif  after signup - <a class="float-right tiny alert button" data-open="deleteMessageModal-{{$message->days}}">Delete Message</a><a class="float-right tiny button" data-open="editMessageModal-{{$message->id}}">Edit Message</a><br/>
  <div class="reveal" id="deleteMessageModal-{{$message->days}}" data-reveal>            
    <form class="" action="{{route('account.{account_id}.message.destroy',[$account->id,$message->id])}}" method="post">
        <h5>Are you sure you want to delete this email message?</h5>
        {{csrf_field()}}
        {{method_field('DELETE')}}
      <button class="button" type="submit">YES</button>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="reveal" id="editMessageModal-{{$message->id}}" data-reveal>
    <h1>Edit Message</h1>
    <form class="" action="{{route('account.{account_id}.message.update',[$account->id,$message->id])}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
        Subject:
        <input type="text" name="subject" value="{{$message->subject}}">
        Message:
        <textarea name="body" class="wysiwyg" rows="8" cols="40">{!!$message->body!!}</textarea>

        <input type="submit" value="submit" class="button">
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <br/>
@endforeach
@stop
@section('footer-scripts')
<script type="text/javascript">
new Clipboard('.clipboard-btn ');

$('#days').on('change', function() {
  if( this.value == '0')
  {
    $('input[name="time"]').hide();
  }else{
    $('input[name="time"]').show();
  }
});

</script>
@stop
