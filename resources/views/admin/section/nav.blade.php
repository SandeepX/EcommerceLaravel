<div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="{{route(auth()->user()->role)}}">
                    <span class="brand">Admin
                        <span class="brand-tip ">Ecommerce</span>
                    </span>
                    <span class="brand-mini">AE</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                           
                            <span></span>{{auth()->user()->name}}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i >   Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <!-- <div>
                        <img src="./assets/img/file.png" width="50px" />
                    </div> -->
                    <div class="admin-info">
                        <div class="font-strong">{{ auth()->user()->name}}</div>
                        <small>{{ucfirst(auth()->user()->role)}}</small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="{{route(auth()->user()->role)}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    
                    <li>
                        <a href="{{route('file-manager')}}"><i class="sidebar-item-icon fa fa-file-image-o"></i>
                            <span class="nav-label">File Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('banner.index')}}"><i class="sidebar-item-icon fa fa-image"></i>
                            <span class="nav-label">Banner Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('category.index')}}"><i class="sidebar-item-icon fa fa-sitemap"></i>
                            <span class="nav-label">Category Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('product.index') }}"><i class="sidebar-item-icon fa fa-shopping-bag"></i>
                            <span class="nav-label">Product Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                            <span class="nav-label">Order Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Pages Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html"><i class="sidebar-item-icon fa fa-comments"></i>
                            <span class="nav-label">Review Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Users Managers</span>
                        </a>
                    </li>

                    
                    
                </ul>
            </div>
        </nav>