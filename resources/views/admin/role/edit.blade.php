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
            <li class="breadcrumb-item active">Role Edit</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Role</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" role="form" method="POST" action="{{ route('roles.update',$role->Id ) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                <div class="row">
                             
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
                                <label for="Name">Name</label>
                                <input name="Name" type="text" id="Name" class="form-control"   value="{{$role->Name}}"    autofocus max="191"  required  placeholder="Name"     >
                                @if ($errors->has('Name'))
                                    <span class="help-block"><strong>{{ $errors->first('Name') }}</strong></span>
                                @endif
                            </div>
                        </div>
                </div>

                     <div class="card-footer">
                       <button type="submit" class="btn btn-info btn-flat">Update</button>
                     </div>
                   </form>
                  </div>
                 <!-- /.card-body -->
                 </div>
                 <!-- /.card -->

            </div> <!-- /.col-12 -->
      </div> <!--row end -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<script>document.title = 'Role | Edit';</script>
@endsection
