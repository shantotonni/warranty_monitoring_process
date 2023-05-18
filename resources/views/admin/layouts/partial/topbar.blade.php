<div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span><img src="{{asset('assets/images/aci-logo.png')}}" alt="" height="60" /> </span><i><img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22" /></i>
                    </a>
                </div>
                <nav class="navbar-custom">
                    <ul class="navbar-right list-inline float-right mb-0">
                        
                        <!-- full screen -->
                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen"><i class="mdi mdi-fullscreen noti-icon"></i></a>
                        </li>
                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{asset('assets/images/logout-img.png')}}" alt="logout" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <!-- item-->
                                    <h6 style="text-align: center;color:green;">{{Auth::user()->Name}}</h6>
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="mdi mdi-power text-danger"></i> Logout</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect"><i class="mdi mdi-menu"></i></button>
                        </li>
                </nav>
            </div>
            <!-- Top Bar End -->