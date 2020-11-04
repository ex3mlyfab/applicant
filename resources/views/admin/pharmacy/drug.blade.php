@extends('admin.admin')

@section('title')
    drug list
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
                    <h4 class="block-title text-white">Drugs Inventory</h4>
                    <div class="block-options">
                        <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                        <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New Drug</button>
                </div>
            </div>
                <div class="block-content block-content-full pentacare-bg">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th>Drug Name</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Form</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Strength</th>

            <th class="d-none d-sm-table-cell" style="width: 15%;"><span class="text-success">Maximum Order Level</span>
            <br><span class="text-warning"> Reorder Level</span><br><span class="text-danger">Minimum Order Level</span></th>
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
                    <span class="badge badge-success">{{$drug->maximum_level}}</span><br>
                    <span class="badge badge-warning">{{$drug->reorder_level}}</span><br>
                    <span class="badge badge-danger">{{$drug->minimum_level}}</span>
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
<div class="modal" id="drug-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-md" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Add Drug</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('drug.store')}}" method="post" id="register">
                        @csrf

                        <div class="form-group">
                            <label for="name"> Drug Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="dosage"> Drug Class</label>
                            <select name="drug_class_id" id="dosage" class="form-control form-control-lg">
                                {{ create_option('drug_classes', 'id', 'name') }}
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="drug_form"> Drug Form</label>
                            <select name="forms" id="drug_form" class="form-control form-control-lg">
                                <option value="sachet"> Sachet</option>
                                <option value="tablet"> Tablet</option>
                                <option value="syrup"> Syrup</option>
                                <option value="suspension"> Suspension</option>
                                <option value="capsule"> Capsule</option>
                                <option value="Infusion"> Infusion</option>
                                <option value="Injection"> Injection</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="strength">Strength</label>
                            <input type="text" name="strength" id="strength" class="form-control form-control-lg">
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4 pr-0 bg-info-light">
                                <label for="maximum_level">Maximum Stock Level</label>
                            <input type="number" name="maximum_level" id="maximum_level" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-4">
                                <label for="minimum_level">Minimum Stock Level</label>
                            <input type="number" name="minimum_level" id="minimum_level" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-4 bg-info-light">
                                <label for="reorder_level"> Stock Reorder Level</label>
                                <input type="number" name="reorder_level" id="reorder_level" class="form-control form-control-lg">
                            </div>

                        </div>



                </div>
                <div class="block-content block-content-full text-right border-top">

                    <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-plus mr-1"></i>Add</button>
                </div>
            </form>
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
 <script>
       $(window).on('load', function() {


$('.drugedit').bind('click', function(){
    let  thin = '<input type="hidden" name="_method" value="PATCH">';
    $('#register').attr('action', $(this).data('gate'));
    $('#register').prepend(thin);
    $('#name').val($(this).data('name'));
    $('#drug_class_id').val($(this).data('dosage'));
    $('#form').val($(this).data('form'));
    $('#strength').val($(this).data('strength'));
    $('#maximum_level').val($(this).data('maximum_level'));
    $('#minimum_level').val($(this).data('minimum_level'));
    $('#reorder_level').val($(this).data('reorder_level'));



});

});
 </script>


@endsection
