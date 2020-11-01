@extends('admin.admin')

@section('title')
    Reception
@endsection

@section('content')
     <!-- Hero -->
     <div class="bg-image overflow-hidden" style="background-image: url('{{ asset('backend')}}/assets/media/photos/photo5@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-2 mb-1 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Reception</h2>
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
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('patient.index')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="fa fa-users mr-2"></i> Total Patients</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$patient->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('inpatient.index')}}">
                    <div class="block-content block-content-full bg-amethyst-lighter">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="fa fa-procedures mr-2"></i> On admission</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$patient->filter(function($item){
                            return $item->admission_status == 1;
                        })->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('clinicalappointment.index')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="fa fa-stethoscope mr-2"></i> Consultation</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$patient->filter(function($item){
                            return $item->current_appointment == 1;
                        })->count()}}</div>
                    </div>
                </a>
            </div>

        </div>
        <!-- END Stats -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header">
                        <h3 class="block-title text-center bg-dark text-white">Patient Account Type Analysis for {{date('Y')}} </h3>

                    </div>
                    <div class="block-content p-0 bg-body-light text-center">
                       <div class="table-responsive rounded">
                           <table class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       @foreach ($statistics as $item)
                                   <th class="{{($loop->iteration%2 !=0)? 'bg-flat-light text-white': ''}}">
                                            {{$item->registrationType->name}}
                                        </th>
                                        @endforeach
                                   </tr>
                                   <tbody>
                                       <tr>
                                           @foreach ($statistics as $item)
                                               <td class="{{($loop->iteration%2 !=0)? 'bg-flat-light text-white': ''}}">
                                                   {{$item->number}}
                                               </td>
                                           @endforeach
                                       </tr>
                                   </tbody>
                               </thead>

                           </table>
                       </div>
                    </div>

                </div>
            </div>
        </div>
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
                                        <a class="nav-link d-flex justify-content-between align-items-center " href="{{route('patient.create')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-user mr-1"></i> Individual Registration
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$patient->filter(function($item){
                                                if(($item->registrationType))
                                                return  $item->registrationType->name == 'individual';
                                            })->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1 bg-smooth-light">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('family.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-users mr-1"></i> Family Account
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$family->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1 bg-flat-light">
                                        <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('company.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-user-tie"></i> Company / Organization Account
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$companycount}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1 bg-modern-light">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('nhis.create')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-user-shield mr-1"></i> HMO Patient Registration
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1 bg-amethyst-light">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('patient.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-user-astronaut mr-1"></i> Patients List
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
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

                    <div class="block-header bg-smooth-light">
                        <h3 class="block-title">Patient Registration For Last 7 days</h3>
                    </div>
                    <div class="block-content block-content-full">
                       <canvas class="js-chartjs-bars" ></canvas>
                    </div>

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
                        <h3 class="block-title">New Patients Registration</h3>
                        <div class="block-options">
                            <a href="{{route('patient.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Patient List</a>
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
                                @foreach ($patient10 as $item)
                                  <tr>
                                    <td>
                                    <span class="font-w600">{{$item->folder_number}}</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <img class="img-avatar img-avatar32" src="{{asset('backend')}}/images/avatar/{{$item->avatar}}" alt="{{$item->full_name}}" alt="">
                                    </td>
                                    <td class="font-w600">
                                        {{$item->full_name}}
                                    </td>
                                    <td class="font-w600">
                                        {{$item->sex}}
                                    </td>
                                    <td class="font-w600">
                                        {{$item->age}}
                                    </td>

                                    <td class="d-none d-sm-table-cell text-center">

                                        <a href="{{route('patient.show', $item->id)}}" class="btn btn-outline-success">View profile</a>

                                    </td>

                                </tr>
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
    <script>
        $(function(){
            var cData = JSON.parse(`<?php echo $weeklychart['weekly_chart']; ?>`);
            new Chart($(".js-chartjs-bars"),{
            type: 'line',
            data: {
                labels: cData.label,
                datasets :[
                    {
                        label: 'Registration',
                        "fill":true,
                        "borderColor":"#D92657",
                        data: cData.registrations
                    }
                ]
            },
            options:{
                legend:{display:false},
                title:{
                    display: true,
                    text: 'Registration for the last 7 days'
                },
                scales: {
                 yAxes: [{
                        ticks: {
                        beginAtZero:true
                            }
                        }]
                },
                elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                }

            }

        });
        });
    </script>
@endsection
