@extends('admin.admin')

@section('title')
    All Appointment
@endsection

@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
    <div class="content">
        <h2 class="content-heading">Appointments Information</h2>
        <div class="row">

            <div class="col-lg-12">


                <!-- Block Tabs Animated Slide Left -->
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-animated-slideleft-home">Today {{Date('d-M-Y')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-animated-slideleft-profile"> online/ pending appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-animated-slideleft-all"> All Appointment</a>
                        </li>
                        {{-- <li class="nav-item ml-auto">
                            <a class="nav-link" href="#btabs-animated-slideleft-settings">
                                <i class="fa fa-plus mr-1">New Appointment</i>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left show active" id="btabs-animated-slideleft-home" role="tabpanel">
                            <h4 class="font-w400">Today's Appointment</h4>
                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered table-vcenter">
                                    <thead>
                                        <th>S/no</th>
                                        <th>Name</th>
                                        <th>Picture/f-no</th>
                                        <th>sex</th>
                                        <th>Age</th>
                                        <th>P.Status</th>
                                        <th>status</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($today as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{ $item->user->full_name}}
                                                </td>
                                                <td>
                                                <img src="{{asset('backend')}}/images/avatar/{{$item->user->avatar}}" alt="" style="width: 80px;"><br>
                                                {{$item->user->folder_number}}
                                                </td>
                                                <td>
                                                    {{$item->user->sex}}

                                                </td>
                                                <td>
                                                    {{$item->user->age}}
                                                </td>
                                                <td>
                                                    {{$item->payment_status}}
                                                </td>
                                                <td>
                                                    {{$item->status}}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-profile" role="tabpanel">
                            <h4 class="font-w400">Today's Appointment</h4>
                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered table-vcenter">
                                    <thead>
                                        <th style="width:10%;">S/no</th>
                                        <th>Name</th>
                                        <th>Picture/f-no</th>
                                        <th>sex</th>
                                        <th>Age</th>
                                        <th>P.Status</th>
                                        <th>status</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-all" role="tabpanel">
                            <h4 class="font-w400">Profile Content</h4>
                            <p>Content slides in to the left..</p>
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-settings" role="tabpanel">
                            <div class="content content-full">
                            @include('admin.appointment.includes.new')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Block Tabs Animated Slide Left -->
            </div>
        </div>
    </div>
@endsection

@section('foot_js')
 <!-- Page JS Plugins -->
 <script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
 <script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
 <script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>
 <script>
       $(window).on('load', function() {

            $('tbody tr:nth-child(odd)').addClass("bg-info-light");
            $('#patient_id').on('change', function(){
                    var classID = $(this).val();
                    var link = "{{ url('admin/patient/classajax/') }}";
                    var imgPath = "{{ asset('backend')}}/images/avatar";

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                $.ajax({
                    type:"POST",
                    url:link+"/"+classID,
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify({
                        avatar : "value",
                        sex: "value",
                        folder_number: "value",
                        phone:"value"
                        }),
                    error : function(data){
                        console.log("error:" + data)
                        },

                    success : function(response) {

                        $('#space').html('');
                        response.forEach(function(data) {
                            $('#space').append('<img src="'+ imgPath + '/' + data.avatar+ '" class="img-fluid img-avatar96">')
                            $('#sex').val(data.sex);
                            $('#folder_number').val(data.folder_number);
                            $('#phone').val(data.phone);
                        });

                    }
                });

            });



});
 </script>

@endsection
