<nav id="sidebar" aria-label="Main Navigation" style="background: rgb(51, 70, 128)">
    <!-- Side Header -->
    <div class="content-header" style="background: rgb(51, 70, 128)">
        <!-- Logo -->
    <a class="font-w600 text-dual" href="{{route('admin.dashboard')}}">

            <span class="smini-hide text-center">
                <img src="{{asset('backend')}}/images/pentacare.png" style="width:50px; height: 50px; border-radius: 5px"alt="">
            </span>
        </a>
        <span style="font-size: 35px; font-family: Tangerine" class="pt-1 font-weight-bold">Pentacare</span>
    </div>
    <div class="content-side content-side-full" style="background: rgb(51, 70, 128)">
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
                        <a class="nav-main-link" href="{{route('patient-statistics.index')}}">
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <span class="nav-main-link-name">Registrations</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link {{(Request::path()=='admin/patient/create') ? 'active': ''}}" href="{{route('patient.create')}}">
                                    <span class="nav-main-link-name">Individual Account
                                    </span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('nhis.create')}}">
                                    <span class="nav-main-link-name">NHIS Account</span>
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
            @can('surgical-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-cut"></i>
                    <span class="nav-main-link-name">Operating Theatre</span>
                </a>
                <ul class="nav-main-submenu">

                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('surgicalpatient.index')}}">
                            <span class="nav-main-link-name">awaiting procedure</span>
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

                    <a class="nav-main-link" href="{{route('inpatient.dashboard')}}">
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
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
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('otherprocedure.index')}}">
                            <span class="nav-main-link-name">Minor Procedure</span>
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
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('drug.index')}}">
                            <span class="nav-main-link-name">Drug lists</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-main-link" href="{{route('drugclass.index')}}">
                            <span class="nav-main-link-name">Drug categories</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-main-link" href="{{route('purchaseOrder.index')}}">
                            <span class="nav-main-link-name">Purchase Order</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-main-link" href="{{route('recieveorder.index')}}">
                            <span class="nav-main-link-name">Recieve Order</span>
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
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('bank.index')}}">
                            <span class="nav-main-link-name">Banks</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('banktransfer.index')}}">
                            <span class="nav-main-link-name">Bank Transfers</span>
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
                    <span class="nav-main-link-name">Assets</span>
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
            @can('insurance-view')
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon far fa-address-card"></i>
                    <span class="nav-main-link-name">Insurance</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('insurance.index')}}">
                            <span class="nav-main-link-name">List Insurance</span>
                        </a>
                    </li>
                    <li class="nav-main-item"></li>
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
                            <span class="nav-main-link-name">Charge Categories</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('charge.index')}}">
                            <span class="nav-main-link-name">Charges</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <span class="nav-main-link-name">Ward Settings</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a href="{{route('ward.index')}}" class="nav-main-link">
                                    <span class="nav-main-link-name">Wards</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a href="{{route('floor.index')}}" class="nav-main-link">
                                    <span class="nav-main-link-name">Floors</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a href="{{route('bed.index')}}" class="nav-main-link">
                                    <span class="nav-main-link-name">beds</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a href="{{route('bedtype.index')}}" class="nav-main-link">
                                    <span class="nav-main-link-name">Bed Type</span>
                                </a>
                            </li>

                        </ul>


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
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('supplier.index')}}">
                            <span class="nav-main-link-name">Supplier</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('insuranceCategory.index')}}">
                            <span class="nav-main-link-name">Insurance Category</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('insurance.index')}}">
                            <span class="nav-main-link-name">Insurance</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('mdaccount.index')}}">
                            <span class="nav-main-link-name">MD's Account</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('paymentmode.index')}}">
                            <span class="nav-main-link-name">Add Payment Mode</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('bank.index')}}">
                            <span class="nav-main-link-name">Banks</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan




        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
