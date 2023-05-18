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
            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="card-title">Create User</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" role="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
                                    <label for="Name">Name</label>
                                    <input name="Name" type="text" id="Name" class="form-control" value="{{ old('Name') }}" required autofocus placeholder="Enter Name">
                                    @if ($errors->has('Name'))
                                    <span class="help-block"><strong>{{ $errors->first('Name') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('UserId') ? 'has-error' : '' }}">
                                    <label for="UserId">User Id</label>
                                    <input name="UserId" type="text" id="UserId" class="form-control" value="{{ old('UserId') }}" required autofocus placeholder="Enter UserId">
                                    @if ($errors->has('UserId'))
                                    <span class="help-block"><strong>{{ $errors->first('UserId') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Password') ? 'has-error' : '' }}">
                                    <label for="Password">Password</label>
                                    <input name="Password" type="text" id="Password" class="form-control" value="{{ old('Password') }}" required autofocus placeholder="Enter Password">
                                    @if ($errors->has('Password'))
                                    <span class="help-block"><strong>{{ $errors->first('Password') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('RoleId') ? 'has-error' : '' }}">
                                    <label for="RoleId">Role </label>
                                    <select name="RoleId" id="role_Id" onchange="roleChange()" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->Id}}" @if($role->Id == old("RoleId")){{"selected"}} @endif">{{$role->Name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('RoleId'))
                                    <span class="help-block"><strong>{{ $errors->first('RoleId') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6" id="spo_region" style="display: none;">
                                <div class="form-group{{ $errors->has('RegionId') ? 'has-error' : '' }}">
                                    <label for="RegionId">Region </label>
                                    <select name="RegionId" id="RegionId" data-live-search="true" class="form-control select2" style="width: 100%;" type="select">
                                        <option value="">Select Region</option>
                                        @foreach($regions as $region)
                                        <option value="{{$region->Id}}" @if($region->Id == old("RegionId")){{"selected"}} @endif">{{$region->Name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('RegionId'))
                                    <span class="help-block"><strong>{{ $errors->first('RegionId') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Designation') ? 'has-error' : '' }}">
                                    <label for="Designation">Designation</label>
                                    <input name="Designation" type="text" id="Designation" class="form-control" value="{{ old('Designation') }}" required autofocus placeholder="Enter Designation">
                                    @if ($errors->has('Designation'))
                                    <span class="help-block"><strong>{{ $errors->first('Designation') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Mobile') ? 'has-error' : '' }}">
                                    <label for="Mobile">Mobile</label>
                                    <input name="Mobile" type="number" id="Mobile" class="form-control" value="{{ old('Mobile') }}" required autofocus placeholder="Enter Mobile Number">
                                    @if ($errors->has('Mobile'))
                                    <span class="help-block"><strong>{{ $errors->first('Mobile') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Email') ? 'has-error' : '' }}">
                                    <label for="Email">Email</label>
                                    <input name="Email" type="email" id="Email" class="form-control" value="{{ old('Email') }}" required autofocus placeholder="Enter Email Address">
                                    @if ($errors->has('Email'))
                                    <span class="help-block"><strong>{{ $errors->first('Email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6" style="display: none;" id="signature_show">
                                <div class="form-group {{ $errors->has('SignatureImage') ? 'has-error' : '' }}">
                                    <label class="form-label" for="SignatureImage">Signature <span style="color: red;font-size: 10px;">(*Format: Jpg, png)</span></label>
                                    <input name="SignatureImage" type="file" id="SignatureImage" class="form-control" value="{{ old('SignatureImage') }}">
                                    @if ($errors->has('SignatureImage'))
                                    <span class="help-block"><strong>{{ $errors->first('SignatureImage') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info btn-flat">Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div> <!-- /.col-12 -->
    </div>
    <!--row end -->
</div><!-- /.container-fluid -->

@endsection

@section('scripts')
<script>
    document.title = 'User | Create';
</script>

<script>
    function roleChange() {
        var roleId = $('#role_Id :selected').val();
        console.log(roleId);
        if (roleId == 1) {
            $('#spo_region').show();
        } else {
            $('#spo_region').hide();
        }

        if (roleId == 3) {
            $('#signature_show').show();
        } else {
            $('#signature_show').hide();
        }
    }
</script>

@endsection