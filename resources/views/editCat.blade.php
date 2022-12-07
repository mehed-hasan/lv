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

          <form action="/updateCat" method="post" enctype="multipart/form-data" >
            @csrf
            <input value={{$thisRow->id}} name="edit_id" type="hidden">

            <div class="form-group">
              <label for="exampleInputUsername1">Category Name</label>
              <input value="{{$thisRow->cat_name}}" name="cat_name" type="text" class="form-control" id="exampleInputUsername1" >
            </div>

            <div class="form-group">
                <label>Select Category Image</label>
                <div class="image-wrapper">
                    <img class="img-thumbnail image-scopes" src="../../uploads/cats/{{$thisRow->cat_image}}" id="image-scope" />
                </div>
            </div>

            <div class="form-group">
                <input value={{$thisRow->cat_image}}  name="cat_image" type="file" onchange="showPreview(event);">
            </div>

              <button type="submit" class="btn btn-primary text-white">Save</button>

            </form>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
      function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("image-scope");
    preview.src = src;
    preview.style.display = "block";
  }
}
  </script>
@endsection