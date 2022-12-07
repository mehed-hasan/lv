@extends('main');
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Wallpaper</h4>
          <form class="forms-sample" method="post" action="/updateWp" enctype="multipart/form-data" >
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

          <input value={{$thisRow->id}} name="edit_id" type="hidden">

            <div class="form-group">
              <label for="exampleInputUsername1">Wallpaper Name</label>
              <input value="{{$thisRow ->wallpaper_name}}" name="wp_name" placeholder="Eg: Nature wallpaper" type="text" class="form-control" id="exampleInputUsername1" required>
            </div>

            <div class="form-group">
                <select name="wp_cat" class="form-select py-3" aria-label="Default select example " required>
                    <option disabled selected>Select Category</option>
                    @foreach ($wpCats as $item )
                        <option {{$thisRow ->wallpaper_cat == $item->cat_name ? "selected":"" }} value="{{$item->cat_name}}" >{{$item->cat_name}}</option>
                    @endforeach
                  </select>
              </div>
  
            <div class="form-group">
                <select name="wp_type" class="form-select py-3" aria-label="Default select example " required>
                    <option disabled selected>Select Type</option>
                        @foreach ($wpTypes as $item )
                        <option {{$thisRow ->wallpaper_type == $item->type ? "selected":"" }} value={{$item->type}} >{{$item->type}}</option>
                        @endforeach
                  </select>
              </div>
  

              
            <div class="form-group">
                <select name="wp_subscription" class="form-select py-3" aria-label="Default select example " required >
                    <option disabled selected>Select Subscription type </option>
                    <option {{$thisRow->wallpaper_subscription == "free" ? "selected" : "" }} value="free">Free</option>
                    <option {{$thisRow->wallpaper_subscription == "premium" ? "selected" : "" }} value="premium">Premium</option>
                  </select>
              </div>


            <div class="form-group">
                <label>Select Thumbnail Image <span class="text-danger">*</span></label>
                <div class="image-wrapper">
                    <img class="img-thumbnail image-scopes" src={{asset("uploads/thumbnails/".$thisRow->wallpaper_thumb)}} id="image-scope" />
                </div>

                <div class="form-group">
                    <input name="wp_thumb" type="file" onchange="showPreview(event);" >
                </div>
            </div>


            <div class="form-group">
                <label>Select Original Image <span class="text-danger">*</span></label>
                <div class="image-wrapper">
                    <img class="img-thumbnail image-scopes" src={{asset("uploads/wallpapers/".$thisRow->wallpaper_image)}} id="image-scope2" />
                </div>

                <div class="form-group">
                    <input name="wp_img" type="file" onchange="showPreview2(event);" >
                </div>
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
      function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("image-scope2");
    preview.src = src;
    preview.style.display = "block";
  }
}
  </script>
@endsection