@extends('main');
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Type</h4>
          @if(Session::has('message'))
          <p class="alert alert-info">{{ Session::get('message') }}</p>
         @endif

         @if ($errors->any())
         @foreach ($errors->all() as $error)
         <ul >
           <p class="alert alert-danger">{{$error}}</p>
         </ul>
         @endforeach
         @endif
          <form action="/addType" method="post" class="forms-sample">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Type Name</label>
              <input name="type" placeholder="Eg: Dark/ Light" type="text" class="form-control" id="exampleInputUsername1" >
            </div>


            <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection