@extends('admin.admin')
@section('title')
    Filter payables
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection
@section('content')
<div class="content">
    <div class="block">
    <div class="block-header bg-success-light">
    <h3 class="block-title"> Search payables for {{ $supplier->name}}</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="block block-fx-pop">
            <div class="block-header bg-city"></div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-4 border border-right border-2x">
                            <div class="block-header bg-amethyst-light">
                                <h3 class="block-title">Search By date</h3>
                            </div>
                            <form action="{{route('payables.filter')}}" method="post">
                                @csrf
                                <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                                <div class="form-group">
                                    <label for="date">Enter Date</label>
                                    <div class="form-group">
                                        <input type="text" class="js-datepicker form-control" id="example-datepicker3" name="date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button>
                            </form>
                        </div>
                        @php
                            $years = DB::table('supplier_payables')->select(DB::raw('YEAR(created_at) AS year'))->distinct()->get();
                        @endphp
                        <div class="col-md-4 border border-right border-2x bg-primary-lighter">
                            <div class="block-header bg-smooth-light">
                                <h3 class="block-title">Search By Year</h3>
                            </div>
                        <form action="{{route('payables.filter')}}" method="post">
                                @csrf
                                <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
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
                            <form action="{{route('payables.filter')}}" method="post">
                                @csrf
                                <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                                <div class="form-group">
                                    <label for="">Date Range</label>
                                    <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
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
        @isset($results)
           <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th>
                            S/No
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Details
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Action
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)

                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->created_at->format('d/M/Y H:i A')}}
                        </td>
                        <td>
                            <a href="{{route('recieveorder.show', $item->received_order_id)}}">
                                {{$item->details}}</a>
                        </td>
                        <td class="text-right">
                            {{number_format($item->amount_to_be_paid, 2, '.', ',')}}
                        </td>
                        <td>
                            <button class="btn btn-sucess"><i class="fa fa-paper-plane"></i> pay</button>
                        </td>
                    </tr>


                    @endforeach
                </tbody>
                <tfoot class="bg-success-light">
                    <th colspan="3">Total</th>
                    <th class="text-right"> ₦ {{number_format($results->sum('amount_to_be_paid'), 2, '.', ',')}}</th>
                    <th></th>
                </tfoot>

            </table>
            </table>
        </div>
        @endisset


    </div>
</div>
</div>
@endsection
@section('foot_js')
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
