@extends('admin.admin')

@section('title')
    All Family Account

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
                Family Account
            </h1>
            <div class="block-option">
                <a href="{{route('patient-statistics.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                <a  href="{{route('family.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle mr-1"></i>Add New Family Account</a>
            </div>
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
                        <th style="width: 23%"> Anchor Person Name </th>
                        <th>Picture</th>
                        <th style="width: 17%">No enrolled</th>
                        <th style="width: 16%;">account type</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($families as $family)


                    <tr>
                        <td class="text-center" style="font-size: 16px">{{$family->folder_number}}</td>
                        <td class="font-w600 font-size-sm">
                        <a href="{{route('family.show', $family->id)}}" style="font-size: 16px">
                            {{ $family->users->first()->full_name}}
                        </a>

                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                        <img style="height: 90px; width: 90px; border-radius: 5px" src="{{asset('backend')}}/images/avatar/{{$family->users->first()->avatar}}" alt="{{$family->users->first->full_name}}">

                        </td>
                        <td style="font-size: 18px">
                            {{$family->enrolment_count}}/{{$family->registrationType->max_enrollment}}
                        </td>
                        <td style="font-size: 18px">
                            {{$family->registrationType->name}}
                        </td>
                        <td>
                        @role('super-admin')
                        <form action="{{route('family.destroy', $family->id)}}" method="POST" >
                            @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete family" type="submit" onsubmit="confirm()"><i class="fa fa-times text-danger ml-auto"></i> Delete</button>
                            </form>
                        @endrole
                            @if ($family->enrolment_count <= $family->registrationType->max_enrollment)
                                <a href="{{route('family.enroll', $family->id)}}" class="btn btn-info">Enroll members</a>
                            @endif

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
            $('tbody tr:nth-child(odd)').css("background-color", "rgba(202, 247, 228, 0.2)");
        });
       </script>

@endsection
