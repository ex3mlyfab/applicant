@extends('admin.admin')

@section('title')
    All patients

@endsection

@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">


@endsection

@section('content')
 <!-- Hero -->
 <div class="" style="background: rgb(255, 255, 255, 0.8)">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h5">
                Registered Patient (INDIVIDUAL)
            </h1>
            <span class="ml-md-auto">
            <a style="margin-top: -15px;" href="{{route('patient.create')}}" class="btn btn-sm btn-primary" style="font-size: 13px;"><i style="font-size: 15px" class="fa fa-plus-circle"></i> Add New Patient</a>
            </span>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
     <!-- Dynamic Table with Export Buttons -->
     <div style="background: transparent" class="block pentacare-bg">
        <div class="block-header">
             </div>
        <div class="block-content block-content-full pentacare-bg">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table style="background: transparent" class="table table-bordered pentacare-bg table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th class="text-center" style="font-size: 14px; width: 18%;">Folder Number</th>
                        <th style="width: 23%">Full Name </th>
                        <th>Picture</th>
                        <th style="width: 17%">sex</th>
                        <th style="width: 10%;">Age</th>
                        <th style="width: 15%;">Last visit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)


                    <tr>
                        <td class="text-center" style="font-size: 16px">{{$patient->folder_number}}</td>
                        <td class="font-w600 font-size-sm">
                            <a href="{{route('patient.show',$patient->id)}}" style="font-size: 16px">{{$patient->full_name}}</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                        <img style="height: 90px; width: 90px; border-radius: 5px" src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="{{$patient->full_name}}">

                        </td>
                        <td style="font-size: 18px">
                            {{$patient->sex}}
                        </td>
                        <td style="font-size: 16px">
                            {{$patient->age}}
                        </td>
                        <td>
                            <em style="font-size: 20px" class="text-muted font-size-sm">{{$patient->last_visit}}</em>
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
           $(function(){
            $('tbody tr:nth-child(odd)').addClass("bg-default-light");
           });
       </script>

@endsection
