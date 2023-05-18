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
                    <li class="breadcrumb-item active">User Change Password</li>
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
                    <h4 class="card-title">Change Password</h4>
                    @if(session()->has('success'))
                    <p class="alert alert-success">
                        {{ session()->get('success') }}
                    </p>
                    @endif
                    @if(session()->has('error'))
                    <p class="alert alert-danger">
                        {{ session()->get('error') }}
                    </p>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" role="form" method="POST" action="{{ route('store.change.password') }}">
                        {{ csrf_field() }}
                        <div class="row">


                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Password') ? 'has-error' : '' }}">
                                    <label for="Password">Current Password</label>
                                    <input name="Password" type="password" id="Password" class="form-control" value="{{ old('Password') }}" required autofocus placeholder="Enter Current Password">
                                    @if ($errors->has('Password'))
                                    <span class="help-block"><strong>{{ $errors->first('Password') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('NewPassword') ? 'has-error' : '' }}">
                                    <label for="NewPassword">New Password</label>
                                    <input name="NewPassword" type="password" id="NewPassword" class="form-control" value="{{ old('NewPassword') }}" required autofocus placeholder="Enter New Password">
                                    @if ($errors->has('NewPassword'))
                                    <span class="help-block"><strong>{{ $errors->first('NewPassword') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('ConfirmPassword') ? 'has-error' : '' }}">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input name="ConfirmPassword" type="password" id="ConfirmPassword" class="form-control" value="{{ old('ConfirmPassword') }}" required autofocus placeholder="Enter Confirm Password">
                                    @if ($errors->has('ConfirmPassword'))
                                    <span class="help-block"><strong>{{ $errors->first('ConfirmPassword') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-flat">Submit</button>

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
    document.title = 'User | Change Password';
</script>
@endsection