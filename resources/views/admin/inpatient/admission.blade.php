@extends('admin.admin')
@section('title')
    InPatient
@endsection

@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection
@section('content')
<div class="content">
    <div class="block block-fx-pop pentacare-bg">
        <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
            <h3 class="block-title text-white"> Patient List</h3>
        </div>
        <div class="block-content block-content-full">
            <h4 class="font-w400">Pending Admissions List</h4>
                <div class="table-responsive">
                        <table class="table table-stripped table-bordered table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>S/no</th>
                                <th>Name</th>
                                <th>Picture/f-no</th>
                                <th>sex</th>
                                <th>Age</th>
                                <th>status</th>
                                <th>action</th>
                            </thead>
                                <tbody>
                                    @foreach ($onadmission as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{ $item->user->full_name}}
                                        </td>
                                        <td>
                                            <img src="{{ $item->user->avatar ? asset('backend/images/avatar/'. $item->user->avatar) : asset('frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
                                            <span class="badge badge-pill p-2 badge-light">
                                                {{$item->user->folder_number}}
                                            </span>
                                        </td>
                                        <td>
                                            {{$item->user->sex}}

                                        </td>
                                        <td>
                                            {{$item->user->age}}
                                        </td>

                                        <td>
                                            <span class="badge badge-primary"> {{$item->status}}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                            <a type="button" class="btn btn-md btn-outline-secondary text-uppercase takevitals" href="{{route('wardround', $item->id)}}" ><span data-toggle="tooltip" title="Record ward round activities"> <i class="fa fa-fw fa-clipboard"></i>Doctors' Round </span></a>
                                            <a type="button" class="btn btn-md btn-outline-success text-uppercase takevitals" href="{{route('nurseround', $item->id)}}" ><span data-toggle="tooltip" title="Record Nursing round activities"> <i class="fa fa-fw fa-notes-medical"></i>Nurse Round </span></a>

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



@endsection
@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
@endsection
