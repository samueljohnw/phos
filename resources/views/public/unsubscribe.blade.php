@extends('template.layouts.container')

@section('content')
<br/><br/>
@if (session('status'))
    <div class="text-center">
        {{ session('status') }}
    </div>
@else

<center>
<div class="small-5 small-centered columns callout" style="background:#e5e5e5">
  <h5>Are you sure you want to unsubscribe?</h5>
  <form class="" action="" method="post">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <button type="submit" class="tiny warning button">UNSUBSCRIBE</button>
  </form>
</div>
</center>

@endif
@stop
