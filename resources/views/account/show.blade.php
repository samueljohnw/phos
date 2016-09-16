@extends('template.layouts.container')
@section('content')
<small><a href="{{route('account.index')}}">Accounts</a> &rsaquo;&rsaquo; {{$account->name()}}</small> <br/>

<h1>{{$account->name()}}</h1>
<div class="row">
  <div class="small-12 columns sub-menu">
    <a href="{{route('account.{account_id}.contact.index',$account->id)}}">Contacts</a> <span class="badge">{{$account->contacts->count()}}</span> |
    <a href="{{route('account.{account_id}.chain.index',$account->id)}}">Email Chains</a> <span class="badge">{{$account->chains->count()}}</span>
    <span  class="float-right">
      <a data-open="profileModal">Profile</a> |
      <a href="{{route('account.{account_id}.settings',$account->id)}}">Settings</a>
    </span>
  </div>
</div>
<br/>

<h1>Contacts</h1>
<h5 class="subheader">This is your accrual of contacts over the past 30 days.</h5>
<canvas id="accountChart" style="width:100%;"></canvas>


<div class="reveal" id="profileModal" data-reveal>
  <img src="{{$account->logo}}" alt="" />
  <form action="{{route('account.update',$account->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="row">
      <label for="LogoUpload" class="tiny float-right button">Upload Logo</label>
      <input type="file" id="LogoUpload" class="show-for-sr" name="logo">
    </div>
    <div class="row">
      <div class="small-6 columns">
      First Name:<br/>
      <input type="text" name="first_name" value="{{$account->first_name}}">
      </div>
      <div class="small-6 columns">
      Last Name:<br/>
      <input type="text" name="last_name" value="{{$account->last_name}}">
      </div>
    </div>
    Company Name:<br/>
    <input type="text" name="company_name" value="{{$account->company_name}}">
    Email:<br/>
    <input type="text" name="email" value="{{$account->email}}">
    <button type="submit" class="float-left small button">Update</button>
  </form>
  <div class="switch tiny float-right">
    <input class="switch-input" id="active" type="checkbox" name="activeSwitch" value="{{$account->active}}"  {{($account->active == 1) ? 'checked': '' }} >
    <label class="switch-paddle" for="active">
      <span class="show-for-sr">Active User</span>
      <span class="switch-active" aria-hidden="true">On</span>
      <span class="switch-inactive" aria-hidden="true">Off</span>
    </label>
  </div>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


@stop
@section('footer-scripts')



<script src="/js/Chart.min.js" charset="utf-8"></script>
<script type="text/javascript">
var data =
{
  labels: [@foreach($chartDataByDay as $chartData => $labels) "{{Carbon\Carbon::parse($chartData)->format('F dS')}}",  @endforeach],
  datasets:
  [
    {
      data:
      [
        @foreach($chartDataByDay as $chartData => $labels){{$labels}}, @endforeach
      ],
  }
  ]
};
var context  = document.querySelector('#accountChart').getContext('2d');
new Chart(context).Line(data);

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
  $.post( "{{route('user.update',$account->id)}}",
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
