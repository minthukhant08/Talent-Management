<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Talent Management') }}</title>
        <link href="{{url('css/app.css')}}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <body>
      <div id="app">
        <app-view></app-view>
      </div>
      <script src="{{ asset('js/user/app.js') }}"></script>
   </body>
   <script src="/dist/vue-social-sharing.min.js"></script>
</html>
