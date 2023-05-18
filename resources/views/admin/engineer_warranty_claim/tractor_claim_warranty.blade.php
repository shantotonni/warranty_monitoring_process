@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <!-- <h1 class="m-0 text-dark">Warranty Claim Form ( Tractor )</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Warranty Claim Form ( Tractor )</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
    <div class="container-fluid">
        <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('engineer-warranty-claims.update', $warranty->Id) }}" >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

           <div class="row">
            <div class="col-12">
                <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="card-title">Warranty Claim Form ( Tractor )</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Customer Informations</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>Tractor Details</h5>
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
                            <div class="col-sm-3">
                                <div class="form-group {{ $errors->has('CustomerNumber') ? 'has-error' : '' }}">
                                    <label for="CustomerNumber">Mobile</label>
                                    <input name="CustomerNumber" type="text" id="CustomerNumber" class="form-control" value="{{ $warranty->CustomerNumber }}" required autofocus placeholder="Enter Customer Number">
                                        @if ($errors->has('CustomerNumber'))
                                            <span class="help-block"><strong>{{ $errors->first('CustomerNumber') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                                <div class="form-group {{ $errors->has('PoliceStation') ? 'has-error' : '' }}">
                                    <label for="PoliceStation">Police Station</label>
                                    <input name="PoliceStation" type="text" id="PoliceStation" class="form-control" value="{{ $warranty->PoliceStation }}" required autofocus placeholder="Enter Police Station">
                                        @if ($errors->has('PoliceStation'))
                                            <span class="help-block"><strong>{{ $errors->first('PoliceStation') }}</strong></span>
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
                                <div class="form-group {{ $errors->has('DistrictName') ? 'has-error' : '' }}">
                                    <label for="DistrictName">District</label>
                                    <input name="DistrictName" type="text" id="DistrictName" class="form-control" value="{{ $warranty->DistrictName }}" required autofocus placeholder="Enter District Name">
                                        @if ($errors->has('DistrictName'))
                                            <span class="help-block"><strong>{{ $errors->first('DistrictName') }}</strong></span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('Oparation') ? 'has-error' : '' }}">
                                    <label for="Oparation">Oparation</label>
                                    <select name="Oparation" id="Oparation" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Oparation</option>
                                        <option value="Paddy Field" @if ($warranty->Oparation == 'Paddy Field') {{ 'selected' }} @endif">Paddy Field</option>
                                        <option value="Haulage" @if ($warranty->Oparation == 'Haulage') {{ 'selected' }} @endif">Haulage</option>
                                    </select>
                                    @if ($errors->has('Oparation'))
                                    <span class="help-block"><strong>{{ $errors->first('Oparation') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('State') ? 'has-error' : '' }}">
                                    <label for="State">State</label>
                                    <input name="State" type="text" id="State" class="form-control" value="{{ $warranty->State }}" required autofocus placeholder="Enter State">
                                        @if ($errors->has('State'))
                                            <span class="help-block"><strong>{{ $errors->first('State') }}</strong></span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('Attachment') ? 'has-error' : '' }}">
                                    <label for="Attachment">Attachment</label>
                                    <select name="Attachment" id="Attachment" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Attachment</option>
                                        <option value="Rotavator" @if ($warranty->Attachment == 'Rotavator') {{ 'selected' }} @endif">Rotavator</option>
                                        <option value="Tipping Trailer" @if ($warranty->Attachment == 'Tipping Trailer') {{ 'selected' }} @endif">Tipping Trailer</option>
                                    </select>
                                    @if ($errors->has('Attachment'))
                                    <span class="help-block"><strong>{{ $errors->first('Attachment') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('DealerName') ? 'has-error' : '' }}">
                                    <label for="DealerName">Dealer</label>
                                    <select name="DealerName" id="DealerName" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Dealer Name</option>
                                        <option value="ACI Barisal Barisal" @if ($warranty->DealerName == 'ACI Barisal Barisal') {{ 'selected' }} @endif">ACI Barisal Barisal</option>
                                        <option value="ACI Comilla Comilla" @if ($warranty->DealerName == 'ACI Comilla Comilla') {{ 'selected' }} @endif">ACI Comilla Comilla</option>
                                        <option value="ACI Gazipur Gazipur" @if ($warranty->DealerName == 'ACI Gazipur Gazipur') {{ 'selected' }} @endif">ACI Gazipur Gazipur</option>
                                        <option value="ACI Dhaka Dhaka" @if ($warranty->DealerName == 'ACI Dhaka Dhaka') {{ 'selected' }} @endif">ACI Dhaka Dhaka</option>
                                        <option value="ACI Jessore Jessore" @if ($warranty->DealerName == 'ACI Jessore Jessore') {{ 'selected' }} @endif">ACI Jessore Jessore</option>
                                        <option value="ACI Bogra Bogra" @if ($warranty->DealerName == 'ACI Bogra Bogra') {{ 'selected' }} @endif">ACI Bogra Bogra</option>
                                        <option value="ACI Rangpur Rangpur" @if ($warranty->DealerName == 'ACI Rangpur Rangpur') {{ 'selected' }} @endif">ACI Rangpur Rangpur</option>
                                        <option value="ACI Sylhet Sylhet" @if ($warranty->DealerName == 'ACI Sylhet Sylhet') {{ 'selected' }} @endif">ACI Sylhet Sylhet</option>
                                    </select>
                                    @if ($errors->has('DealerName'))
                                    <span class="help-block"><strong>{{ $errors->first('DealerName') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('DateOfSale') ? 'has-error' : '' }}">
                                    <label for="DateOfSale">Date Of Sale</label>
                                    <input name="DateOfSale" type="text" id="datepicker1" class="form-control" value="{{ $warranty->DateOfSale }}" required autofocus autocomplete="off" placeholder="Enter Date Of Sale">
                                        @if ($errors->has('DateOfSale'))
                                            <span class="help-block"><strong>{{ $errors->first('DateOfSale') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('RunningHour') ? 'has-error' : '' }}">
                                    <label for="RunningHour">Running Hour</label>
                                    <input name="RunningHour" type="text" id="RunningHour" class="form-control" value="{{ $warranty->RunningHour }}" required autofocus placeholder="Enter Running Hour">
                                        @if ($errors->has('RunningHour'))
                                            <span class="help-block"><strong>{{ $errors->first('RunningHour') }}</strong></span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('Aggregates') ? 'has-error' : '' }}">
                                    <label for="Aggregates">Aggregates</label>
                                    <select name="Aggregates" id="Aggregates" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Aggregates</option>
                                        <option value="Electricals" @if ($warranty->Aggregates == 'Electricals') {{ 'selected' }} @endif">Electricals</option>
                                        <option value="Engine" @if ($warranty->Aggregates == 'Engine') {{ 'selected' }} @endif">Engine</option>
                                        <option value="Front Axle" @if ($warranty->Aggregates == 'Front Axle') {{ 'selected' }} @endif">Front Axle</option>
                                        <option value="Hydraulic" @if ($warranty->Aggregates == 'Hydraulic') {{ 'selected' }} @endif">Hydraulic</option>
                                        <option value="Rear Axle" @if ($warranty->Aggregates == 'Rear Axle') {{ 'selected' }} @endif">Rear Axle</option>
                                        <option value="Steering System" @if ($warranty->Aggregates == 'Steering System') {{ 'selected' }} @endif">Steering System</option>
                                        <option value="Transmission" @if ($warranty->Aggregates == 'Transmission') {{ 'selected' }} @endif">Transmission</option>
                                        <option value="Vehicle" @if ($warranty->Aggregates == 'Vehicle') {{ 'selected' }} @endif">Vehicle</option>
                                    </select>
                                    @if ($errors->has('Aggregates'))
                                    <span class="help-block"><strong>{{ $errors->first('Aggregates') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <h5>Job Card Entry</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('DateOfComplaint') ? 'has-error' : '' }}">
                                    <label for="DateOfComplaint">Date Of Complaint</label>
                                    <input name="DateOfComplaint" type="text" id="datepicker2" class="form-control" value="{{ $warranty->DateOfComplaint }}" required autofocus autocomplete="off" placeholder="Enter Date Of Complaint">
                                        @if ($errors->has('DateOfComplaint'))
                                            <span class="help-block"><strong>{{ $errors->first('DateOfComplaint') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('DateOfRepair') ? 'has-error' : '' }}">
                                    <label for="DateOfRepair">Date Of Repair</label>
                                    <input name="DateOfRepair" type="text" id="datepicker3" class="form-control" value="{{ $warranty->DateOfRepair }}" required autofocus autocomplete="off" placeholder="Enter Date Of Repair">
                                        @if ($errors->has('DateOfRepair'))
                                            <span class="help-block"><strong>{{ $errors->first('DateOfRepair') }}</strong></span>
                                        @endif
                                </div>
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
                                    <thead>
                                        <tr>
                                            <th>FSC</th>
                                            @foreach($serviceHisHeadings as $serviceHead)
                                                <th>{{$serviceHead->Name}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Date of Service</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service1') ? 'has-error' : '' }}">
                                                            <input name="service1" type="text" id="service1" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service1">
                                                                @if ($errors->has('service1'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service1') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service2') ? 'has-error' : '' }}">
                                                            <input name="service2" type="text" id="service2" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service2">
                                                                @if ($errors->has('service2'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service2') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service3') ? 'has-error' : '' }}">
                                                            <input name="service3" type="text" id="service3" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service3">
                                                                @if ($errors->has('service3'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service3') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service4') ? 'has-error' : '' }}">
                                                            <input name="service4" type="text" id="service4" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service4">
                                                                @if ($errors->has('service4'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service4') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service5') ? 'has-error' : '' }}">
                                                            <input name="service5" type="text" id="service5" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service5">
                                                                @if ($errors->has('service5'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service5') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service6') ? 'has-error' : '' }}">
                                                            <input name="service6" type="text" id="service6" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service6">
                                                                @if ($errors->has('service6'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service6') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service7') ? 'has-error' : '' }}">
                                                            <input name="service7" type="text" id="service7" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service7">
                                                                @if ($errors->has('service7'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service7') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service8') ? 'has-error' : '' }}">
                                                            <input name="service8" type="text" id="service8" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service8">
                                                                @if ($errors->has('service8'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service8') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('service9') ? 'has-error' : '' }}">
                                                            <input name="service9" type="text" id="service9" class="form-control" value="" autofocus autocomplete="off" placeholder="Enter service9">
                                                                @if ($errors->has('service9'))
                                                                    <span class="help-block"><strong>{{ $errors->first('service9') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>

                                        <tr>
                                            <td>Hours</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour1') ? 'has-error' : '' }}">
                                                            <input name="hour1" type="text" id="hour1" class="form-control" value="" autofocus placeholder="Enter hour1">
                                                                @if ($errors->has('hour1'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour1') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour2') ? 'has-error' : '' }}">
                                                            <input name="hour2" type="text" id="hour2" class="form-control" value="" autofocus placeholder="Enter hour2">
                                                                @if ($errors->has('hour2'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour2') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour3') ? 'has-error' : '' }}">
                                                            <input name="hour3" type="text" id="hour3" class="form-control" value="" autofocus placeholder="Enter hour3">
                                                                @if ($errors->has('hour3'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour3') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour4') ? 'has-error' : '' }}">
                                                            <input name="hour4" type="text" id="hour4" class="form-control" value="" autofocus placeholder="Enter hour4">
                                                                @if ($errors->has('hour4'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour4') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour5') ? 'has-error' : '' }}">
                                                            <input name="hour5" type="text" id="hour5" class="form-control" value="" autofocus placeholder="Enter hour5">
                                                                @if ($errors->has('hour5'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour5') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour6') ? 'has-error' : '' }}">
                                                            <input name="hour6" type="text" id="hour6" class="form-control" value="" autofocus placeholder="Enter hour6">
                                                                @if ($errors->has('hour6'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour6') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour7') ? 'has-error' : '' }}">
                                                            <input name="hour7" type="text" id="hour7" class="form-control" value="" autofocus placeholder="Enter hour7">
                                                                @if ($errors->has('hour7'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour7') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour8') ? 'has-error' : '' }}">
                                                            <input name="hour8" type="text" id="hour8" class="form-control" value="" autofocus placeholder="Enter hour8">
                                                                @if ($errors->has('hour8'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour8') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group {{ $errors->has('hour9') ? 'has-error' : '' }}">
                                                            <input name="hour9" type="text" id="hour9" class="form-control" value="" autofocus placeholder="Enter hour9">
                                                                @if ($errors->has('hour9'))
                                                                    <span class="help-block"><strong>{{ $errors->first('hour9') }}</strong></span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>

                                    </tbody>
                                </table>
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
                                    <label for="SEAnalysis">SE Analysis</label>
                                    <textarea name="SEAnalysis" id="SEAnalysis" class="form-control" rows="3" required placeholder="Enter SE Analysis">{{ $warranty->SEAnalysis }}</textarea>
                                        @if ($errors->has('SEAnalysis'))
                                            <span class="help-block"><strong>{{ $errors->first('SEAnalysis') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('ActionToken') ? 'has-error' : '' }}">
                                    <label for="ActionToken">Action Taken</label>
                                    <textarea name="ActionToken" id="ActionToken" class="form-control" rows="3" required placeholder="Enter Action Taken">{{ $warranty->ActionToken }}</textarea>
                                        @if ($errors->has('ActionToken'))
                                            <span class="help-block"><strong>{{ $errors->first('ActionToken') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('fileName') ? 'has-error' : '' }}">
                                    <label for="fileNames">Upload File <span style="color: red; font-size: 10px;">(*Supported format: .jpg, .pdf)</span></label>
                                    <input name="fileNames[]" type="file" id="fileNames" class="form-control" value="" autofocus placeholder="Upload Files" multiple>
                                        @if ($errors->has('fileNames'))
                                            <span class="help-block"><strong>{{ $errors->first('fileNames') }}</strong></span>
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
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                                @php
                                                    $totalPartsPrice = 0;
                                                @endphp
                                            @foreach($warranty->parts as $part)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
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
                                                <th class="text-right">{{$totalPartsPrice}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
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
      <input type="hidden" name="ProductId" value="1">
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
            $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#datepicker3" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});

            $( "#service1" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service2" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service3" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service4" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service5" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service6" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service7" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service8" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
            $( "#service9" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
        } );
  </script>
@endsection
