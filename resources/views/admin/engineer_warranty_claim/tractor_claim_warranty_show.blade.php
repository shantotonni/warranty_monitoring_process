@extends('admin.layouts.master')
@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Warranty Claim Info (Tractor)</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Warranty Claim Info (Tractor) Show</li>
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
                        <h4 class="card-title">Warranty Claim Info (Tractor)</h4>
                        <input type="button" class="btn btn-primary float-right" value="Print" onclick='printtag("print");'>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="print">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center">ACI Motor Ltd.</h3>
                                <h5 class="text-center">WARRANTY CLAIM FORM (Tractor)</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Customer Informations</h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Tractor Details</h6>
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
                                            <th>P.S</th>
                                            <td>{{ $warranty->PoliceStation }}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $warranty->DistrictName }}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{ $warranty->State }}</td>
                                        </tr>
                                        <tr>
                                            <th>Dealer</th>
                                            <td>{{ $warranty->DealerName }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <th>Product</th>
                                            <td>{{ $warranty->product->Name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Model</th>
                                            <td>{{ $warranty->Model }}</td>
                                        </tr>
                                        <tr>
                                            <th>Chassis No</th>
                                            <td>{{ $warranty->ChassisNumber }}</td>
                                        </tr>
                                        <tr>
                                            <th>Engine No</th>
                                            <td>{{ $warranty->EngineNo }}</td>
                                        </tr>
                                        <tr>
                                            <th>Operation</th>
                                            <td>{{ $warranty->Oparation }}</td>
                                        </tr>
                                        <tr>
                                            <th>Attachment</th>
                                            <td>{{ $warranty->Attachment }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Sale</th>
                                            <td>{{ date_format(date_create($warranty->DateOfSale), 'd/m/Y') }}</td>
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
                                            <th>Running Hour</th>
                                            <td>{{ $warranty->RunningHour }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <th>Aggregates</th>
                                            <td>{{ $warranty->Aggregates }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <h6>Job Card Entry</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <th>Date of Complaint</th>
                                            <td>{{ date_format(date_create($warranty->DateOfComplaint), 'd/m/Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <th>Date of Repair</th>
                                            <td>{{ date_format(date_create($warranty->DateOfRepair), 'd/m/Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <h6>Service History</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-small small">

                                    <tr>
                                        <td>FSC</td>
                                        @foreach ($result as $key => $item)
                                            <td>{{ $item['Name'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Date of Service</td>
                                        <?php
                                        //dd($result);
                                        ?>
                                        @foreach ($result as $key => $item)

                                            <td>{{ $item['DateOfService'] }}</td>

                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Hours</td>
                                        @foreach ($result as $key => $item)
                                            <td>{{ $item['Hours'] }}</td>
                                        @endforeach
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <th>Customer's Complaint</th>
                                            <td>{{ $warranty->CustomerComplaint }}</td>
                                        </tr>
                                        <tr>
                                            <th>SE Analysis</th>
                                            <td>{{ $warranty->SEAnalysis }}</td>
                                        </tr>
                                        <tr>
                                            <th>Action Taken</th>
                                            <td>{{ $warranty->ActionToken }}</td>
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

                        <br><br><br><br><br>

                        <div class="row">
                            <!-- <div class="col-sm-1" style="margin-left: -50px;"></div> -->
                            <div class="col-sm-3 text-center">
                                <p class="pb-2"  style="margin-bottom: 132px;"><strong>Proposed By</strong></p>
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
                                <p><strong>CBO, Motors</strong></p>
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
