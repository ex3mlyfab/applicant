@extends('admin.admin')
@section('title')
    wards
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
                    <h4 class="block-title">wards</h4>
                    <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New ward</button>
                </div>
            </div>
                <div class="block-content block-content-full">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th>ward Name</th>

            <th class="d-sm-table-cell">Description</th>
            <th class="d-sm-table-cell">Floor</th>
            <th class="d-sm-table-cell">Max Number Bed</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wards as $ward)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                {{$ward->name}}
                </td>

                <td>
                    {{$ward->description}}
                </td>
                <td>
                    {{$ward->floor->name}}
                </td>
                <td>
                    {{$ward->max_no_of_bed}}
                </td>
                <td>
                    <span class="btn-group">
                    <button  class="btn btn-sm btn-primary wardedit" data-gate="{{route('ward.update', $ward->id)}}" data-name="{{$ward->name}}" data-dosage="{{$ward->description}}" data-floor="{{ $ward->floor_id }}" data-max_bed="{{ $ward->max_no_of_bed }}"  data-toggle="modal" data-target="#drug-block-normal">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <form action="{{route('ward.destroy', $ward->id)}}" method="POST" >
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
                    <h3 class="block-title">Add ward</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('ward.store')}}" method="post" id="register">
                        @csrf

                        <div class="form-group">
                            <label for="name"> ward Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="dosage"> Description </label>
                            <input type="text" name="description" id="dosage" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="floor_id">Floor Location</label>
                            <select name="floor_id" id="floor_id" class="form-control form-control-lg">
                                <option value="">Select One</option>
                                {{ create_option('floors', 'id', 'name')}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="max">Maximum number of beds </label>
                            <input type="number" name="max_no_of_bed" id="max" class="form-control form-control-lg">
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


        $('.wardedit').bind('click', function(){
            let  thin = '<input type="hidden" name="_method" value="PATCH">';
            $('#register').attr('action', $(this).data('gate'));
            $('#register').prepend(thin);
            $('#name').val($(this).data('name'));
            $('#dosage').val($(this).data('dosage'));
            $('#floor_id').val($(this).data('floor')).change();
            $('#max').val($(this).data('max_bed'));

        });

});
 </script>


@endsection
