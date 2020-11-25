@extends('admin.admin')

@section('title')Stock Report @endsection

@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header">
        <h3 class="block-title">Stock Report for {{$beginning->format('d-M-Y')}} to {{$end->format('d-M-Y')}}</h3>
            <div class="block-option">
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-binoculars"></i> Filter Stock Report</button>
                <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>

                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>

            </div>
        </div>
        <div class="block-content block content-full">
            <h3 class="block-title text-center bg-info text-white">Stock Report {{$beginning->format('d-M-Y')}} to {{$end->format('d-M-Y')}}</h3>
             <!-- Dynamic Table with Export Buttons -->
             <div class="block">

                <div class="block-content block-content-full">
                    <div class="table-responsive">
                    <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">S/NO</th>
                                <th style="width: 30%;">Item</th>
                                <th>Unit</th>
                                <th style="width: 15%;">Opening Stock</th>
                                <th style="width: 15%;">New Stock</th>
                                <th style="width: 5%;">issued.</th>
                                <th style="width: 15%;">stock balance</th>
                                <th style="width: 15%;">cost Price</th>
                                <th style="width: 15%;">Selling Price</th>
                                <th style="width: 15%;">Closing total</th>
                                <th style="width: 15%;">in-patient</th>
                                <th style="width: 15%;"> Sales Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $stockreports->count(); $i++)
                            <tr>
                                <td>
                                    {{$i+1}}
                                </td>
                                <td>
                                    {{$stockreports[$i]['drug_name']->name}}
                                </td>
                                <td>
                                    {{$stockreports[$i]['drug_name']->forms}}
                                </td>
                                <td>{{$stockreports[$i]['old_stock']}}</td>
                                <td>{{$stockreports[$i]['purchases']}}</td>
                                <td>
                                    {{$stockreports[$i]['issued']}}
                                </td>
                                <td>
                                    {{$stockreports[$i]['drug_name']->available}}
                                </td>
                                <td>
                                    {{$stockreports[$i]['drug_name']->sales_price}}
                                </td>
                                <td>
                                    {{$stockreports[$i]['drug_name']->price}}
                                </td>
                                <td>
                                    {{number_format($stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['drug_name']->available, 2, '.',',')}}
                                </td>
                                <td>
                                    {{number_format($stockreports[$i]['inpatient'], 2, '.',',')}}
                                </td>
                                <td>
                                    {{number_format($stockreports[$i]['sales_total'], 2, '.',',')}}
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="12" class="text-center text-uppercase bg-success-light">Stock summary</th>
                            </tr>

                            <tr>
                                <th colspan="7" class="text-center text-uppercase">Opening Stock:</th>
                                <th colspan="5">₦ {{number_format($totalopening, 2, '.', ',') }}</th>
                            </tr>
                            <tr>
                                <th colspan="7" class="text-center text-uppercase">new Stock:</th>
                                <th colspan="5">₦ {{number_format($totalnew, 2, '.', ',') }}</th>
                            </tr>
                            <tr>
                                <th colspan="7" class="text-center text-uppercase">total Stock:</th>
                                <th colspan="5">₦ {{number_format($totalstock, 2, '.', ',') }}</th>
                            </tr>
                            <tr>
                                <th colspan="7" class="text-center text-uppercase">total sales:</th>
                                <th colspan="5">₦ {{number_format($totalsales, 2, '.', ',') }}</th>
                            </tr>
                            <tr>
                                <th colspan="7" class="text-center text-uppercase">total in-patient:</th>
                                <th colspan="5">₦ {{number_format($totalinpatient, 2, '.', ',') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
            <!-- END Dynamic Table with Export Buttons -->

        </div>


    </div>
</div>
<!-- Normal Block Modal -->
<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Filter stockreports</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="block block-fx-pop">
    <div class="block-header bg-city"></div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-4 border border-right border-2x">
                    <div class="block-header bg-amethyst-light">
                        <h3 class="block-title">Filter by month</h3>
                    </div>
                    <form action="{{route('filter.stock')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="example-datepicker3">Enter Date</label>
                            <div class="form-group">
                                <input type="text" class="js-datepicker form-control" id="example-datepicker3" name="date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button>
                    </form>
                </div>
                @php
                    $years = DB::table('drug_batch_details')->select(DB::raw('YEAR(purchase_date) AS year'))->distinct()->get();
                @endphp
                <div class="col-md-4 border border-right border-2x bg-primary-lighter">
                    <div class="block-header bg-smooth-light">
                        <h3 class="block-title">Search By Year</h3>
                    </div>
                <form action="{{route('filter.stock')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="select_year">SELECT Year</label>
                            <select name="year" id="select_year" class="form-control">
                                <option value="">Select One</option>
                                @foreach ($years as $item)
                            <option value="{{$item->year}}">{{$item->year}}</option>
                                @endforeach
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="block-header bg-amethyst-light">
                        <h3 class="block-title">Search By date range</h3>
                    </div>
                    <form action="{{route('filter.stock')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Date Range</label>
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
</div>


                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>
@endsection
