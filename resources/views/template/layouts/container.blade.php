<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
    <title>Phos Email Automation | Light Up Your Network</title>
    <link href="{{elixir('css/app.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"rel="stylesheet">      
  </head>
  <body class="{{str_replace('.','-',$viewName)}}">

    @include('template.blocks.header')

    <div class="column row">
        @yield('content')
    </div>
    <script src="{{elixir('js/all.js')}}"></script>
    @yield('footer-scripts')
  </body>
</html>
