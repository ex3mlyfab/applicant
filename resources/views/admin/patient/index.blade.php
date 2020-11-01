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
                Registered Patients
            </h1>
            <div class="ml-md-auto">
                <a href="{{route('patient-statistics.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                <a href="{{route('patient.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New Patient</a>
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
                        <th style="width: 23%">Full Name </th>
                        <th>Picture/Sex</th>
                        <th style="width: 17%">Age</th>
                        <th style="width: 10%;">Last visit</th>
                        <th style="width: 15%;" class="text-center">action</th>
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
                            <span class="badge badge-info">{{$patient->sex}}</span>
                        </td>
                        <td style="font-size: 18px">
                            {{$patient->age}}
                        </td>
                        <td style="font-size: 16px">
                            <em style="font-size: 20px" class="text-muted font-size-sm">{{$patient->last_visit .' /'. $patient->day_agos_appointment}}</em>
                        </td>
                        <td class="text-center">
                            @if ($patient->current_appointment)
                                <span class="badge badge-warning">On Consultation</span>
                            @elseif($patient->admission_status)
                            <span class="badge badge-warning">On Admission</span>
                            @else
                        <a href="{{route('consultation.book', $patient->id)}}" class="btn btn-outline-danger">Book Consultation</a>
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
<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Book Consultation</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <form action="{{route('clinicalappointment.store')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="patient"> Patient Name</label>
                                <input type="text" name="name" id="patient" class="form-control form-control-lg" disabled>
                                <input type="hidden" name="patient_id" id="patient_id">
                            </div>
                            <div class="col-md-4">
                                <span id="space">

                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="folder_number">folder number</label>
                                        <input type="text" name="folder_number" id="folder_number" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="sex">Sex</label>
                                        <input type="text" name="sex" id="sex" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control form-control-lg" disabled>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="see">To See</label>
                                <input type="text" name="to_see" id="see" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-4">
                                <label for="charge">Charges</label>
                                <input type="text" name="charges" id="charge" class="form-control form-control-lg" readonly>
                                <input type="hidden" name="true-charge" id="true-charge">
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="login-remember" name="payment" @if (old('payment')=='paid')
                                        selected
                                    @endif value="paid" required>
                                    <label class="custom-control-label font-w400" for="login-remember"> Paid</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="login-remember1" name="payment" @if (old('payment')=='deffered')
                                        selected
                                    @endif value="deffered" required>
                                    <label class="custom-control-label font-w400" for="login-remember1">Defer Payment</label>
                                </div>
                            </div>


                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                    </form>

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
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
           $(function(){
            $('tbody tr:nth-child(odd)').addClass("bg-default-light");
            $('.book').bind('click',function(){
                var classID = $(this).data('user');
                    var link = "{{ url('admin/patient/classajax/') }}";
                    var imgPath = "{{ asset('backend')}}/images/avatar";
                    let charges= "{{$charge->amount}}";
                    let value= 0, paymentMethod = "", payment=$('#charge');

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
                            $('#patient').val(data.last_name + ' '+ data.other_names);
                            $('#patient_id').val(data.id);
                            $('#folder_number').val(data.folder_number);
                            $('#phone').val(data.phone);
                            paymentMethod = data.paymentMethod;


                        });

                    }
                });

                switch (paymentMethod) {
                    case 'Insurance':
                            payment.val(charges* 0.10);
                        break;
                    default:
                            payment.val(charges);
                        break;
                }
$('#modal-block-normal').modal('show');
            });


           });
       </script>

@endsection
