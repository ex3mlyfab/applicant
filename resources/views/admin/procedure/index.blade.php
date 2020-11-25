@extends('admin.admin')

@section('title')
    Pending Admission
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/sweetalert2/sweetalert2.min.css">

<link href="{{asset('backend')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">



@endsection

@section('content')
<div class="content">
    <div class="block block-fx-pop pentacare-bg">
        <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
            <h3 class="block-title text-white"> Patient List</h3>
            <div class="block-option">
                <a href="{{route('inpatient.dashboard')}}" class="btn btn-success">
                    <i class="fa fa-door-open"></i> Dashboard
                </a>
            </div>
        </div>
        <div class="block-content block-content-full">

            <h4 class="font-w400">Pending Procedures</h4>

                <div class="table-responsive">
                        <table class="table table-stripped table-bordered table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>S/no</th>
                                <th>Name</th>
                                <th>Picture/f-no/sex</th>
                                <th>Age</th>
                                <th>Doctor i/c</th>
                                <th>Procedure</th>
                                <th>action</th>
                            </thead>
                                <tbody>
                                    @foreach ($procedures as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{ $item->inpatient->user->full_name}}
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ $item->inpatient->user->avatar ? asset('backend/images/avatar/'. $item->inpatient->user->avatar) : asset('frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
                                            <span class="badge badge-pill p-2 badge-light">
                                                {{$item->inpatient->user->folder_number}}
                                            </span>
                                            <span class="badge badge-pill p-2 badge-light">
                                                {{$item->inpatient->user->sex}}
                                            </span>
                                        </td>

                                        <td>
                                            {{$item->inpatient->user->age}}
                                        </td>
                                        <td>
                                            {{$item->requestBy->name}}
                                        </td>

                                        <td>
                                            {{
                                                $item->procedure_type
                                            }}
                                        </td>
                                        <td>
                                           <div class="btn-group">
                                                @if ($item->status == Null)
                                                <form action="{{route('surgical.confirm')}}" method="POST" id="procedure-{{$item->id}}" onsubmit="return confirm('confirm patient has paid?')" >
                                                    @csrf
                                                    <input type="hidden" name="procedure_request_id" value="{{$item->id}}">

                                                    <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit">Confirm Payment</button>
                                                </form>
                                                @endif
                                                @if ($item->status == 'paid')
                                                  <button type="button" class="btn btn-md btn-danger text-uppercase make-plans" data-toggle="modal"  data-target="#modal-block-normal" data-pictures="{{asset('backend')}}/images/avatar/{{$item->inpatient->user->avatar}}" data-fullname="{{ $item->inpatient->user->full_name}}" data-encounter="{{$item->inpatient->encounter->id}}" data-folder-number="{{ $item->inpatient->user->folder_number}}" data-sex="{{ $item->inpatient->user->sex}}"
                                                  data-age="{{$item->inpatient->user->age}}"
                                                  data-phone="{{$item->inpatient->user->phone}}"  data-procedure-request="{{$item->id}}"><span data-toggle="tooltip" title="Plan procedure"><i class="fa fa-fw fa-clipboard"></i>  Operation Details </span></button>

                                                @endif




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
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Record Operation details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm mt-0">
                        <div class="block block-fx-pop">
                        <form action="{{route('surgicalpatient.store')}}" method="post" id="surgical-report">
                            @csrf
                            <input type="hidden" name="encounter_id" id="encounter">
                            <input type="hidden" name="procedure_request" id="procedure">
                            <div class="block-content content-full">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="w-100 rounded" id="pictures">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Patient Name</label>
                                            <input type="text" id="name" class="form-control form-control-lg" readonly>
                                        </div>
                                        <div class="form-group">
                                          <label>Age</label>
                                          <input type="text" id="age" class="form-control form-control-lg" readonly>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <label for="folder_number">folder number</label>
                                            <input type="text" id="folder_number" class="form-control form-control-lg" readonly>


                                        </div>
                                        <div class="col-md-12">
                                            <label for="sex">Sex</label>
                                            <input type="text" id="sex" class="form-control form-control-lg" readonly>


                                        </div>
                                        <div class="col-md-12">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" id="phone" class="form-control form-control-lg" readonly>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row bg-amethyst-lighter rounded">
                                <div class="form-group col-md-4">
                                    <label for="operation_name">Operation Name</label>
                                    <input type="text" name="operation_name" id="operation_name" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="position">position</label>
                                    <input type="text" name="position" id="position" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="incision">incision</label>
                                    <input type="text" name="incision" id="incision" class="form-control form-control-lg" required>
                                </div>
                            </div>
                            <div class="form-row bg-modern-light rounded text-white">
                                <div class="form-group col-md-4">
                                    <label for="pre_operative_pcv">Pre Operative PCV</label>
                                    <input type="number" name="pre_operative_pcv" step="0.1" id="pre_operative_pcv" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="findings">findings</label>
                                    <textarea name="findings" id="findings" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="procedure">procedure</label>
                                    <textarea name="procedure" id="procedure" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-row bg-dark text-white">
                                <div class="form-group col-md-4">
                                    <label for="estimated_blood_loss">Estimated Blood loss</label>
                                    <input type="number" name="estimated_blood_loss" step="0.1" id="estimated_blood_loss" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group col-md-4 offset-md-2">
                                    <label for="lead_surgeon">lead surgeon</label>
                                    <input type="text" name="lead_surgeon" id="lead_surgeon" class="form-control form-control-lg" required>
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="w-100 btn btn-outline-secondary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                            </form>

                        </div>

                    </div>
                    <div class="block-content block-content-full text-right border-top">

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('foot_js')

<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('backend')}}/assets/js/moment.js"></script>
<script src="{{asset('backend')}}/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>



