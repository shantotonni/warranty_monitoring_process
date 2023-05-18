@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Warranty Claim Info (SPO)</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Warranty Claim Info (SPO) Show</li>
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
              <h4 class="card-title">Warranty Claim Info (SPO) Show</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Id</strong></div>
                   <div class="col-md-8"><p>{{$warranty->Id}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Product</strong></div>
                   <div class="col-md-8"><p>{{$warranty->product->Name}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Engineer</strong></div>
                   <div class="col-md-8"><p>{{$warranty->engineer->Name}}</p></div>
                </div>
                
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Delivery Date</strong></div>
                   <div class="col-md-8"><p>{{$warranty->DeliveryDate}}</p></div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Customer Code</strong></div>
                   <div class="col-md-8"><p>{{$warranty->CustomerCode}}</p></div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Customer Name</strong></div>
                   <div class="col-md-8"><p>{{$warranty->CustomerName}}</p></div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Customer Number</strong></div>
                   <div class="col-md-8"><p>{{$warranty->CustomerNumber}}</p></div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Chassis Number</strong></div>
                   <div class="col-md-8"><p>{{$warranty->ChassisNumber}}</p></div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-4"><strong>Status</strong></div>
                   <div class="col-md-8"><p>{{$warranty->Status}}</p></div>
                </div>
                <div class="col-md-12">
                   <div class="col-md-4"><strong>Parts Details</strong></div>
                   <div class="col-md-8">
                     <table class="table table-bordered table-small small">
                       <tbody>
                            <tr>
                              <th>Parts Number</th>
                              <th>Parts Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                            </tr>
                          @foreach($warranty->parts as $part)
                            <tr>
                              <td>{{ $part->PartsNumber }}</td>
                              <td>{{ $part->PartsName }}</td>
                              <td>{{ $part->Quantity }}</td>
                              <td> {{ $part->Price }}</td>
                            </tr>
                          @endforeach
                       </tbody>
                     </table>
                   </div>
                </div>

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
<script>document.title = 'Product | Show';</script>
@endsection
