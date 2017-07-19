@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home</li>
      <li class="breadcrumb-item"><a href="{{url('/cards')}}">Cards</a></li>
    </ol>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <example></example>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
