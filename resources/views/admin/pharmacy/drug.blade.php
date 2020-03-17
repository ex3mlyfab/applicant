@extends('admin.admin')
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header with-border">
                    <h4 class="block-title">Drugs Inventory</h4>
                    <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New Drug</button>
                </div>
            </div>
                <div class="block-content block-content-full">

<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width: 5%;">S/No</th>
            <th>Drug Name</th>
            <th class="text-center" style="width: 15%;">Drug Category/Subcategory</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Form</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Strength</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Dosage</th>
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

                <td class="d-none d-sm-table-cell font-size-sm">
                    {{ $drug->drugSubCategory->drugCategory->name }} / {{ $drug->drugSubCategory->name }}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->forms}}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->strength}}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->dosage}}
                </td>
                <td class="d-none d-sm-table-cell text-center">

                </td>
                <td>
                    <div class="btn-group">

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
                <form action="{{route('drug.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="drug_id">Drug Category</label>
                            <select id="drug_id" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one.." >
                                <option></option>
                                {{create_option('drug_categories','id', 'name')}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub_category">Drug Sub Category</label>
                            <select name="drug_sub_category_id" id="sub_category" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one.." >
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name"> Drug Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="dosage"> Dosage </label>
                            <input type="text" name="dosage" id="dosage" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="form"> Drug Form</label>
                            <input type="text" name="forms" id="form" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="strength">Strength</label>
                            <input type="text" name="strength" id="strength" class="form-control form-control-lg">
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
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('public/backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>
 <script>
       $(window).on('load', function() {
        $('#drug_id').on('change', function(){
 var classID = $(this).val();
 var link = "{{ url('admin/drug/drugcategoryajax/') }}";

 console.log(classID, link);
 if(classID) {
    $.ajax({
        url: link+"/"+classID,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#sub_category').empty();
                $.each(data, function(key, value) {

                    $('#sub_category').append(
                        '<option value="'+ key +'">'+ value +'</option>');
                });
            }
            });

            }else{
                $('select[name="sub_category1"]').empty();
                 }

 });


});
 </script>


@endsection