<script>jQuery(function(){ One.helpers([ 'select2']); });</script>
<script>

    $(function(){

        $('.takevitals').bind('click',function(){
            $('#picture').attr('src', $(this).data('pictures'));
            $('#fullname').val( $(this).data('fullname'));
            $('#folder_number').val( $(this).data('folder-number'));
            $('#sex').val( $(this).data('sex'));
            $('#patient_id').val( $(this).data('patient-id'));
            $('#admin_req_id').val( $(this).data('adminreq'));
        });

        $('.make-plans').bind('click', function(){
            $('#pictures').attr('src', $(this).data('pictures'));
            $('#name').val( $(this).data('fullname'));
            $('#folder_number').val( $(this).data('folder-number'));
            $('#sex').val( $(this).data('sex'));
            $('#phone').val( $(this).data('phone'));
            $('#age').val( $(this).data('age'));
            $('#patient_id').val( $(this).data('patient-id'));
            $('#admin_req_id').val( $(this).data('adminreq'));
            $('#encounter').val($(this).data('encounter'));
            $('#procedure').val($(this).data('procedure-request'));
        });
        jQuery(".js-swal-question").on("click",function(e)
        {swal("Confirm","Confirm patient has paid")}
        );

        $('tbody tr:nth-child(odd)').addClass("bg-city-lighter");


            function assignRoom(data)
            {
                $('#bed').empty();

                $.each(data, function(key, value){
                    $('#bed').append(
                    '<option value="'+ value.name +'"> Bed-'+ value.name +'</option>'
                    );

                });

            }

            $('#datetimepicker3').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY hh:mm:ss A',
                sideBySide: true
            });
            $('.confirm-payments').bind('click', function(){
                let pid = $(this).data('id');

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });


                var type = "POST";
                var ajaxurl = 'confirmpayment';
                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        data: {
                            pid: pid,
                            },
                        dataType: 'json',
                        success: function (data){
                        let message = data.continue ? 'RESTART': 'STOP';


                    $('#row-'+pid+' button' ).prop('innerText', message);

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });

                    });



    });


</script>

@endsection
