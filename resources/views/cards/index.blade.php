@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item active">cards</li>
    </ol>
    <add-card v-on:card-added="cardAdded"></add-card>
    </br>
    <card-view ref="cardView"></card-view>
</div>
@endsection
