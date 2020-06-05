<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="index.html">

            <span class="smini-hide text-center">
                <img src="{{asset('public/backend')}}/images/pentacare.png" style="width:70px;"alt="">
            </span>
        </a>
        <!-- END Logo -->

        <!-- Options -->
        <div>
            <!-- Color Variations -->
            <div class="dropdown d-inline-block ml-3">
                <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="si si-drop"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">

                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">
                        <span>Default</span>
                        <i class="fa fa-circle text-default"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('public/backend')}}/assets/css/themes/amethyst.min.css" href="#">
                        <span>Amethyst</span>
                        <i class="fa fa-circle text-amethyst"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('public/backend')}}/assets/css/themes/city.min.css" href="#">
                        <span>City</span>
                        <i class="fa fa-circle text-city"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('public/backend')}}/assets/css/themes/flat.min.css" href="#">
                        <span>Flat</span>
                        <i class="fa fa-circle text-flat"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('public/backend')}}/assets/css/themes/modern.min.css" href="#">
                        <span>Modern</span>
                        <i class="fa fa-circle text-modern"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('public/backend')}}/assets/css/themes/smooth.min.css" href="#">
                        <span>Smooth</span>
                        <i class="fa fa-circle text-smooth"></i>
                    </a>
                    <!-- END Color Themes -->

                    <div class="dropdown-divider"></div>

                    <!-- Sidebar Styles -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">
                        <span>Sidebar Light</span>
                    </a>
                    <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                        <span>Sidebar Dark</span>
                    </a>
                    <!-- Sidebar Styles -->

                    <div class="dropdown-divider"></div>

                    <!-- Header Styles -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">
                        <span>Header Light</span>
                    </a>
                    <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">
                        <span>Header Dark</span>
                    </a>
                    <!-- Header Styles -->
                </div>
            </div>
            <!-- END Themes -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Options -->
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
            <a class="nav-main-link" href="{{route('admin.dashboard')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            @can('appointment-create')
               <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">Reception</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <span class="nav-main-link-name">Registrations</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('patient.create')}}">
                                    <span class="nav-main-link-name">Individual Account</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('family.create')}}">
                                    <span class="nav-main-link-name">Family Account</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('company.create')}}">
                                    <span class="nav-main-link-name">Organisation/Society</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('patient.index')}}">
                            <span class="nav-main-link-name">Patients list</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('family.index')}}">
                            <span class="nav-main-link-name">Family Accounts</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('company.index')}}">
                            <span class="nav-main-link-name">Organization Accounts</span>
                        </a>
                    </li>



                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('clinicalappointment.index')}}">
                            <span class="nav-main-link-name">Book consultation</span>
                        </a>
                    </li>

                </ul>

            </li>
            @endcan
            @can('consult-create')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-stethoscope"></i>
                    <span class="nav-main-link-name">Outpatient Consultation</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('consults.index')}}">
                            <span class="nav-main-link-name">Patient List</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('nursing-view')
                <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-procedures"></i>
                    <span class="nav-main-link-name">Inpatient </span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('admitpatient.index')}}">
                            <span class="nav-main-link-name">New Admission</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('inpatient.index')}}">
                            <span class="nav-main-link-name">Admission</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('nursing-view')
                <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-file-medical-alt"></i>
                    <span class="nav-main-link-name">Nursing Station</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('nursing.index')}}">
                            <span class="nav-main-link-name">Record Vital Signs</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
           @can('expense-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-book-open"></i>
                    <span class="nav-main-link-name">Expenses</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('expense.index')}}">
                            <span class="nav-main-link-name">Expenses</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('expensehead.index')}}">
                            <span class="nav-main-link-name">Expenses Head</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('pharmacy-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-pills"></i>
                    <span class="nav-main-link-name">Pharmacy</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('pharmacy.index')}}">
                            <span class="nav-main-link-name">Dispense Drugs</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('drug.index')}}">
                            <span class="nav-main-link-name">Drug lists</span>
                        </a>
                    </li>
                    <a class="nav-main-link" href="{{route('drugcategory.index')}}">
                            <span class="nav-main-link-name">Drug categories</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('payment-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-book"></i>
                    <span class="nav-main-link-name">Revenue Section</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('invoice.index')}}">
                            <span class="nav-main-link-name">Pending Payment</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('payment.index')}}">
                            <span class="nav-main-link-name">payments lists</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('balance')}}">
                            <span class="nav-main-link-name">Balance</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('user-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">Human Resources</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('user.index')}}">
                            <span class="nav-main-link-name">All Employees list</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('user.create')}}">
                            <span class="nav-main-link-name">Add new Users</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('role.index')}}">
                            <span class="nav-main-link-name">Roles</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('permission.index')}}">
                            <span class="nav-main-link-name">Permissions</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('laboratory-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-microscope"></i>
                    <span class="nav-main-link-name">Laboratories</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('haematology.index')}}">
                            <span class="nav-main-link-name">Haematology</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('microbiology.index')}}">
                            <span class="nav-main-link-name">Microbiology</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('microbiology.index')}}">
                            <span class="nav-main-link-name">Histology</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan
            @can('radiology-view')
             <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-x-ray"></i>
                    <span class="nav-main-link-name">Radiology</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('haematology.index')}}">
                            <span class="nav-main-link-name">X-ray</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('haematology.index')}}">
                            <span class="nav-main-link-name">Ultrasound</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('assetcategory-view')
               <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-file-invoice"></i>
                    <span class="nav-main-link-name">Inventory</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('assetcategory.index')}}">
                            <span class="nav-main-link-name">Asset categories</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('asset.index')}}">
                            <span class="nav-main-link-name">Assets</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('regtype.index')}}">
                            <span class="nav-main-link-name">Asset Assignments</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('regtype.index')}}">
                            <span class="nav-main-link-name">Asset purchases</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan
            @can('system-view')
               <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-cog"></i>
                    <span class="nav-main-link-name">System Settings</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('chargecategory.index')}}">
                            <span class="nav-main-link-name">charge categories</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('charge.index')}}">
                            <span class="nav-main-link-name">charges</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('regtype.index')}}">
                            <span class="nav-main-link-name">Registration type</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('purpose.index')}}">
                            <span class="nav-main-link-name">Visitor Purpose type</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan




        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
