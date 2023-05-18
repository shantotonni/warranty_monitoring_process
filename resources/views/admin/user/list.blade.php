@extends('admin.layouts.master')

@section('head')
<style>
    th:last-child{
        position: sticky;
        right: -10px;
        background-color: #fff;
    }
    td:last-child {
        position: sticky;
        right: -10px;
        background-color: #C8CFC9;
    }
</style>
@endsection

@section('main-content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Users </h4>
          @if(session()->has('success'))
          <p class="alert alert-success">
            {{ session()->get('success') }}
          </p>
          @endif
          <a href="{{url('/users/create')}}"><button class="btn btn-sm btn-info float-right btn-flat">Create User</button></a>
        </div>
        <div class="card-body">
          <table id="user_table" class="table table-bordered table-striped table-sm text-nowrap" style="display: block;overflow-x: auto;">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>UserId</th>
                  <th>Role</th>
                  <th>Designation</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Region</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Controls</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{$user->Id}}</td>
                <td>{{$user->Name}}</td>
                <td>{{$user->UserId}}</td>
                <td>{{isset($user->role) ? $user->role->Name: ''}}</td>
                <td>{{$user->Designation}}</td>
                <td>{{$user->Mobile}}</td>
                <td>{{$user->Email}}</td>
                <td>{{isset($user->region) ? $user->region->Name:''}}</td>
                <td>{{$user->Status}}</td>
                <td>{{$user->CreatedAt}}</td>
                <td>{{$user->UpdatedAt}}</td>
                <td>
                  <a href="{{url('/users/'.$user->Id)}}" title="Show"><button type="button" class="btn btn-xs btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i></button></a>
                  <a href="{{url('/users/'.$user->Id.'/edit')}}" title="Edit"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fas fa-edit"></i></button></a>
                  <a id="openDeleteModal" data-toggle="modal" data-id="{{$user->Id}}" title="Delete" href=""><button type="button" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i></button></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="float-right mt-3">
            {{-- <p>{{$users->links()}}</p> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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

@endsection

@section('scripts')
<script>
  document.title = 'User';
</script>
<script type="text/javascript">
  $(document).on("click", "#openDeleteModal", function() {
    var delId = $(this).data("id");
    $("#delete_modal_form").attr("action", "{{url('/users')}}/" + delId);
    $(".modal-body #delete_id").val(delId);
    $("#myModal").modal("show");
  });
</script>
<script>
    $(document).ready( function () {
        $('#user_table').DataTable();
    } );
</script>
@endsection
