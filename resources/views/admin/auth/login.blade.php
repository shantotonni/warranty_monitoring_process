<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 06:43:01 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Warranty Monitoring Process</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body style="background-image: url('images/login-background-image.jpg');">
    
    <div class="wrapper-page">
        <div class="card overflow-hidden account-card mx-3" style="opacity: .9">
            <div class="bg-primary p-4 text-white text-center position-relative">
                <h4 class="font-20 m-b-5">Warranty Monitoring Process</h4>
            </div>
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group" style="opacity: 1">
                        <label for="UserId">User Id</label>
                        <input type="text" class="form-control" id="UserId" name="UserId" placeholder="Enter UserId">
                    </div>
                    <div class="form-group" style="opacity: 1">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="Password" placeholder="Enter password">
                    </div>
                    <div class="form-group row m-t-20" style="opacity: 1">
                        <div class="col-sm-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right" style="opacity: 1">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end wrapper-page -->
    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/waves.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>
<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 06:43:01 GMT -->

</html>