@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/cards')}}">cards</a></li>
      <li class="breadcrumb-item active">{{$card->title}}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <label for="query-input" class="col-1 col-form-label"><b></b></label>
            <div class="col-12">
              <textarea name="query" class="form-control alert alert-warning" type="text" value="" rows="4" cols="80" id="query-input">{{$card->query}}</textarea>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
       <table class="table table-sm ">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
</div>
@endsection
