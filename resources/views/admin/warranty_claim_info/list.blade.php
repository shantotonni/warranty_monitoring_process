@extends('admin.layouts.master')

@section('head')
<style>
    th:last-child {
        position: sticky;
        right: -25px;
        background-color: #5B627E;
    }

    td:last-child {
        position: sticky;
        right: -25px;
        background-color: #C8CFC9;
    }
</style>
@endsection

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Warranty Claim Info</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Warranty Claim Info</li>
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
                    <h4 class="card-title">Warranty Claim Info </h4>
                    @if (session()->has('success'))
                    <p class="alert alert-success">
                        {{ session()->get('success') }}
                    </p>
                    @endif
                    @if (Auth::user()->RoleId == 1)
                    <a href="{{ url('/claim-warranty/create') }}">
                        <button class="btn btn-sm btn-info float-right btn-flat">Create Warranty Claim Info
                        </button>
                    </a>
                    @endif

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div>
                        <p><strong  class="text-muted">Status Colors : </strong><span class="badge badge-pill badge-primary" style="background-color: #ff9999;">Pending</span>
                            <span class="badge badge-pill badge-primary" style="background-color: #D7DF23;">Submitted</span>
                            <span class="badge badge-pill badge-primary" style="background-color: #50D20B;">Approved</span>
                            <span class="badge badge-pill badge-primary" style="background-color: #3FC6EE;">Asking Parts</span>
                        </p>
                    </div>

                    <!-- Search Forms -->
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{route('search.warranty.claim.info.by.status')}}" method="GET">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group{{ $errors->has('Status') ? 'has-error' : '' }}">
                                            <label for="Status">Search by Status</label>
                                            <select name="Status" data-live-search="true" class="form-control select2" style="width: 100%;" type="select">
                                                <option value="">Select a Status</option>
                                                <option value="Pending" @if($inputs['Status']=="Pending" ){{'selected'}}@endif>Pending</option>
                                                <option value="Submitted" @if($inputs['Status']=="Submitted" ){{'selected'}}@endif>Submitted</option>
                                                <option value="Approved" @if($inputs['Status']=="Approved" ){{'selected'}}@endif>Approved</option>
                                            </select>
                                            @if ($errors->has('Status'))
                                            <span class="help-block"><strong>{{ $errors->first('Status') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group{{ $errors->has('ProductId') ? 'has-error' : '' }}">
                                            <label for="ProductId">Search by Product</label>
                                            <select name="ProductId" data-live-search="true" class="form-control select2" style="width: 100%;" type="select">
                                                <option value="">Select a Product</option>
                                                <option value="1" @if($inputs['ProductId']=="1" ){{'selected'}}@endif>Tractor</option>
                                                <option value="2" @if($inputs['ProductId']=="2" ){{'selected'}}@endif>Harvester</option>
                                                <option value="4" @if($inputs['ProductId']=="4" ){{'selected'}}@endif>Harvester (Lovol)</option>
                                            </select>
                                            @if ($errors->has('ProductId'))
                                            <span class="help-block"><strong>{{ $errors->first('ProductId') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-info" style="margin-top: 30px;">Search</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <form action="{{route('search.warranty.claim.info.by.chassis.no')}}" method="GET">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group{{ $errors->has('ChassisNo') ? 'has-error' : '' }}">
                                            <label for="ChassisNo">Search Chassis No.</label>
                                            <input name="ChassisNo" type="text" class="form-control" value="{{$inputs['ChassisNo']}}" required placeholder="Enter Chassis No....">
                                            @if ($errors->has('ChassisNo'))
                                            <span class="help-block"><strong>{{ $errors->first('ChassisNo') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-warning" style="margin-top: 30px;">Search</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Export form -->
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{route('export.warranty.claim.info.table')}}" id="export_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group {{ $errors->has('date_from') ? 'has-error' : '' }}">
                                            <label for="date_from">Date From</label>
                                            <input name="date_from" type="text" id="date_from" class="form-control" value="" required autocomplete="off" placeholder="Enter Date From">
                                            @if ($errors->has('date_from'))
                                            <span class="help-block"><strong>{{ $errors->first('date_from') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group {{ $errors->has('date_to') ? 'has-error' : '' }}">
                                            <label for="date_to">Date To</label>
                                            <input name="date_to" type="text" id="date_to" class="form-control" value="" required autocomplete="off" placeholder="Enter Date To">
                                            @if ($errors->has('date_to'))
                                            <span class="help-block"><strong>{{ $errors->first('date_to') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success" id="export_btn" style="margin-top: 30px;">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <table id="table_id" class="table table-bordered table-striped table-sm small text-nowrap display" style="width:100%">
                        <thead style="background-color: #5B627E;color:white;">
                            <th>SL</th>
                            <th>Product</th>
                            @if (Auth::user()->RoleId == 2)
                            <th>Warranty Number</th>
                            @endif
                            <th>Engineer</th>
                            <th>SPO</th>
                            <th>Purpose</th>
                            <th>Created At</th>
                            <th>Customer Code</th>
                            <th>Customer Name</th>
                            <th>Customer Number</th>
                            <th>Chassis Number</th>
                            <th>Parts Code</th>
                            <th>Parts Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            @if (Auth::user()->RoleId == 2)
                            <th>Download All Documents</th>
                            @endif
                            <th>Status</th>
                            @if (Auth::user()->RoleId == 2)
                            <th>Is Warranty Claim Done</th>
                            @endif
                            @if (Auth::user()->RoleId == 1)
                            <th>Is Invoice Done</th>
                            @endif
                            <th>Controls</th>
                        </thead>
                        <tbody>
                            @foreach ($warrantyClaims as $warrantyClaim)
                            <tr id="row_{{$warrantyClaim->Id}}" @if($warrantyClaim->Status == 'Pending') style="background-color: #ff9999;" @elseif($warrantyClaim->Status == 'Approved' && $warrantyClaim->AskingParts == 1) style="background-color: #3FC6EE;" @elseif($warrantyClaim->Status == 'Submitted') style="background-color: #fff5cc;" @elseif($warrantyClaim->Status == 'Approved') style="background-color: #bbff99;" @endif>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $warrantyClaim->product->Name }}</td>
                                @if (Auth::user()->RoleId == 2)
                                <td>@if($warrantyClaim->product->Id==2 || $warrantyClaim->product->Id==4) HAR/WRT/{{ $warrantyClaim->Id }} @endif </td>
                                @endif
                                <td>{{ $warrantyClaim->engineer['Name'] }}</td>
                                <td>{{ $warrantyClaim->spo->Name }}</td>
                                <td>{{ $warrantyClaim->Purpose }}</td>
                                <td>{{ date("d-M-Y", strtotime($warrantyClaim->CreatedAt)) }}</td>
                                <td>{{ $warrantyClaim->CustomerCode }}</td>
                                <td>{{ $warrantyClaim->CustomerName }}</td>
                                <td>{{ $warrantyClaim->CustomerNumber }}</td>
                                <td>{{ $warrantyClaim->ChassisNumber }}</td>
                                <td>
                                    @foreach ($warrantyClaim->parts as $part)
                                    {{ $part->PartsNumber }}
                                    @php echo "<br />" @endphp
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($warrantyClaim->parts as $part)
                                    {{ $part->PartsName }}
                                    @php echo "<br />" @endphp
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($warrantyClaim->parts as $part)
                                    {{ $part->Quantity }}
                                    @php echo "<br />" @endphp
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($warrantyClaim->parts as $part)
                                    {{ $part->Price }}
                                    @php echo "<br />" @endphp
                                    @endforeach
                                </td>

                                @if (Auth::user()->RoleId == 2)
                                <td>
                                    @if ($warrantyClaim->Status == 'Submitted' || $warrantyClaim->Status == 'Approved')
                                    <form action="{{ url('/admin/download-engineer-files') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $warrantyClaim->Id }}" name="warranty_claim_id">
                                        <button type="submit" class="btn btn-sm btn-secondary btn-flat"><i class="fa fa-paperclip" aria-hidden="true"></i>Download All
                                            Files</button>
                                    </form>
                                    @endif
                                </td>
                                @endif

                                @if (Auth::user()->RoleId == 1)
                                <td>
                                    @if (!empty($warrantyClaim->AdditionalInfo) && $warrantyClaim->Status != 'Approved')
                                    <span style="color: red;font-weight: 600;">{{ $warrantyClaim->Status }}</span>
                                    @else
                                    {{ $warrantyClaim->Status }}
                                    @endif
                                    @if ($warrantyClaim->Status == 'Approved')
                                    <form action="{{ url('/admin/download-approval') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $warrantyClaim->Id }}" name="downloadId">
                                        <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-paperclip" aria-hidden="true"></i> Download
                                            Approval
                                        </button>
                                    </form>
                                    @endif
                                </td>
                                @endif

                                @if (Auth::user()->RoleId == 3)
                                <td>
                                    @if (!empty($warrantyClaim->AdditionalInfo) && $warrantyClaim->Status != 'Approved')
                                    <span style="color: red;font-weight: 600;">{{ $warrantyClaim->Status }}</span>
                                    @else
                                    {{ $warrantyClaim->Status }}
                                    @endif
                                    @if ($warrantyClaim->Status == 'Approved')
                                    <form action="{{ url('/admin/download-approval') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $warrantyClaim->Id }}" name="downloadId">
                                        <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-paperclip" aria-hidden="true"></i> Download
                                            Approval
                                        </button>
                                    </form>
                                    @endif

                                </td>
                                @endif



                                @if (Auth::user()->RoleId == 2)
                                @if ($warrantyClaim->Status == 'Submitted')
                                @php $myId = $warrantyClaim->Id; @endphp
                                <td>
                                    <button type="button" onclick="openModal({{ $myId }})" class="btn btn-sm btn-warning" data-toggle="modal"><i class="fa fa-upload" aria-hidden="true"></i> Upload
                                        Approval</button>
                                </td>
                                @else
                                <td>
                                    @if (!empty($warrantyClaim->AdditionalInfo) && $warrantyClaim->Status != 'Approved')
                                    <span style="color: red;font-weight: 600;">{{ $warrantyClaim->Status }}</span>
                                    @else
                                    {{ $warrantyClaim->Status }}
                                    @endif
                                    @if (Auth::user()->RoleId == 2 || Auth::user()->RoleId == 3)
                                    @if ($warrantyClaim->Status == 'Approved')
                                    <form action="{{ url('/admin/download-approval') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $warrantyClaim->Id }}" name="downloadId">
                                        <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-paperclip" aria-hidden="true"></i>
                                            Download Approval
                                        </button>
                                    </form>
                                    @endif
                                    @endif
                                </td>
                                @endif
                                @endif

                                @if (Auth::user()->RoleId == 2 && $warrantyClaim->Status == 'Submitted')
                                <td class="text-center">
                                    @if($warrantyClaim->WarrantyDone == 1)
                                    <p><span class="badge badge-success">Warranty Done</span></p>
                                    @endif
                                    @if($warrantyClaim->WarrantyDone == 0)
                                    <p><span class="badge badge-danger">Warranty Not Done</span></p>
                                    @endif
                                </td>
                                @elseif (Auth::user()->RoleId == 1 && $warrantyClaim->Status == 'Approved')
                                <td class="text-center">
                                    @if($warrantyClaim->InvoiceDone == 1)
                                    <p><span class="badge badge-success">Invoice Done</span></p>
                                    @endif
                                    @if($warrantyClaim->InvoiceDone == 0)
                                    <p><span class="badge badge-danger">Invoice Not Done</span></p>
                                    @endif
                                </td>
                                @elseif(Auth::user()->RoleId == 3)

                                @else
                                <td></td>
                                @endif



                                <td>
                                    @if (Auth::user()->RoleId == 2 && $warrantyClaim->Status == 'Approved' && $warrantyClaim->AskingParts == 0)
                                    <a href="{{ url('/admin-asking-parts-to-spo/' . $warrantyClaim->Id) }}" title="Asking Parts">
                                        <button type="button" class="btn btn-sm btn-dark btn-flat"><i class="fa fa-question-circle" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    @endif

                                    @if (Auth::user()->RoleId == 2 && $warrantyClaim->Status == 'Submitted' && $warrantyClaim->WarrantyDone == 0)
                                    <a href="{{ url('/admin-warranty-claim-done/' . $warrantyClaim->Id) }}" title="Warranty Done">
                                        <button type="button" class="btn btn-sm btn-success btn-flat"><i class="fas fa-solid fa-check"></i>
                                        </button>
                                    </a>
                                    @endif

                                    @if (Auth::user()->RoleId == 1 && $warrantyClaim->Status == 'Approved' && $warrantyClaim->InvoiceDone == 0)
                                    <a href="{{ url('/spo-invoice-claim-done/' . $warrantyClaim->Id) }}" title="Invoice Done">
                                        <button type="button" class="btn btn-sm btn-success btn-flat"><i class="fas fa-solid fa-check"></i>
                                        </button>
                                    </a>
                                    @endif

                                    @if (Auth::user()->RoleId == 1)
                                    <a href="{{ url('/claim-warranty/' . $warrantyClaim->Id) }}" title="Show">
                                        <button type="button" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    @if ($warrantyClaim->Status != 'Submitted' && $warrantyClaim->Status != 'Approved')
                                    <a href="{{ url('/claim-warranty/' . $warrantyClaim->Id . '/edit') }}" title="Edit">
                                        <button type="button" class="btn btn-sm btn-info btn-flat"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <!-- <a id="openDeleteModal" data-toggle="modal" data-id="{{ $warrantyClaim->Id }}" title="Delete"  href=""><button type="button" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i> -->
                                    <!-- </button></a> -->
                                    @endif
                                    @endif

                                    @if (Auth::user()->RoleId == 2)
                                    <a href="{{ url('/engineer-warranty-claims/' . $warrantyClaim->Id) }}" title="Show">
                                        <button type="button" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    @if ($warrantyClaim->Status == 'Submitted')
                                    @php $myId = $warrantyClaim->Id; @endphp
                                    <button type="button" onclick="openAdditionalInfoModal({{ $myId }})" class="btn btn-sm btn-warning" data-toggle="modal"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                    @endif

                                    @if ($warrantyClaim->Status != 'Approved')
                                    <a href="{{ url('/engineer-warranty-claims/' . $warrantyClaim->Id . '/edit') }}" title="Edit">
                                        <button type="button" class="btn btn-sm btn-info btn-flat"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a id="openDeleteModal" data-toggle="modal" data-id="{{ $warrantyClaim->Id }}" title="Delete" href=""><button type="button" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i>
                                        </button></a>
                                    @if($warrantyClaim->Locked == 1)
                                        <button type="button" id="unlockBtn{{$warrantyClaim->Id}}" class="btn btn-sm btn-dark" title="Unlock Engineer Warranty Submit Button" onclick="unlockEngineerWarrantyBtn({{$warrantyClaim->Id}})" ><i class="fa fa-unlock" aria-hidden="true"></i></button>
                                    @endif

                                    @endif
                                    @endif

                                    @if (Auth::user()->RoleId == 3)
                                    <a href="{{ url('/engineer-warranty-claims/' . $warrantyClaim->Id) }}" title="Show">
                                        <button type="button" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    @php 
                                    $current=\Carbon\Carbon::now()->toDateString(); 
                                    $to = \Carbon\Carbon::parse($warrantyClaim->CreatedAt);
                                    // dd($to->diffInDays($current));
                                    @endphp
                                    @if ($warrantyClaim->Status != 'Submitted' && $warrantyClaim->Status != 'Approved' && $warrantyClaim->Locked==0)
                                    <a href="{{ url('/engineer-warranty-claims/' . $warrantyClaim->Id . '/edit') }}" title="Edit">
                                        <button type="button" class="btn btn-sm btn-info btn-flat"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <!-- <a id="openDeleteModal" data-toggle="modal" data-id="{{ $warrantyClaim->Id }}" title="Delete"  href=""><button type="button" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i> -->
                                    <!-- </button></a> -->
                                    @endif
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
                <div class="d-flex justify-content-end mt-1">{{ $warrantyClaims->links() }}</div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    </div>
    <!--row end -->
</div><!-- /.container-fluid -->

<!-- Upload documents Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upload_approval_form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="" name="dataId" id="uploadId">

                    <div class="form-group {{ $errors->has('ApprovalImage') ? 'has-error' : '' }}">
                        <label for="ApprovalImage">Approval Image</label>
                        <input name="ApprovalImage" type="file" id="ApprovalImage" class="form-control" value="{{ old('ApprovalImage') }}" autofocus max="191" required placeholder="Product Image">
                        @if ($errors->has('ApprovalImage'))
                        <span class="help-block"><strong>{{ $errors->first('ApprovalImage') }}</strong></span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="uploadApprovalBtn" class="btn btn-sm btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Additional Info Modal -->
<div class="modal fade" id="additionalInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Additional Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.additional.info') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('POST') }}

                    <input type="hidden" value="" name="warranty_claim_info_id" id="additionalInfoId">

                    <div class="form-group {{ $errors->has('AdditionalInfo') ? 'has-error' : '' }}">
                        <label for="AdditionalInfo">Additional Information</label>
                        <textarea name="AdditionalInfo" id="AdditionalInfo" class="form-control" rows="3" placeholder="Enter Additional Information"></textarea>
                        @if ($errors->has('AdditionalInfo'))
                        <span class="help-block"><strong>{{ $errors->first('AdditionalInfo') }}</strong></span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
            </form>
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
                {{ method_field('DELETE') }}
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
    document.title = 'Warranty Claim Info';
</script>
<script type="text/javascript">
    $(document).on("click", "#openDeleteModal", function() {
        var delId = $(this).data("id");
        $("#delete_modal_form").attr("action", "{{ url('/claim-warranty') }}/" + delId);
        $(".modal-body #delete_id").val(delId);
        $("#myModal").modal("show");
    });
</script>
<script>
    function openModal(id) {
        console.log(id);
        $("#uploadId").val(id);
        $("#approvalModal").modal();

    }

    function openAdditionalInfoModal(id) {
        console.log(id);
        $("#additionalInfoId").val(id);
        $("#additionalInfoModal").modal();
    }
</script>
<script>
    // $(document).ready(function() {
    //     $('#table_id').DataTable();
    // });

    $(document).ready(function() {
        $("#date_from").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
        $("#date_to").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    });
</script>

<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('#upload_approval_form').on('submit', function(e) {
        e.preventDefault();
        let url;
        url = "{{ route('upload.approval') }}";

        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            complete: function(response) {
                toastr.success(response.responseJSON.success);
                $('#upload_approval_form').trigger("reset");
                $('#approvalModal').modal('hide');
                $('#row_'+response.responseJSON.warrantyId).css("background-color", "#bbff99");
            }
        });
    });
</script>
<script>
    function unlockEngineerWarrantyBtn(warranty_claim_id){
        console.log(warranty_claim_id);
        let url;
        url = "{{ route('unlock.engineer.warranty.submit.btn') }}";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                    warranty_claim_id: warranty_claim_id, 
                    "_token":"{{ csrf_token() }}" 
                },
            dataType: "json",

            success: function(response) {
                toastr.success(response.success);
                $('#unlockBtn'+warranty_claim_id).hide();
            }
        });
    }
</script>
@endsection