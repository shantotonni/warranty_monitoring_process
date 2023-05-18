@extends('admin.layouts.master')
@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Parts Import

                    <div class="spinner-border text-primary loading_process" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="loading_process success" style="color:red">Processing Please Do Not Close !!!!!!!!</span>

                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add Parts</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        @if(session()->has('success'))
                        <p class="alert alert-success">
                            {{ session()->get('success') }}
                        </p>
                        @endif
                        {{-- <a href="{{url('/parts/create')}}"><button class="btn btn-sm btn-info float-right btn-flat">Create Parts</button></a> --}}
                    </div>
                    {{-- <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Add Parts</h5>
                                <form class="" id="kpi_master" role="form" method="POST" action="{{route('parts.import')}}" style="width:100%;" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="fileInput">Select File (<span style="color:red;font-size: 12px;">*Format: .xlsx</span>)</label>
                                                <input type="file" name="filename" class="form-control-file" id="fileInput" required>
                                            </div>

                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group" style="margin-top: 30px;">
                                                <button type="submit" class="btn btn-sm btn-info float-left btn-flat">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- row end -->
                    </div> --}}
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

        </div>
        <!--row end -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="row d-flex justify-content-end">

                            <div class="col-lg-4">
                                <form action="{{route('parts.search')}}" method="POST">
                                    @csrf
                                    <div class="row" style="margin-right: -50px;">
                                        <div class="col-sm-8">
                                            <div class="form-group small">
                                                <label for="searchInput">Search</label>
                                                <input type="text" class="form-control form-control-sm" name="searchInput" id="searchInput" value="{{$inputs['searchInput']}}" placeholder="Enter Parts Code/Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" style="margin-top: 30px;">
                                                <button type="submit" class="btn btn-sm btn-success float-left btn-flat"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body table-responsive text-nowrap">
                        <table id="parts_table" class="table table-bordered small table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Parts Code</th>
                                    <th scope="col">Parts Name</th>
                                    <th scope="col">Price</th>
                                    {{-- <th scope="col">Controls</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parts as $part)
                                <tr>
                                    <td class="text-left">{{$loop->index+1}}</td>
                                    <td class="text-left">{{$part->ProductCode}}</td>
                                    <td class="text-left">{{$part->ProductName}}</td>
                                    <td class="text-left">{{$part->UnitPrice}}</td>

                                    {{-- <td> --}}
                                        {{-- <a href="{{url('/parts/'.$part->Id)}}" title="Show" ><button type="button" class="btn btn-xs btn-primary btn-flat"><i class="fas fa-eye" aria-hidden="true"></i></button></a> --}}
                                        {{-- <a href="{{url('/parts/edit/'.$part->Id)}}" title="Edit"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fas fa-edit"></i></button></a> --}}
                                        {{-- <a id="openDeleteModal" data-toggle="modal" data-id="{{$part->Id}}" title="Delete"  href=""><button type="button" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash" aria-hidden="true"></i></button></a> --}}
                                    {{-- </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right mt-3">
                            {{-- <p>{{$parts->links()}}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

@endsection


@section('scripts')
<script>
    document.title = 'Parts | List';
    $('.loading_process').hide();
</script>

<script>
    $(document).ready(function() {
        $('#parts_table').DataTable();
    });
</script>
@endsection