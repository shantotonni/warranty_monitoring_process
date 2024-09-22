@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Warranty Claim Info (Harvester)</h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Warranty Claim Info (Harvester) Show</li>
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
            <div class="card" style="font-size: 18px;">
                <div class="card-header">
                    <h4 class="card-title">Warranty Claim Info (Harvester)</h4>
                    <input type="button" class="btn btn-primary float-right" value="Print" onclick='printtag("print");'>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="print" style="font-size: 20px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="text-center">ACI Motor Ltd.</h3>
                            <h5 class="text-center">WARRANTY CLAIM FORM (New Machinery)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Customer Informations</h6>
                        </div>
                        <div class="col-sm-6">
                            <h6>Harvester Details</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $warranty->CustomerName }}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Code</th>
                                        <td>{{ $warranty->CustomerCode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{ $warranty->CustomerNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>Upazila</th>
                                        <td>{{ $warranty->Upazila }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $warranty->DistrictName }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th>Warranty Number</th>
                                        <td>@if($warranty->product->Id==2) HAR/WRT/{{ $warranty->Id }} @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>{{ $warranty->product->Name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td>{{ $warranty->Model }}</td>
                                    </tr>
                                    <tr>
                                        <th>Engine No</th>
                                        <td>{{ $warranty->EngineNo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chassis No</th>
                                        <td>{{ $warranty->ChassisNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Date</th>
                                        <td>@if($warranty->DeliveryDate==NULL){{""}} @else {{ date("d-M-Y", strtotime($warranty->DeliveryDate)) }} @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Working Hour</th>
                                        <td>{{ $warranty->WorkingHour }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <h6>Complain Details</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">Customer's Complaint</th>
                                        <td>{{ $warranty->CustomerComplaint }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">SE Analysis</th>
                                        <td>{{ $warranty->SEAnalysis }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <h6>Parts Details</h6>
                        </div>
                    </div>
                    @php
                    $totalPartsPrice = 0;
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Parts Description</th>
                                        <th>Parts Code</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                    @foreach ($warranty->parts as $part)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $part->PartsName }}</td>
                                        <td>{{ $part->PartsNumber }}</td>
                                        <td class="text-right">{{ $part->Quantity }}</td>
                                        <td class="text-right"> {{ $part->Price }}</td>
                                    </tr>
                                    @php
                                    $totalPartsPrice = $totalPartsPrice + $part->Price;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <th colspan="4">Total Amount</th>
                                        <th class="text-right">{{ $totalPartsPrice }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th>MQR Number</th>
                                        <td>{{ $warranty->MQRNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>MQR Date</th>
                                        <td>{{ date_format(date_create($warranty->MQRDate), 'd/m/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm small">
                                <tbody>
                                    <tr>
                                        <th>Job Card No</th>
                                        <td>{{ $warranty->JobCardNo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Card Date</th>
                                        <td>{{ date_format(date_create($warranty->JobCardDate), 'd/m/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br><br><br><br>
                    <div class="row mt-4">
                        <!-- <div class="col-sm-1" style="margin-left: -50px;"></div> -->
                        <div class="col-sm-3 text-center">
                            <p class="pb-2"><strong>Proposed By</strong></p>
                            <img src="{{asset('images/signature_images/'.$warranty->engineer->SignatureImage)}}" height="100" width="220" alt="{{$warranty->engineer->SignatureImage}}">
                            <hr>
                            <p><strong>SE/Sr.SE/TMS</strong></p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <p class="pb-2" style="margin-bottom: 132px;"><strong>Checked By</strong></p>
                            <hr>
                            <p><strong>DM, Service</strong></p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <p class="pb-2" style="margin-bottom: 132px;"><strong>Recommended By</strong></p>
                            <hr>
                            <p><strong>AGM, Service</strong></p>
                        </div>

                        <div class="col-sm-3 text-center">
                            <p class="pb-2" style="margin-bottom: 132px;"><strong>Approved By</strong></p>
                            <hr>
                            <p><strong>Director (S & PD)</strong></p>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            @if (!empty($warranty->AdditionalInfo))
            <div class="card">
                <div class="card-header">
                    <h5 style="color: red;">Additional Requirements from HQ</h5>
                </div>
                <div class="card-body" style="font-size: 16px;">
                    <p>{{ $warranty->AdditionalInfo }}</p>
                </div>
            </div>
            @endif
        </div>
        <!-- /.col -->

    </div>
    <!--row end -->
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
    document.title = 'Warranty Claim | Show';
</script>

<script>
    function printtag(tagid) {
        var hashid = "#" + tagid;
        var tagname = $(hashid).prop("tagName").toLowerCase();
        var attributes = "";
        var attrs = document.getElementById(tagid).attributes;
        $.each(attrs, function(i, elem) {
            attributes += " " + elem.name + " ='" + elem.value + "' ";
        })
        var divToPrint = $(hashid).html();
        var head = "<html><head>" + $("head").html() + "</head>";
        var allcontent = head + "<body  onload='window.print()' style='background: white;'>" + "<" + tagname + attributes + ">" + divToPrint +
            "</" + tagname + ">" + "</body></html>";
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
        setTimeout(function() {
            newWin.close();
        }, 100);
    }
</script>
@endsection
