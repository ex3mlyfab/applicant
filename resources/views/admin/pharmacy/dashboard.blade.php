@extends('admin.admin')

@section('title')
    Pharmacy
@endsection

@section('content')
     <!-- Hero -->
     <div class="bg-image overflow-hidden" style="background-image: url('{{ asset('backend')}}/assets/media/photos/photo3@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-2 mb-1 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Pharmacy</h2>
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
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('drug.index')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="fa fa-capsules mr-2"></i> Total Items</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$total_items->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('pharmacy.dispensed')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                           <i class="far fa-thumbs-up mr-2"></i> Dispensed Today</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$dispensed->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{route('dispense.drugs')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="fa fa-hourglass-half mr-2"></i>    Pending</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$awaiting->count()}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)" data-toggle="modal" data-target="#one-modal-apps">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-danger">
                        <i class="fa fa-exclamation-triangle mr-2"></i>    Attention
                    </div>
                        <div class="font-size-h2 font-w400 text-dark">{{
                         $reorder->count() + $minlevel->count() + $maxlevel->count() + $expired->count()
                        }}</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Stats -->

        <!-- Dashboard Charts -->
        <div class="row">
            <div class="col-lg-4">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header">
                        <h3 class="block-title">Activities</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content p-0 bg-body-light text-center">
                         <!-- Inbox Side Navigation -->
                         <div id="one-inbox-side-nav" class="d-none d-md-block push">
                            <!-- Inbox Menu -->
                            <div class="block">

                                <div class="block-content">
                                    <ul class="nav nav-pills flex-column font-size-sm push">
                                        <li class="nav-item my-1">
                                        <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('dispense.drugs')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-mortar-pestle mr-1"></i> Pending Request
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$awaiting->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('drug.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-pills mr-1"></i> Drug list
                                                </span>
                                            <span class="badge badge-pill badge-secondary">{{$total_items->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('pharmacy.dispensed')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-thumbs-up mr-1"></i> Dispensed
                                                </span>
                                                <span class="badge badge-pill badge-secondary">{{$dispensed->count()}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('purchaseOrder.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-pencil-alt mr-1"></i> Make Purchase Order
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('drugclass.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-folder mr-1"></i> Drug Categories
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('recieveorder.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-dolly-flatbed mr-1"></i> Receive order
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('stockreport.view')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-file-invoice mr-1"></i> Stock Report
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('stockcart.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-file-import mr-1"></i> Stock Carts (Emergency/Nursing/Theatre)
                                                </span>
                                                <span class="badge badge-pill badge-secondary"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item my-1">
                                            <a class="nav-link d-flex justify-content-between align-items-center" href="{{route('emergencycart.index')}}">
                                                <span>
                                                    <i class="fa fa-fw fa-file-import mr-1"></i> Check Cart (Emergency)
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
                    <div class="block-header">
                        <h3 class="block-title">Sales BREAKDOWN</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content p-0 bg-body-light text-center">
                        <!-- Chart.js is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _es6/pages/be_pages_dashboard.js) -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <div class="pt-3" style="height: 360px;"><canvas class="js-chartjs-dashboard-sales"></canvas></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END Dashboard Charts -->

        <!-- Customers and Latest Orders -->
        <div class="row row-deck">
            <!-- Latest Customers -->
            <div class="col-lg-6">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Latest Patients</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700" style="width: 80px;">F/No</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 100px;">Photo</th>
                                    <th class="font-w700">Name</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awaiting5 as $item)
                                  <tr>
                                    <td>
                                    <span class="font-w600">{{$item->encounter->user->folder_number}}</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <img class="img-avatar img-avatar32" src="{{asset('backend')}}/images/avatar/{{$item->encounter->user->avatar}}" alt="{{$item->encounter->user->full_name}}" alt="">
                                    </td>
                                    <td class="font-w600">
                                        {{$item->encounter->user->full_name}}                               </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        @if(($item->status=='invoice generated'))
                                        <a href="{{route('pharmreq.review', $item->id)}}">review Prescription</a>
                                        @elseif (($item->status == 'item paid'))

                                            <a href="{{route('pharmacy.dispensedrug',$item->id )}}" class="btn btn-sm btn-primary">Dispense Drugs</a>

                                        @endif
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Latest Customers -->

            <!-- Latest Orders -->
            <div class="col-lg-6">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Latest Dispenses</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700">S/no</th>
                                    <th class="d-none d-sm-table-cell font-w700">Date</th>
                                    <th class="font-w700">Drug</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Qty left</th>
                                    <th class="font-w700 text-center" style="width: 60px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="font-w600">#07835</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <span class="font-size-sm text-muted">today</span>
                                    </td>
                                    <td>
                                        <span class="font-w600 text-warning">Pending..</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-right">
                                        $999,99
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Latest Orders -->
        </div>
        <!-- END Customers and Latest Orders -->
            </div>
        </div>

    </div>
     <!-- Opens from the modal toggle button in the header -->
     <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Attention</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row gutters-tiny">

                            <div class="col-6">
                                <!-- CRM -->
                                <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-bell fa-2x text-white-75"></i>
                                        <p class="font-w600 badge badge-default">
                                          {{$reorder->count()}}  Reorder level exceeded
                                        </p>
                                        @foreach ($reorder as $item)
                                        <p class="text-white mb-1">{{$loop->iteration}}.{{$item->name}}-{{$item->reorder_level}}/{{$item->available}}</p>
                                        @endforeach
                                    </div>
                                </a>
                                <!-- END CRM -->
                            </div>


                            <div class="col-6">
                                <!-- Products -->
                                <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="fa fa-exclamation-triangle fa-2x text-white-75"></i>
                                        <p class="font-w600 badge badge-danger">
                                           {{ $minlevel->count()}}  Minimum level exceeded</p>
                                             @foreach ($minlevel as $item)
                                             <p class="text-white mb-1">{{$loop->iteration}}.{{$item->name}}-{{$item->minimum_level}}/{{$item->available}}</p>
                                             @endforeach

                                    </div>
                                </a>
                                <!-- END Products -->
                            </div>
                            @if ($expired->count())
                            <div class="col-6">
                                <!-- Sales -->
                                <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-plane fa-2x text-white-75"></i>
                                        <p class="font-w600 badge badge-success">
                                            Expired Batches.</p>
                                            @foreach ($expired as $item)
                                        <p class="text-white mb-1">{{$loop->iteration}}.{{$item->name}}</p>
                                            @endforeach

                                    </div>
                                </a>
                                <!-- END Sales -->
                            </div>
                            @endif

                            <div class="col-6">
                                <!-- Payments -->
                                <a class="block block-rounded block-themed bg-warning mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-target fa-2x text-white-75"></i>
                                        <p class="font-w600 badge badge-warning">
                                          {{$maxlevel->count()}} Maximum level exceeded</p>
                                           @foreach ($maxlevel as $item)
                                            <p class="text-white mb-1">{{$loop->iteration}}.{{$item->name}}-{{$item->maximum_level}}/{{$item->available}}</p>
                                            @endforeach

                                    </div>
                                </a>
                                <!-- END Payments -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Apps Modal -->
    <!-- END Page Content -->
@endsection
@section('foot_js')
    <script src="{{asset('backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>
@endsection
