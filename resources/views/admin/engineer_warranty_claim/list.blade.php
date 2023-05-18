@extends('admin.layouts.master')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <!-- <h1 class="m-0 text-dark">Warranty Claim Info (Engineer)</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Warranty Claim Info (Engineer)</li>
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
              <h4 class="card-title">Warranty Claim Info (Engineer) </h4>
              @if(session()->has('success'))
                <p class="alert alert-success">
                    {{ session()->get('success') }}
                </p>
              @endif
              <!-- <a href="{{url('/engineer-warranty-claims/create')}}"><button class="btn btn-sm btn-info float-right btn-flat">Create Warranty Claim Info</button></a> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm small text-nowrap">
                <thead>
                    <th>SL</th>
                    <th>Product</th>
                    <th>SPO</th>
                    <th>Delivery Date</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Customer Number</th>
                    <th>Chassis Number</th>
                    <th>Parts Number</th>
                    <th>Parts Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>

                      <th>Controls</th>
                </thead>
                <tbody>
                    @foreach ($warrantyClaims as $warrantyClaim)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$warrantyClaim->product->Name}}</td>
                        <td>{{$warrantyClaim->spo->Name}}</td>
                        <td>{{ $warrantyClaim->DeliveryDate }}</td>
                        <td>{{ $warrantyClaim->CustomerCode }}</td>
                        <td>{{ $warrantyClaim->CustomerName }}</td>
                        <td>{{ $warrantyClaim->CustomerNumber }}</td>
                        <td>{{ $warrantyClaim->ChassisNumber }}</td>
                        <td>
                          @foreach($warrantyClaim->parts as $part)
                            {{ $part->PartsNumber }}
                            @php echo "<br/>" @endphp
                          @endforeach
                        </td>
                        <td>
                          @foreach($warrantyClaim->parts as $part)
                            {{ $part->PartsName }}
                            @php echo "<br/>" @endphp
                          @endforeach
                        </td>
                        <td>
                          @foreach($warrantyClaim->parts as $part)
                            {{ $part->Quantity }}
                            @php echo "<br/>" @endphp
                          @endforeach
                        </td>
                        <td>
                          @foreach($warrantyClaim->parts as $part)
                            {{ $part->Price }}
                            @php echo "<br/>" @endphp
                          @endforeach
                        </td>
                        <td>{{ $warrantyClaim->Status }}</td>

                          <td>
                              <a href="{{url('/engineer-warranty-claims/'.$warrantyClaim->Id)}}" title="Show" ><button type="button" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i>
</button></a>
                              <a href="{{url('/engineer-warranty-claims/'.$warrantyClaim->Id.'/edit')}}" title="Edit" ><button type="button" class="btn btn-sm btn-info btn-flat"><i class="fas fa-edit"></i></button></a>
                              <!-- <a id="openDeleteModal" data-toggle="modal" data-id="{{$warrantyClaim->Id}}" title="Delete"  href=""><button type="button" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i> -->
<!-- </button></a> -->
                          @if($warrantyClaim->Status == "Approved")
                            <form action="{{url('/admin/download-approval')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$warrantyClaim->Id}}" name="downloadId">
                                <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
                            </form>
                          @endif
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Product</th>
                    <th>SPO</th>
                    <th>Delivery Date</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Customer Number</th>
                    <th>Chassis Number</th>
                    <th>Parts Number</th>
                    <th>Parts Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>

                    <th>Controls</th>
                </tr>
                </tfoot>
              </table>

              <div class="d-flex justify-content-end">{{$warrantyClaims->links()}}</div>
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

@endsection

@section('scripts')
<script>document.title = 'Warranty Claim Info';</script>
<script type="text/javascript">
$(document).on("click", "#openDeleteModal", function () {
     var delId = $(this).data("id");
     $("#delete_modal_form").attr("action", "{{url('/engineer-warranty-claims')}}/" + delId);
     $(".modal-body #delete_id").val( delId );
     $("#myModal").modal("show");
});
</script>
@endsection