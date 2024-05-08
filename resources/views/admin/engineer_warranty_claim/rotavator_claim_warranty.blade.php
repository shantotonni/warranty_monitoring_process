@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <!-- <h1 class="m-0 text-dark">Warranty Claim Form ( New Machinery )</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Warranty Claim Form ( Rotavator )</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
    <div class="container-fluid">
        <form role="form" class="" enctype="multipart/form-data" method="POST" action="{{ route('engineer-warranty-claims.update', $warranty->Id) }}" >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

           <div class="row">
            <div class="col-12">
                <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="card-title">Warranty Claim Form - Rotavator</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Customer Informations</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>Rotavator Informations</h5>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerName') ? 'has-error' : '' }}">
                                    <label for="CustomerName">Customer Name</label>
                                    <input name="CustomerName" type="text" id="CustomerName" class="form-control" value="{{ $warranty->CustomerName }}" required autofocus placeholder="Enter Customer Name">
                                        @if ($errors->has('CustomerName'))
                                            <span class="help-block"><strong>{{ $errors->first('CustomerName') }}</strong></span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Model') ? 'has-error' : '' }}">
                                    <label for="Model">Model</label>
                                    <input name="Model" type="text" id="Model" class="form-control" value="{{ $warranty->Model }}" required autofocus placeholder="Enter Model">
                                        @if ($errors->has('Model'))
                                            <span class="help-block"><strong>{{ $errors->first('Model') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerCode') ? 'has-error' : '' }}">
                                    <label for="CustomerCode">Customer Code</label>
                                    <input name="CustomerCode" type="text" id="CustomerCode" class="form-control" value="{{ $warranty->CustomerCode }}" required autofocus placeholder="Enter Customer Code">
                                        @if ($errors->has('CustomerCode'))
                                            <span class="help-block"><strong>{{ $errors->first('CustomerCode') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('ChassisNumber') ? 'has-error' : '' }}">
                                    <label for="ChassisNumber">Chassis Number</label>
                                    <input name="ChassisNumber" type="text" id="ChassisNumber" class="form-control" value="{{ $warranty->ChassisNumber }}" required autofocus placeholder="Enter Chassis Number">
                                        @if ($errors->has('ChassisNumber'))
                                            <span class="help-block"><strong>{{ $errors->first('ChassisNumber') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerNumber') ? 'has-error' : '' }}">
                                    <label for="CustomerNumber">Mobile</label>
                                    <input name="CustomerNumber" type="text" id="CustomerNumber" class="form-control" value="{{ $warranty->CustomerNumber }}" required autofocus placeholder="Enter Customer Number">
                                        @if ($errors->has('CustomerNumber'))
                                            <span class="help-block"><strong>{{ $errors->first('CustomerNumber') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('EngineNo') ? 'has-error' : '' }}">
                                    <label for="EngineNo">Engine No</label>
                                    <input name="EngineNo" type="text" id="EngineNo" class="form-control" value="{{ $warranty->EngineNo }}" required autofocus placeholder="Enter Engine No">
                                        @if ($errors->has('EngineNo'))
                                            <span class="help-block"><strong>{{ $errors->first('EngineNo') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('Upazila') ? 'has-error' : '' }}">
                                    <label for="Upazila">Upazila</label>
                                    <input name="Upazila" type="text" id="Upazila" class="form-control" value="{{ $warranty->Upazila }}" required autofocus placeholder="Enter Upazila">
                                        @if ($errors->has('Upazila'))
                                            <span class="help-block"><strong>{{ $errors->first('Upazila') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('DeliveryDate') ? 'has-error' : '' }}">
                                    <label for="DeliveryDate">Delivery Date</label>
                                    <input name="DeliveryDate" autocomplete="off" type="text" id="datepicker1" class="form-control" value="{{ $warranty->DeliveryDate }}" required autofocus placeholder="Enter Date Of Sale">
                                        @if ($errors->has('DeliveryDate'))
                                            <span class="help-block"><strong>{{ $errors->first('DeliveryDate') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('DistrictName') ? 'has-error' : '' }}">
                                    <label for="DistrictName">District</label>
                                    <input name="DistrictName" type="text" id="DistrictName" class="form-control" value="{{ $warranty->DistrictName }}" required autofocus placeholder="Enter District Name">
                                        @if ($errors->has('DistrictName'))
                                            <span class="help-block"><strong>{{ $errors->first('DistrictName') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('WorkingHour') ? 'has-error' : '' }}">
                                    <label for="WorkingHour">Working Hour</label>
                                    <input name="WorkingHour" type="text" id="WorkingHour" class="form-control" value="{{ $warranty->WorkingHour }}" required autofocus placeholder="Enter Working Hour">
                                        @if ($errors->has('WorkingHour'))
                                            <span class="help-block"><strong>{{ $errors->first('WorkingHour') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-start">
                                <h5>Complain Details</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('CustomerComplaint') ? 'has-error' : '' }}">
                                    <label for="CustomerComplaint">Customer's Complaint</label>
                                    <textarea name="CustomerComplaint" id="CustomerComplaint" class="form-control" rows="3" required  placeholder="Enter Customer Complaint">{{ $warranty->CustomerComplaint }}</textarea>
                                        @if ($errors->has('CustomerComplaint'))
                                            <span class="help-block"><strong>{{ $errors->first('CustomerComplaint') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('SEAnalysis') ? 'has-error' : '' }}">
                                    <label for="SEAnalysis">SE Observation</label>
                                    <textarea name="SEAnalysis" id="SEAnalysis" class="form-control" rows="3" required placeholder="Enter SE Observation">{{ $warranty->SEAnalysis }}</textarea>
                                        @if ($errors->has('SEAnalysis'))
                                            <span class="help-block"><strong>{{ $errors->first('SEAnalysis') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('fileName') ? 'has-error' : '' }}">
                                    <label for="fileName">Upload File <span style="color: red; font-size: 10px;">(*Supported format: .jpg, .pdf, .xls)</span></label>
                                    <input name="fileNames[]" type="file" id="fileName" class="form-control" value="" autofocus placeholder="Upload Files" multiple required>
                                        @if ($errors->has('fileName'))
                                            <span class="help-block"><strong>{{ $errors->first('fileName') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Parts Details</h6>
                                    <table class="table table-bordered table-small small">
                                        <tbody>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Parts Description</th>
                                                    <th>Parts Code</th>
                                                    <th>Supplier Code</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                                @php
                                                    $totalPartsPrice = 0;
                                                @endphp
                                            @foreach($warranty->parts as $part)
                                                <input type="hidden" name="partsCode[]" value="{{$part->PartsNumber}}">
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{ $part->PartsName }}</td>
                                                    <td>{{ $part->PartsNumber }}</td>
                                                    <td><input type="text" name="supplierCode[]" value="@if(!empty($part->SupplierCode)) {{ $part->SupplierCode }} @endif" class="form-control" placeholder="Enter Supplier Code" required></td>
                                                    <td class="text-right">{{ $part->Quantity }}</td>
                                                    <td class="text-right"> {{ $part->Price }}</td>
                                                </tr>
                                                @php
                                                    $totalPartsPrice = $totalPartsPrice + $part->Price;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <th colspan="5">Total Amount</th>
                                                <th class="text-right">{{$totalPartsPrice}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('FailureDate') ? 'has-error' : '' }}">
                                    <label for="FailureDate">Date of Failure</label>
                                    <input name="FailureDate" type="text" id="FailureDate" class="form-control" value="{{ $warranty->FailureDate }}" required autofocus placeholder="Enter Failure Date">
                                        @if ($errors->has('FailureDate'))
                                            <span class="help-block"><strong>{{ $errors->first('FailureDate') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('FailureArea') ? 'has-error' : '' }}">
                                    <label for="FailureArea">Failure Area</label>
                                    <input name="FailureArea" type="text" id="FailureArea" class="form-control" value="{{ $warranty->FailureArea }}" required autofocus placeholder="Enter Failure Area">
                                        @if ($errors->has('FailureArea'))
                                            <span class="help-block"><strong>{{ $errors->first('FailureArea') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('RepairDate') ? 'has-error' : '' }}">
                                    <label for="RepairDate">Repair Done Date</label>
                                    <input name="RepairDate" autocomplete="off" type="text" id="datepicker2" class="form-control" value="{{ $warranty->RepairDate }}" required autofocus placeholder="Enter Repair Done Date">
                                        @if ($errors->has('RepairDate'))
                                            <span class="help-block"><strong>{{ $errors->first('RepairDate') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('WarrantyClaimDate') ? 'has-error' : '' }}">
                                    <label for="WarrantyClaimDate">Warranty Claim Date</label>
                                    <input name="WarrantyClaimDate" autocomplete="off" type="text" id="datepicker3" class="form-control" value="{{ $warranty->WarrantyClaimDate }}" required autofocus placeholder="Enter Warranty Claim Date">
                                        @if ($errors->has('WarrantyClaimDate'))
                                            <span class="help-block"><strong>{{ $errors->first('WarrantyClaimDate') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>

                  </div>
                 <!-- /.card-body -->
                 <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-info btn-flat">Submit</button>
                </div>
            </div>
                 <!-- /.card -->
            </div> <!-- /.col-12 -->
      </div> <!--row end -->
      <input type="hidden" name="ProductId" value="4">
      </form>
    </div><!-- /.container-fluid -->

    @endsection

    @section('scripts')
    <script>document.title = 'Engineer Warranty Claim | Claim';</script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            "use strict";
            $(".repeater").repeater({
                defaultValues: {
                "textarea-input": "foo",
                "text-input": "bar",
                "select-input": "B",
                "checkbox-input": ["A", "B"],
                "radio-input": "B",
                },
                show: function () {
                $(this).slideDown();
                },
                hide: function (e) {
                confirm("Are you sure you want to delete this element?") &&
                    $(this).slideUp(e);
                },
                ready: function (e) {},
            }),
                (window.outerRepeater = $(".outer-repeater").repeater({
                defaultValues: { "text-input": "outer-default" },
                show: function () {
                    console.log("outer show"), $(this).slideDown();
                },
                hide: function (e) {
                    console.log("outer delete"), $(this).slideUp(e);
                },
                repeaters: [
                    {
                    selector: ".inner-repeater",
                    defaultValues: { "inner-text-input": "inner-default" },
                    show: function () {
                        console.log("inner show"), $(this).slideDown();
                    },
                    hide: function (e) {
                        console.log("inner delete"), $(this).slideUp(e);
                    },
                    },
                ],
                }));
            });

    </script>
    <script>
        $( function() {
            $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});
            $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});
            $( "#datepicker3" ).datepicker({dateFormat: 'yy-mm-dd'});
            $( "#FailureDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        } );
  </script>
@endsection
