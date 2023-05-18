<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="{{route('home.index')}}" class="waves-effect"><i class="ti-home"></i> <span>Dashboard</span></a>
                            </li>
                            @if(Auth::user()->RoleId == 2)
                            <li>
                                <a href="{{route('products.index')}}" class="waves-effect"><i class="ti-gift"></i><span>Products</span></a>
                            </li>
                            @endif
                            <!-- <li>
                                <a href="{{route('admin-dashboard.index')}}" class="waves-effect"><i class="ti-gift"></i><span>Admin Dashboard</span></a>
                            </li> -->
                            <li>
                                <a href="{{route('claim-warranty.index')}}" class="waves-effect"><i class="ti-shopping-cart"></i><span>Warranty Claim</span></a>
                            </li>
                            <!-- <li>
                                <a href="{{route('engineer-warranty-claims.index')}}" class="waves-effect"><i class="ti-shopping-cart"></i><span>Engineer Warranty Claim</span></a>
                            </li> -->
                            <li>
                                <a href="javascript:void(0);" class="waves-effect">
                                    <i class="ti-settings"></i>
                                    <span>
                                        Settings <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                    </span>
                                </a>
                                <ul class="submenu">
                                    @if(Auth::user()->RoleId == 2)
                                    <li><a href="{{route('roles.index')}}">Roles</a></li>
                                    <li><a href="{{route('users.index')}}">Users</a></li>
                                    <li><a href="{{route('regions.index')}}">Region</a></li>
                                    <li><a href="{{route('areas.index')}}">Area</a></li>
                                    <li><a href="{{route('user-areas.index')}}">Engineer Area</a></li>
                                    @endif
                                    @if(Auth::user()->RoleId == 2 || Auth::user()->RoleId == 1)
                                    <li><a href="{{route('parts.index')}}">Parts List</a></li>
                                    @endif

                                    <li><a href="{{route('user.change.password.form')}}">Change Password</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->
