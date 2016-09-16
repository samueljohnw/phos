@extends('template.layouts.container')

@section('content')
<small>Accounts</small> <br/>
<h1>Accounts</h1>
<h5 class="subheader">
  Accounts are companies or individuals who can build their own contact list through email chains.
</h5>
<p><a class="button" data-open="createAccountModal"><span class="fa fa-plus fa-6"></span> Create Account</a></p>

<div class="reveal" id="createAccountModal" data-reveal>
  <h1>New Account</h1>
  <form class="" action="{{route('account.store')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="small-6 columns">
      First Name:
      <input type="text" name="first_name" required>
      Last Name:
      <input type="text" name="last_name" required>
      Company Name:
      <input type="text" name="company_name" required>
    </div>
    <div class="small-6 columns">
      <input type="file" name="logo" value="">
    </div>
    <div class="">

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
<table class="hover">
  <thead>
    <tr>
      <th width="200">Name</th>

      <th width="150">Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach($accounts as $account)
    <tr>
      <td>
        <a href="{{route('account.show',$account->id)}}">{{$account->name()}}</a>
      </td>
      <td>
        {{$account->email}}
      </td>
    </tr>

    @endforeach
  </tbody>
</table>

@stop
