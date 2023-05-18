@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Area</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">User Area Edit</li>
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
                    <h4 class="card-title">Edit Engineer Area Mapping</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" role="form" method="POST" action="{{ route('user-areas.update', $userArea->Id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('UserId') ? 'has-error' : '' }}">
                                    <label for="UserId">Select Engineer</label>
                                    <select name="UserId" data-live-search="true" class="form-control select2" style="width: 100%;" type="select" required>
                                        <option value="">Select Engineer</option>
                                        @foreach($engineers as $engineer)
                                        <option value="{{$engineer->Id}}" @if($engineer->Id==$userArea->UserId) {{"selected"}} @endif>{{$engineer->Name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('UserId'))
                                    <span class="help-block"><strong>{{ $errors->first('UserId') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('RegionId') ? 'has-error' : '' }}">
                                    <label for="RegionId">Select Region</label>
                                    <select name="RegionId"  onChange="getAreas(this.value);" data-live-search="true" class="form-control select2" style="width: 100%;" type="select" required>
                                        <option value="">Select Region</option>
                                        @foreach($regions as $region)
                                        <option value="{{$region->Id}}" @if($region->Id==$userArea->RegionId){{"selected"}}@endif>{{$region->Name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('RegionId'))
                                    <span class="help-block"><strong>{{ $errors->first('RegionId') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('AreaId') ? 'has-error' : '' }}">
                                    <label for="AreaId">Select Area</label>
                                    <select name="AreaId" data-live-search="true" class="form-control select2" style="width: 100%;" type="select" required>
                                        
                                        {{-- @foreach($areas as $area)
                                        <option value="{{$area->Id}}" @if($area->Id==$userArea->AreaId) {{"selected"}} @endif>{{$area->Name}}</option>
                                        @endforeach --}}
                                    </select>
                                    @if ($errors->has('AreaId'))
                                    <span class="help-block"><strong>{{ $errors->first('AreaId') }}</strong></span>
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
    </div>
    <!--row end -->
</div><!-- /.container-fluid -->

<script>
    document.title = 'User-Area | Edit';
</script>
@endsection

@section('scripts')
<script>
    function getAreas(val) {
        $.ajax({
            type: "GET",
            url: window.location.origin+"/warranty_monitoring_process/user-area/get-areas-by-region",
            dataType: "json",
            data:{
                'region_id' : val
            },
            success: function(data){
                console.log(data);
                $('select[name="AreaId"]').empty();
                    $.each(data, function(key, value) {
                    $('select[name="AreaId"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }
</script>
@endsection