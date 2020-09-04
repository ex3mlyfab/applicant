@extends('admin.admin')
@section('title')
    beds
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header with-border">
                    <h4 class="block-title">beds</h4>
                    <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New bed</button>
                </div>
            </div>
                <div class="block-content block-content-full">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th>bed Number</th>

            <th class="d-sm-table-cell">Bed Type</th>
            <th class="d-sm-table-cell">Ward located</th>
            <th class="d-sm-table-cell">status</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($beds as $bed)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                {{$bed->bed_no}}
                </td>

                <td>
                    {{$bed->bedType->name}}
                </td>
                <td>
                    {{$bed->wardModel->name}}
                </td>
                <td>
                    {{$bed->status}}
                </td>
                <td>
                    <span class="btn-group">
                    <button  class="btn btn-sm btn-primary bededit" data-gate="{{route('bed.update', $bed->id)}}" data-name="{{$bed->bed_no}}" data-dosage="{{$bed->bed_type_id}}" data-floor="{{ $bed->ward_model_id }}"  data-toggle="modal" data-target="#drug-block-normal">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <form action="{{route('bed.destroy', $bed->id)}}" method="POST" >
                            @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                            </form>
                        </span>
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
                    <h3 class="block-title">Add bed</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('bed.store')}}" method="post" id="register">
                        @csrf


                        <div class="form-group">
                            <label for="bed_id"> Bed Type </label>
                            <select name="bed_type_id" id="bed_id" class="form-control form-control-lg">
                                <option value="">Select One</option>
                                {{ create_option('bed_types', 'id', 'name')}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ward_id">Ward</label>
                            <select name="ward_model_id" id="ward_id" class="form-control form-control-lg">
                                <option value="">Select One</option>
                                {{ create_option('ward_models', 'id', 'name')}}
                            </select>
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


 <script>
       $(window).on('load', function() {


        $('.bededit').bind('click', function(){
            let  thin = '<input type="hidden" name="_method" value="PATCH">';
            let bed = '<label>Bed NO:</label><h3 class="display-4">'+ $(this).data('name')+'</h3>';
            $('#register').attr('action', $(this).data('gate'));
            $('#register').prepend(bed);
            $('#register').prepend(thin);

            $('#bed_id').val($(this).data('dosage')).change();
            $('#ward_id').val($(this).data('floor')).change();


        });

});
 </script>


@endsection
