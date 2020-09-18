@extends('admin.admin')

@section('title')
    All Companies Account

@endsection

@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">


@endsection

@section('content')
 <!-- Hero -->
 <div style="background: rgb(255, 255, 255, 0.8)">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h5">
                Companies Register
            </h1>
            <span class="ml-md-auto">

            <a style="margin-top: -15px;" href="{{route('company.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle mr-1"></i>Add New Company Account</a>
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
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th class="text-center" style="font-size: 14px; width: 12%;">S/no</th>
                        <th style="width: 20%">Name </th>
                        <th style="width: 17%">Address</th>
                        <th style="width: 16%;">Phone</th>
                        <th style="width: 15%;">Reg. Type</th>
                        <th style="width: 20%;">Number Enrolled</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $item)


                    <tr>
                        <td class="text-center" style="font-size: 16px">{{$loop->iteration}}</td>
                        <td class="font-w600 font-size-sm">
                        <a href="{{route('company.show',$item->id)}}" style="font-size: 16px">{{$item->organisation_name}}</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm" style="font-size: 16px">
                            {{$item->address}}
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm" style="font-size: 16px">
                            {{$item->contact_phone}}
                        </td>
                        <td class="d-none d-sm-table-cell" style="font-size: 16px">
                            {{$item->registrationType->name}}
                        </td>
                        <td>
                            <em class="text-muted font-size-sm" style="font-size: 16px">{{$item->enrolment_count}}</em>
                        </td>
                        <td>

                            @role('super-admin')
                            <a href="{{route('company.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>Edit Company
                            </a>
                            <form action="{{route('company.destroy', $item->id)}}" method="POST" >
                                @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="delete" type="submit"><i class="fa fa-times text-danger ml-auto"></i> Delete</button>
                                </form>
                                @endrole
                            @if ($item->enrolment_count <= $item->registrationType->max_enrollment)
                                <a href="{{route('company.enroll', $item->id)}}" class="btn btn-info">Enroll members</a>
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
            $('tbody tr:nth-child(odd)').addClass("bg-info-light");
        });
    </script>
@endsection
