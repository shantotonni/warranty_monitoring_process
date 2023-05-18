@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">User Create</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">User Show</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Id</strong></div>
                   <div class="col-md-8"><p>{{$user->Id}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Name</strong></div>
                   <div class="col-md-8"><p>{{$user->Name}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>User Id</strong></div>
                   <div class="col-md-8"><p>{{$user->UserId}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Role</strong></div>
                   <div class="col-md-8"><p>{{$user->role->Name}}</p></div>
                </div>

                <div class="col-md-6">
                   <div class="col-md-4"><strong>Designation</strong></div>
                   <div class="col-md-8"><p>{{$user->Designation}}</p></div>
                </div>

                <div class="col-md-6">
                   <div class="col-md-4"><strong>Mobile</strong></div>
                   <div class="col-md-8"><p>{{$user->Mobile}}</p></div>
                </div>

                <div class="col-md-6">
                   <div class="col-md-4"><strong>Email</strong></div>
                   <div class="col-md-8"><p>{{$user->Email}}</p></div>
                </div>

                <div class="col-md-6">
                   <div class="col-md-4"><strong>Status</strong></div>
                   <div class="col-md-8"><p>{{$user->Status}}</p></div>
                </div>

                @if($user->RoleId == 3)
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Signature</strong></div>
                   <div class="col-md-8"><img src="{{asset('images/signature_images/'.$user->SignatureImage)}}" height="100" width="220" alt="sign"></div>
                </div>
               @endif

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div> <!--row end -->
    </div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>document.title = 'User | Show';</script>
@endsection
