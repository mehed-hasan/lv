@extends('main')
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Category</h4>
            @csrf

            @if ($errors->any())
              @foreach ($errors->all() as $error)
              <ul >
                <p class="alert alert-danger">{{$error}}</p>
              </ul>
              @endforeach
          @endif

          <form action="/updateType" method="post" enctype="multipart/form-data" >
            @csrf
            <input value={{$thisRow->id}} name="edit_id" type="hidden">

            <div class="form-group">
              <label for="exampleInputUsername1">Category Name</label>
              <input value={{$thisRow->type}} name="type" type="text" class="form-control" id="exampleInputUsername1" >
            </div>


              <button type="submit" class="btn btn-primary text-white">Save</button>

            </form>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection