@extends('layouts.login')
@section('mensaje')
@if (Session::has('message-error'))
<div class="alert alert-danger alert-dismissible" role="alert">
  {{Session::get('message-error')}}
</div>
@endif
@stop