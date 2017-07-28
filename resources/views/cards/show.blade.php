@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/cards')}}">Cards</a></li>
      <li class="breadcrumb-item active">{{$card->title}}</li>
    </ol>
    <card-show :card="{{$card}}" v-on:navigate-to-list="navigateToCardslist"></card-show>
</div>
@endsection
