@extends('admin.layouts.master');

@section('content')
<div class="container">
  <h1>Hello Admin {{ auth()->user()->name }}</h1><hr>
<p>Hello P</p>
</div>

@endsection