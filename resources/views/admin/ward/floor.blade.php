@extends('admin.admin')
@section('title')
    Floors
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header with-border">
                    <h4 class="block-title">Floors</h4>
                    <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#drug-block-normal"> Add New Floor</button>
                </div>
            </div>
                <div class="block-content block-content-full">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th>Floor Name</th>

            <th class="d-none d-sm-table-cell" style="width: 20%;">Description</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($floors as $floor)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                {{$floor->name}}
                </td>

                <td>
                    {{$floor->description}}
                </td>
                <td>
                    <span class="btn-group">
                        <button  class="btn btn-sm btn-primary flooredit" data-gate="{{route('floor.update', $floor->id)}}"

                        data-name="{{$floor->name}}" data-dosage="{{$floor->description}}"  data-toggle="modal" data-target="#drug-block-normal">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <form action="{{route('floor.destroy', $floor->id)}}" method="POST" >
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
                    <h3 class="block-title">Add Floor</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('floor.store')}}" method="post" id="register">
                        @csrf

                        <div class="form-group">
                            <label for="name"> Floor Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="dosage"> Description </label>
                            <input type="text" name="description" id="dosage" class="form-control form-control-lg">
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


 <script>
       $(window).on('load', function() {


        $('.flooredit').bind('click', function(){
            let  thin = '<input type="hidden" name="_method" value="PATCH">';
            $('#register').attr('action', $(this).data('gate'));
            $('#register').prepend(thin);
            $('#name').val($(this).data('name'));
            $('#dosage').val($(this).data('dosage'));


        });

});
 </script>


@endsection
