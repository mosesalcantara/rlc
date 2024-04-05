<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLC Residences | Leasing - @yield('title')</title>

    @section('links')
        <!-- Custom fonts for this template-->
        <link href="{{ asset('vendor/admin/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="{{ asset('css/admin/sb-admin-2.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css"/>

        <link rel="stylesheet" href="{{ asset('css/admin/styles.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @show
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        @section('sidebar')
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon">
                        <div class="sidebar-brand-text">RLC Admin</div>
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ Request::url() == url('/admin') ? 'active' : '' }}">
                    <a class="nav-link" href="/admin">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/videos'), url('/admin/reviews'), url('/admin/contact'), url('/admin/inquiry_emails'), url('/admin/about'), url('/admin/articles') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Home Page</h6>
                            <a class="collapse-item" href="/admin/videos">Videos</a>
                            <a class="collapse-item" href="/admin/reviews">Reviews</a>
                            <h6 class="collapse-header">Contact Us Page</h6>
                            <a class="collapse-item" href="/admin/contact">Items</a>
                            <h6 class="collapse-header">About Us Page</h6>
                            <a class="collapse-item" href="/admin/about">Items</a>
                            <a class="collapse-item" href="/admin/articles">Articles</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Entities
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/properties'), url('/admin/pictures'), url('/admin/buildings'), url('/admin/amenities') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperties"
                        aria-expanded="true" aria-controls="collapseProperties">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Properties</span>
                    </a>
                    <div id="collapseProperties" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/properties">Properties</a>
                            <a class="collapse-item" href="/admin/pictures">Pictures</a>
                            <a class="collapse-item" href="/admin/buildings">Buildings</a>
                            <a class="collapse-item" href="/admin/amenities">Amenities</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/sale'), url('/admin/sale_snapshots'), url('/admin/sale_unit_videos') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSaleUnits"
                        aria-expanded="true" aria-controls="collapseSaleUnits">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>For Sale</span>
                    </a>
                    <div id="collapseSaleUnits" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/sale">Units</a>
                            <a class="collapse-item" href="/admin/sale_snapshots">Snapshots</a>
                            <a class="collapse-item" href="/admin/sale_unit_videos">Unit Videos</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/residential'), url('/admin/snapshots'), url('/admin/unit_videos') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResidential"
                        aria-expanded="true" aria-controls="collapseResidential">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Residential Units</span>
                    </a>
                    <div id="collapseResidential" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/residential">Units</a>
                            <a class="collapse-item" href="/admin/snapshots">Snapshots</a>
                            <a class="collapse-item" href="/admin/unit_videos">Unit Videos</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ Request::url() == url('/admin/commercial') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommercial"
                        aria-expanded="true" aria-controls="collapseCommercial">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Commercial Units</span>
                    </a>
                    <div id="collapseCommercial" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/commercial">Units</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/parking'), url('/admin/terms') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParking"
                        aria-expanded="true" aria-controls="collapseParking">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Parking Slots</span>
                    </a>
                    <div id="collapseParking" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/parking">Slots</a>
                            <a class="collapse-item" href="/admin/terms">Terms</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ in_array(Request::url(), [ url('/admin/inquiry_emails') ]) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInquiry"
                        aria-expanded="true" aria-controls="collapseInquiry">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Inquiry</span>
                    </a>
                    <div id="collapseInquiry" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/admin/inquiry_emails">Inquiry Emails</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Settings -->
                <li class="nav-item {{ Request::url() == url('/admin/settings') ? 'active' : '' }}">
                    <a class="nav-link" href="/admin/settings">
                        <i class="fas fa-fw fa-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->
        @show

        @section('main')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="/auth/logout" id="logout">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Content Row -->
                        <div class="row">
                            @yield('content')
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; RLC Leasing 2024</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="/auth/logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        @show
    </div>
    <!-- End of Page Wrapper -->

    @section('scripts')
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/admin/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/admin/jquery-easing/jquery.easing.min.js') }}"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/dc08c6c264.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    @show
</body>
</html>