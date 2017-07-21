@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
      <li class="breadcrumb-item"><router-link to="/cards">Cards</router-link></li>
    </ol>
    <transition>
      <router-view></router-view>
    </transition>
</div>
@endsection
