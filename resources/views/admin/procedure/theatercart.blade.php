@extends('admin.admin')

@section('title')
    Theatre Cart
@endsection

@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="block pentacare-bg">
                <div class="block-header with-border" style="background: rgb(51, 70, 128, 0.8)">
                    <h4 class="block-title text-white">Theatre Inventory</h4>
                    <div class="block-options">
                        <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                        <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New Drug</button>
                </div>
            </div>
                <div class="block-content block-content-full pentacare-bg">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th> Name</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Form</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Strength</th>

            <th class="d-none d-sm-table-cell" style="width: 15%;"><span>Reorder Level</span></th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Quantity Available</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drugs as $drug)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                <a href="{{route('drug.show', $drug->id)}}">{{$drug->name}}</a>
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->forms}}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->strength}}
                </td>

                <td class="d-none d-sm-table-cell text-center">
                    <span class="badge badge-warning">{{$drug->reorder_level}}</span><br>
                </td>
                <td>
                    {{$drug->available}}
                </td>
                <td>
                    <div class="btn-group">
                        <button  class="btn btn-sm btn-primary drugedit" data-gate="{{route('drug.update', $drug->id)}}"
                        data-subcategory="{{$drug->drugClass->id}}"
                        data-name="{{$drug->name}}" data-form="{{$drug->forms}}"  data-strength="{{$drug->strength}}" data-maximum_level="{{$drug->maximum_level}}" data-minimum_level="{{$drug->minimum_level}}" data-reorder_level="{{$drug->reorder_level}}" data-toggle="modal" data-target="#drug-block-normal" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
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
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>


@endsection
