@extends('template.layouts.container')

@section('content')
<small><a href="{{route('account.index')}}">Accounts</a> &rsaquo;&rsaquo;<a href="{{route('account.show',$account->id)}}"> {{$account->name()}}</a> &rsaquo;&rsaquo; Chains</small><br/>

<h1>Chains</h1>
<h5 class="subheader">Email chains are emails that contain forms. When a form is filled out the email chain is triggered and the chain's messages are sent to that form's email address.</h5>
<p><a class="button" data-open="createChainModal"><span class="fa fa-chain fa-6"></span> Create Chain</a></p>

<div class="reveal" id="createChainModal" data-reveal>
  <h1>Create New Chain</h1>
  <form class="" action="{{route('account.{account_id}.chain.store',$account->id)}}" method="post">
    {{csrf_field()}}
    Chain Name:
    <input type="text" name="name" >
    Redirect URL:
    <input type="url" name="redirect" >
    <button type="submit" class="button">Create Chain</button>
  </form>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<hr>
<table class="hover">
  <thead>
    <tr>
      <th width="200">Chain Name</th>
      <th>Total Contacts</th>
    </tr>
  </thead>
  <tbody>
    @foreach($chains as $chain)

    <tr>
      <td>
          <a href="/account/{{$account->id}}/chain/{{$chain->id}}">{{$chain->name}}</a><br/>
      </td>
      <td>
        {{$chain->contacts()->groupBy('contact_id')->get()->count()}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop
