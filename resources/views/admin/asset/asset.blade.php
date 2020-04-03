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
                    <h4 class="block-title">assets Inventory</h4>
                    <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#asset-block-normal"> Add New asset</button>
                </div>
            </div>
                <div class="block-content block-content-full">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th>Asset Name</th>
            <th class="text-center" style="width: 15%;">Asset Category</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Asset Status</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Asset quantity</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assets as $asset)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                <a href="{{route('asset.show', $asset->id)}}">{{$asset->name}}</a>
                </td>

                <td class="d-none d-sm-table-cell font-size-sm">
                    {{ $asset->assetCategory->name }}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$asset->status}}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$asset->available}}
                </td>

                <td>
                    <div class="btn-group">
                        <button  class="btn btn-sm btn-primary assetedit" data-gate="{{route('asset.update', $asset->id)}}"
                        data-asset_id="{{$asset->assetCategory->id}}"
                        data-name="{{$asset->name}}" data-unit="{{$asset->unit}}" data-picture="{{$asset->picture}}" data-toggle="modal" data-target="#asset-block-normal" title="Edit">
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
<div class="modal" id="asset-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-md" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Add asset</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('asset.store')}}" method="post" id="register" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="asset_id">asset Category</label>
                            <select id="asset_id" name="asset_category_id" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one.." required>
                                <option></option>
                                {{create_option('asset_categories','id', 'name', )}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name"> Asset Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="dosage"> Unit </label>
                            <input type="text" name="unit" id="dosage" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="form"> asset Form</label>
                            <input type="file" name="picture" id="form" class="form-control-file form-control-lg">
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


$('.assetedit').on('click', function(){
    let  thin = '<input type="hidden" name="_method" value="PATCH">';
    $('#register').attr('action', $(this).data('gate'));
    $('#register').prepend(thin);
    $('#name').val($(this).data('name'));
    $('#asset_id').val($(this).data('asset_id')).change();
    $('#dosage').val($(this).data('unit'));
    $('#form').val($(this).data('picture'));



});

});
 </script>


@endsection
