@extends('admin.layouts.master')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Main Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="container-fluid">
  <div class="page-title-box">
    <div class="row align-items-center">
      <div class="col-sm-12">
        <h5 class="page-title" style="background-color: #5b626b;color:white;padding: 1px;">Dashboard</h5>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Welcome to Warranty Monitoring Process Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- end row -->
  @php
    $pending = 0; $submitted = 0; $approved = 0;
    $goodPending = 0; $goodSubmitted = 0; $goodApproved = 0;

    foreach($data as $d){
      if($d->Status=="Pending" && $d->Purpose=="Warranty"){
        $pending+=1;
      }
      if($d->Status=="Submitted" && $d->Purpose=="Warranty"){
        $submitted+=1;
      }
      if($d->Status=="Approved" && $d->Purpose=="Warranty"){
        $approved+=1;
      }
    }
    
    foreach($data as $d){
      if($d->Status=="Pending" && $d->Purpose=="Goodwill"){
        $goodPending+=1;
      }
      if($d->Status=="Submitted" && $d->Purpose=="Goodwill"){
        $goodSubmitted+=1;
      }
      if($d->Status=="Approved" && $d->Purpose=="Goodwill"){
        $goodApproved+=1;
      }
    }
  @endphp
  <div class="row">
    <div class="col-sm-9">
        <h5 style="background-color: #02a499;color:white;padding: 5px;border-radius: 5px;">Warranty Status</h5>
    </div>
  </div>
  <div class="row">
  <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/02.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Pending</h5>
            <h4 class="font-500">{{$pending}} <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
            <div class="mini-stat-label bg-danger">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/01.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Submitted</h5>
            <h4 class="font-500">{{$submitted}} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
            <div class="mini-stat-label bg-success">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/03.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Approved</h5>
            <h4 class="font-500">{{$approved}} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
            <div class="mini-stat-label bg-info">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->

  <div class="row">
    <div class="col-sm-9">
        <h5 style="background-color: #02a499;color:white;padding: 5px;border-radius: 5px;">Goodwill Status</h5>
    </div>
  </div>
  <div class="row">
  <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/02.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Pending</h5>
            <h4 class="font-500">{{$goodPending}} <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
            <div class="mini-stat-label bg-danger">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/01.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Submitted</h5>
            <h4 class="font-500">{{$goodSubmitted}} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
            <div class="mini-stat-label bg-success">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card mini-stat bg-primary text-white">
        <div class="card-body">
          <div class="mb-4">
            <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/03.png" alt="" /></div>
            <h5 class="font-16 text-uppercase mt-0 text-white-50">Approved</h5>
            <h4 class="font-500">{{$goodApproved}} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
            <div class="mini-stat-label bg-info">
              <p class="mb-0">Status</p>
            </div>
          </div>
          <div class="pt-2">
            <div class="float-right">
              <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
</div>
<!-- container-fluid -->

@endsection