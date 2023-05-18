@extends('admin.layouts.master')

@section('main-content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Role</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Role</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Role </h4>

              @if(session()->has('success'))
                <p class="alert alert-success">
                    {{ session()->get('success') }}
                </p>
              @endif

              <!-- <a href="{{url('/roles/create')}}"><button class="btn btn-sm btn-info float-right btn-flat">Create Role</button></a> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Updated At</th>
                    <th>Controls</th>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                      <tr>
                        <td>{{$role->Id}}</td>
                        <td>{{$role->Name}}</td>
                        <td>{{$role->UpdatedAt}}</td>

                          <td>
                              <!-- <a href="{{url('/roles/'.$role->Id)}}" title="Show" ><button type="button" class="btn btn-xs btn-primary btn-flat">Show</button></a> -->
                              <a href="{{url('/roles/'.$role->Id.'/edit')}}" title="Edit" ><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fas fa-edit"></i></button></a>
                              <!-- <a id="openDeleteModal" data-toggle="modal" data-id="{{$role->Id}}" title="Delete"  href=""><button type="button" class="btn btn-xs btn-danger btn-flat">Del</button></a> -->
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Updated At</th>
                    <th>Controls</th>
                </tr>
                </tfoot>
              </table>
              {{$roles->links()}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div> <!--row end -->
    </div><!-- /.container-fluid -->


<!-- Modal -->
<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Delete Item !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="delete_modal_form" role="form" method="POST" action="">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
      <div class="modal-body">
          <p class="text-center danger">Are Your Sure ? </p>
          <input id="delete_id" type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary float-left">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>document.title = 'Role';</script>
<script type="text/javascript">
$(document).on("click", "#openDeleteModal", function () {
     var delId = $(this).data("id");
     $("#delete_modal_form").attr("action", "{{url('/roles')}}/" + delId);
     $(".modal-body #delete_id").val( delId );
     $("#myModal").modal("show");
});
</script>

@endsection