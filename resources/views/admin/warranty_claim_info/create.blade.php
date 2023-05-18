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
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Warranty Claim Info (SPO) Create</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="container-fluid">
    <form role="form" class="repeater" enctype="multipart/form-data" method="POST" action="{{ route('claim-warranty.store') }}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Warranty Claim Info (SPO)</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('Purpose') ? 'has-error' : '' }}">
                                    <label for="Purpose">Purpose</label>
                                    <select name="Purpose" id="Purpose" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Purpose</option>
                                        <option value="Warranty">For Warranty</option>
                                        <option value="Goodwill">For Goodwill</option>
                                    </select>
                                    @if ($errors->has('Purpose'))
                                    <span class="help-block"><strong>{{ $errors->first('Purpose') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">

                    <!-- /.card-header -->
                    <div class="card-body">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('ProductId') ? 'has-error' : '' }}">
                                    <label for="ProductId">Product </label>
                                    <select name="ProductId" id="ProductId" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->Id }}" @if ($product->Id == old('ProductId')) {{ 'selected' }} @endif">
                                            {{ $product->Name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('ProductId'))
                                    <span class="help-block"><strong>{{ $errors->first('ProductId') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('EngineerId') ? 'has-error' : '' }}">
                                    <label for="EngineerId">Engineer </label>
                                    <select name="EngineerId" id="EngineerId" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="">Select Engineer</option>
                                        @foreach ($engineers as $engineer)
                                        <option value="{{ $engineer->UserId }}" @if ($engineer->UserId == old('EngineerId')) {{ 'selected' }} @endif">
                                            {{ $engineer->engineer->Name }} ( {{$engineer->area->Name}} )
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('EngineerId'))
                                    <span class="help-block"><strong>{{ $errors->first('EngineerId') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerCode') ? 'has-error' : '' }}">
                                    <label for="CustomerCode">CustomerCode</label>
                                    <input name="CustomerCode" type="text" id="CustomerCode" class="form-control" value="{{ old('CustomerCode') }}" required autofocus placeholder="Enter Customer Code">
                                    @if ($errors->has('CustomerCode'))
                                    <span class="help-block"><strong>{{ $errors->first('CustomerCode') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerName') ? 'has-error' : '' }}">
                                    <label for="CustomerName">Customer Name</label>
                                    <input name="CustomerName" type="text" id="CustomerName" class="form-control" value="{{ old('CustomerName') }}" required autofocus placeholder="Enter Customer Name">
                                    @if ($errors->has('CustomerName'))
                                    <span class="help-block"><strong>{{ $errors->first('CustomerName') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('CustomerNumber') ? 'has-error' : '' }}">
                                    <label for="CustomerNumber">Customer Number</label>
                                    <input name="CustomerNumber" type="text" id="CustomerNumber" class="form-control" value="{{ old('CustomerNumber') }}" required autofocus placeholder="Enter Customer Number">
                                    @if ($errors->has('CustomerNumber'))
                                    <span class="help-block"><strong>{{ $errors->first('CustomerNumber') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('ChassisNumber') ? 'has-error' : '' }}">
                                    <label for="ChassisNumber">Chassis Number</label>
                                    <input name="ChassisNumber" type="text" id="ChassisNumber" class="form-control" value="{{ old('ChassisNumber') }}" required autofocus placeholder="Enter Chassis Number">
                                    @if ($errors->has('ChassisNumber'))
                                    <span class="help-block"><strong>{{ $errors->first('ChassisNumber') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('Status') ? 'has-error' : '' }}">
                                    <label for="Status">Status </label>
                                    <select name="Status" id="Status" data-live-search="true" class="form-control select2" style="width: 100%;" autofocus type="select" required>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    @if ($errors->has('Status'))
                                    <span class="help-block"><strong>{{ $errors->first('Status') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div> <!-- /.col-12 -->
        </div>
        <!--row end -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Parts Info</h6>
                    </div>
                    <div class="card-body repeatTable">
                        <div data-repeater-list="group_a" class="repeatRow">
                            <div data-repeater-item class="row">
                                <div class="col-lg-6">
                                    <div class="form-group{{ $errors->has('PartsCode') ? 'has-error' : '' }}">
                                        <label for="PartsCode">Select Parts </label>
                                        <select name="PartsCode" data-live-search="true" onchange="selectedParts(this.value, this)" class="form-control parts-code select2" style="width: 100%;" autofocus type="select" required>
                                            <option value=""></option>
                                            @foreach ($allParts as $part)
                                            <option value="{{ $part->ProductCode }}">{{ $part->ProductCode }} -
                                                {{ $part->ProductName }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('PartsCode'))
                                        <span class="help-block"><strong>{{ $errors->first('PartsCode') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group {{ $errors->has('Quantity') ? 'has-error' : '' }}">
                                        <label for="Quantity">Quantity</label>
                                        <input name="Quantity" type="text" class="form-control" value="{{ old('Quantity') }}" required autofocus placeholder="Enter Quantity">
                                        @if ($errors->has('Quantity'))
                                        <span class="help-block"><strong>{{ $errors->first('Quantity') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group {{ $errors->has('Price') ? 'has-error' : '' }}">
                                        <label for="Price">Price</label>
                                        <input name="Price" type="text" class="form-control price" value="{{ old('Price') }}" required autofocus placeholder="Enter Price">
                                        @if ($errors->has('Price'))
                                        <span class="help-block"><strong>{{ $errors->first('Price') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-2 align-self-center"><input data-repeater-delete type="button" class="btn btn-primary btn-block" value="Delete">
                                </div>

                            </div>
                        </div>
                        <input data-repeater-create type="button" class="btn btn-success mo-mt-2 repeatBtn" value="Add">

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-info btn-flat">Create</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
    document.title = 'Warranty Claim Info | Create';
</script>
<script>
    $(document).ready(function() {
        "use strict";
        $(".repeater").repeater({
                defaultValues: {
                    "textarea-input": "foo",
                    "text-input": "bar",
                    "select-input": "B",
                    "checkbox-input": ["A", "B"],
                    "radio-input": "B",
                },
                show: function() {
                    $(this).slideDown();
                },
                hide: function(e) {
                    confirm("Are you sure you want to delete this element?") &&
                        $(this).slideUp(e);
                },
                ready: function(e) {},
            }),
            (window.outerRepeater = $(".outer-repeater").repeater({
                defaultValues: {
                    "text-input": "outer-default"
                },
                show: function() {
                    console.log("outer show"), $(this).slideDown();
                },
                hide: function(e) {
                    console.log("outer delete"), $(this).slideUp(e);
                },
                repeaters: [{
                    selector: ".inner-repeater",
                    defaultValues: {
                        "inner-text-input": "inner-default"
                    },
                    show: function() {
                        console.log("inner show"), $(this).slideDown();
                    },
                    hide: function(e) {
                        console.log("inner delete"), $(this).slideUp(e);
                    },
                }, ],
            }));
    });
</script>
<script>
    // console.log($('.parts-number').find(":selected").text());
    // $(document).ready(function(){
    function selectedParts(selectedParts, obj) {
        console.log("You have selected the Parts - " + selectedParts);
        $.ajax({
            url: "{{ URL::to('/parts/get-by-parts-code/') }}" + "/" + selectedParts,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                //$(".price").val(response.Price);
                console.log(response[0]);
                obj.parentElement.parentElement.parentElement.children[2].children[0].children[1].value =
                    response[0].UnitPrice;
                //console.log(e);
            }
        });
    }
    // });
</script>

<script>
    // $(document).ready(function(){
    //     $('.parts-number').select2({ 
    //         placeholder: 'Select Parts Number',
    //         allowClear: true,
    //         ajax:{
    //             url: "{{ URL::to('/parts/search-by-parts-number') }}",
    //             type: "post",
    //             dataType: "json",
    //             data: function(params){
    //                 return {
    //                     search: params.term,
    //                     _token: "{{ csrf_token() }}"
    //                 }
    //             },
    //             processResults: function(response){

    //                 return {
    //                     results: response,
    //                 }
    //             },
    //             cache: true,

    //         }
    //     });
    // });
    // $('.parts-name').select2({ });
</script>
<script>
    $('.parts-code').select2({
        placeholder: "Select Parts"
    });
    $(".repeatTable").on('click', '.repeatBtn', function() {
        $('.parts-code').select2({
            placeholder: "Select Parts"
        });

    });
</script>
@endsection