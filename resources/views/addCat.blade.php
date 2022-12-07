@extends('main');
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Category</h4>
          <form action="/addCat" class="forms-sample" method="post" enctype="multipart/form-data">
            @csrf
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
            <div class="form-group">
              <label for="exampleInputUsername1">Category Name</label>
              <input name="cat_name" type="text" class="form-control" id="exampleInputUsername1" >
            </div>

            <div class="form-group">
                <label>Select Category Image</label>
                <div class="image-wrapper">
                    <img class="img-thumbnail image-scopes" src="images/placeholder-image.webp" id="image-scope" />
                </div>
            </div>

            <div class="form-group">
                <input  name="cat_image" type="file" onchange="showPreview(event);">
            </div>

            <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
            <button class="btn btn-light">Cancel</button>
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