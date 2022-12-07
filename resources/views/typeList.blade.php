@extends('main')
@section('content')


<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h6>Type <b class="targeted_name text-success">...</b> will be deleted. </h6>
        <p class="alert alert-warning"> All wallpaper with <b class="targeted_name text-success">...</b> type will be deleted ! </p>

      </div>
      <div class="modal-footer">
        <button  class="btn btn-warning btn-sm text-white" data-bs-dismiss="modal">Cancel</button>

        <form action="/delType" method="post">
          @csrf
          <input name="action" id="actionabale" value="" type="hidden" />
          <button type="submit"  class="btn btn-danger btn-sm text-white">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Category List</h4>
        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
      @endif
        <div class="table-responsive">
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>
                   Type Name
                  </th>


                <th>
                  Created at
                </th>
                <th>
                  Updated at
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>

              @foreach ($typeLists as $item)
              <tr>

                <td>
                  {{$item->type}}
                </td>

                <td>
                 {{date('d M Y', strtotime($item->created_at));}}
                </td>
                <td>
                  
                  {{$item->updated_at === null ? "Not Updated Yet" : date('d M Y', strtotime($item->updated_at))}}
                 </td>

                <td>
                  <a href="/editType/{{$item->id}}" class="btn btn-warning btn-sm text-white py-2">Edit</a>
                  ||
                  <a  data-name ="{{$item->type}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm text-white py-2 del_btn"   data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a>
                </td>
            </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('custom_script')
<script>
   $(".del_btn").click(function(){
      $dataName = $(this).attr("data-name");
      $dataId = $(this).attr("data-id");
      $(".targeted_name").text($dataName);
      $("#actionabale").val($dataId);
    });
</script>
@endsection