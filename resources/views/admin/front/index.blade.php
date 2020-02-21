@extends('admin.admin')

@section('title')
    All patients

@endsection

@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">


@endsection

@section('content')
 <!-- Hero -->
 <div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Patients Register
            </h1>
            <span class="ml-md-auto">
            <a href="{{route('appointment.create')}}" class="btn btnlg btn-outline-primary"><i class="fa fa-plus mr-1"></i>Add New Patient</a>
            </span>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
     <!-- Dynamic Table with Export Buttons -->
     <div class="block">
        <div class="block-header">

        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">Folder Number</th>
                        <th>Name </th>
                        <th class="d-none d-sm-table-cell">Picture</th>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">sex</th>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">Age</th>
                        <th style="width: 15%;">Last visit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)


                    <tr>
                        <td class="text-center font-size-sm">{{$patient->folder_number}}</td>
                        <td class="font-w600 font-size-sm">
                            <a href="{{route('patient.show',$patient->id)}}">{{$patient->full_name}}</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                        <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="{{$patient->full_name}}" class="img-avatar img-avatar128">

                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{$patient->sex}}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{$patient->age}}
                        </td>
                        <td>
                            <em class="text-muted font-size-sm">{{$patient->last_vist}}</em>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
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

@endsection
