@extends('admin.admin')

@section('title')
    Reception
@endsection

@section('content')
     <!-- Hero -->
     <div class="bg-image overflow-hidden" style="background-image: url('{{ asset('backend')}}/assets/media/photos/photo35@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-2 mb-1 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Inpatient</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content mt-0">
        <div class="block pentacare-bg">
            <div class="block-content block-content-full">
                 <!-- Stats -->
        <div class="row">
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('bed.index')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="fa fa-bed mr-2"></i> Total Bed Space</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$beds->filter(function($item){
                            return $item->status == 'occupied';
                        })->count()}}/{{$beds->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('inpatient.index')}}">
                    <div class="block-content block-content-full bg-amethyst-lighter">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="fa fa-procedures mr-2"></i> On Admission</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$inpatients->filter(function($item){
                            return $item->status != 'discharged';
                        })->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('clinicalappointment.index')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="fa fa-stethoscope mr-2"></i> Pending Admissions</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$admit_request->count()}}</div>
                    </div>
                </a>
            </div>

        </div>
        <!-- END Stats -->

        <!-- Dashboard Charts -->
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="block block-rounded">
                    <div class="block-header bg-success">
                        <h3 class="block-title text-white">Activities</h3>

                    </div>
                    <div class="block-content p-0 bg-body-light text-center">
                         <!-- Inbox Side Navigation -->
                         <div id="one-inbox-side-nav" class="d-none d-md-block push">
                            <!-- Inbox Menu -->
                            <div class="block">

                                <div class="block-content">
                                    <ul class="nav nav-pills flex-column font-size-sm push">
                                        <li class="nav-item my-1 bg-city-light">
                                        <a class="nav-link d-flex justify-content-between align-items-center " href="{{route('inpatient.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-file-medical-alt mr-1"></i> Conduct Ward Round
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$inpatients->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1 bg-smooth-light">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('admitpatient.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-file-medical mr-1"></i> Pending Admission
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$admit_request->count()}}</span>
                                            </a>
                                        </li>





                                    </ul>
                                </div>
                            </div>
                            <!-- END Inbox Menu -->


                        </div>
                        <!-- END Inbox Side Navigation -->
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="block block-rounded block-mode-loading-oneui">



                </div>
            </div>

        </div>
        <!-- END Dashboard Charts -->

        <!-- Customers and Latest Orders -->
        <div class="row row-deck">
            <!-- Latest Customers -->
            <div class="col-lg-12">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">In Patients List</h3>
                        <div class="block-options">
                            <a href="{{route('inpatient.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Patient List</a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700" style="width: 80px;">F/No</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 100px;">Photo</th>
                                    <th class="font-w700">Name</th>
                                    <th class="font-w700">Sex</th>
                                    <th class="font-w700">Age</th>


                                    <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inpatients as $item)
                                    @if ($item->status != 'discharged')
                                        <tr>
                                            <td>
                                            <span class="font-w600">{{$item->user->folder_number}}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center">
                                                <img class="img-avatar img-avatar32" src="{{asset('backend')}}/images/avatar/{{$item->user->avatar}}" alt="{{$item->user->full_name}}" alt="">
                                            </td>
                                            <td class="font-w600">
                                                {{$item->user->full_name}}
                                            </td>
                                            <td class="font-w600">
                                                {{$item->user->sex}}
                                            </td>
                                            <td class="font-w600">
                                                {{$item->user->age}}
                                            </td>

                                            <td class="d-none d-sm-table-cell text-center">
                                                @can('wardround-create')
                                                    <a type="button" class="btn btn-md btn-outline-secondary text-uppercase takevitals" href="{{route('wardround', $item->id)}}" ><span data-toggle="tooltip" title="Record ward round activities"> <i class="fa fa-fw fa-clipboard"></i>Doctors' Round </span></a>
                                                @endcan
                                                @can('nurseround-create')
                                                    <a type="button" class="btn btn-md btn-outline-success text-uppercase takevitals" href="{{route('nurseround', $item->id)}}" ><span data-toggle="tooltip" title="Record Nursing round activities"> <i class="fa fa-fw fa-notes-medical"></i>Nurse Round </span></a>
                                                @endcan




                                            </td>

                                        </tr>
                                    @endif

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Latest Customers -->


        </div>
        <!-- END Customers and Latest Orders -->
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection
@section('foot_js')
    <script src="{{asset('backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>

@endsection
