<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partial.header')
    <style>
        .nav-user img {
            height: 28px;
            width: 36px;
        }

    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('admin.layouts.partial.topbar')
        @include('admin.layouts.partial.sidebar')

        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @section('main-content')
            @show
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        @include('admin.layouts.partial.footer')
</body>

</html>