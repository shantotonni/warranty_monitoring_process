@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Parts</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Parts Edit</li>
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
                    <h4 class="card-title">Edit Parts</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" role="form" method="POST" action="{{ route('parts.update', $parts->Id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                         
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('PartsCode') ? 'has-error' : '' }}">
                                <label for="PartsCode">Parts Code</label>
                                <input name="PartsCode" type="text" id="PartsCode" class="form-control" value="{{ $parts->PartsCode }}" required autofocus placeholder="Enter Parts Code">
                                    @if ($errors->has('PartsCode'))
                                        <span class="help-block"><strong>{{ $errors->first('PartsCode') }}</strong></span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('PartsName') ? 'has-error' : '' }}">
                                <label for="PartsName">Parts Name</label>
                                <input name="PartsName" type="text" id="PartsName" class="form-control" value="{{ $parts->PartsName }}" required autofocus placeholder="Enter Parts Name">
                                    @if ($errors->has('PartsName'))
                                        <span class="help-block"><strong>{{ $errors->first('PartsName') }}</strong></span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('Price') ? 'has-error' : '' }}">
                                <label for="Price">Unit Price</label>
                                <input name="Price" type="text" id="Price" class="form-control" value="{{ $parts->Price }}" required autofocus placeholder="Enter Price">
                                    @if ($errors->has('Price'))
                                        <span class="help-block"><strong>{{ $errors->first('Price') }}</strong></span>
                                    @endif
                            </div>
                        </div>

                        </div>
                     <div class="card-footer d-flex justify-content-end">
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

<script>document.title = 'Parts | Edit';</script>
@endsection
