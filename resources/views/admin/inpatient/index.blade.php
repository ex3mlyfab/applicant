@extends('admin.admin')

@section('title')
    Pending Admission
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">

<link href="{{asset('backend')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">



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
                                    @foreach ($all as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{ $item->encounter->user->full_name}}
                                        </td>
                                        <td>
                                            <img src="{{ $item->encounter->user->avatar ? asset('backend/images/avatar/'. $item->encounter->user->avatar) : asset('frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
                                            <span class="badge badge-pill p-2 badge-light">
                                                {{$item->encounter->user->folder_number}}
                                            </span>
                                        </td>
                                        <td>
                                            {{$item->encounter->user->sex}}

                                        </td>
                                        <td>
                                            {{$item->encounter->user->age}}
                                        </td>

                                        <td>
                                            <span class="badge badge-primary"> {{$item->status}}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if ($item->status == 'admitted')
                                                    <a type="button" class="btn btn-md btn-outline-secondary text-uppercase takevitals"><span data-toggle="tooltip" title="Patients payments"> <i class="fa fa-fw fa-clipboard"></i> Bills /charges </span></a>


                                                @else
                                                <button type="button" class="btn btn-md btn-danger text-uppercase takevitals" data-toggle="modal"  data-target="#modal-block-normal" data-pictures="{{asset('backend')}}/images/avatar/{{$item->encounter->user->avatar}}" data-fullname="{{ $item->encounter->user->full_name}}" data-patient-id="{{$item->encounter->user->id}}" data-folder-number="{{ $item->encounter->user->folder_number}}" data-sex="{{ $item->encounter->user->sex}}"
                                                data-adminreq="{{$item->id}}"><span data-toggle="tooltip" title="Process Admission"> <i class="fa fa-fw fa-clipboard"></i> Process Admission </span></button>

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
                        <h3 class="block-title">Admit Patient</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm mt-0">
                        <div class="block block-fx-pop">

                            <div class="block-content content-full">
                                <form action="{{route('inpatient.store')}}" method="post" class="mb-4" onsubmit="">
                                    @csrf
                                    <div class="form-group form-row">
                                        <div class="col-md-4">
                                        <img  alt="" id="picture">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="patient_id"> PATIENT NAME</label>
                                            <input type="text" class="form-control form-control-lg" id="fullname" readonly>
                                            <input type="hidden" name="patient_id"  id="patient_id" >
                                            <input type="hidden" name="admin_req_id" id="admin_req_id" >
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                <label for="folder_number">FOLDER NUMBER</label>
                                                <input type="text" name="folder_number" id="folder_number"  class="form-control form-control-lg" readonly>


                                                </div>
                                                <div class="col-md-12">
                                                    <label for="sex">SEX</label>
                                                <input type="text" name="sex" id="sex"  class="form-control form-control-lg" readonly>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-row bg-success-light">
                                        <div class="col-md-3">
                                            <label for="room">select Ward</label>
                                            <select name="ward_id" id="room" class="js-select2 form-control" style="width: 100%;" data-placeholder="Choose one..">
                                                <option></option>
                                                {!!create_option('ward_models', 'id', 'name')!!}
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="bed">Choose Bed</label>
                                            <select name="bed_id" id="bed" class="form-control" required>
                                                <option value="">SELECT ONE</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="datetime12"> Select Date & time of admission</label><br>
                                                    <div class="form-group mb-0">
                                                        <div class='input-group date' id='datetimepicker3'>
                                                            <input type='text' class="form-control" name="date_of_admission" />
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group form-row bg-amethyst-lighter">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Deposit</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text input-group-text-alt">
                                                        ₦
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-alt text-center" id="deposit" name="deposit" placeholder="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text input-group-text-alt">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Credit Limit</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text input-group-text-alt">
                                                        ₦
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-alt text-center" id="example-group1-input3-alt" name="credit_limit" placeholder="" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text input-group-text-alt">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <span id="deposited">
                                            <label class="d-block">Deposit Methods</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="example-radios-inline1" name="deposit_method" value="cash" checked required>
                                                <label class="form-check-label" for="example-radios-inline1">Cash</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="example-radios-inline2" name="deposit_method" value="transfer" required>
                                                <label class="form-check-label" for="example-radios-inline2">Transfer</label>
                                            </div>
                                        </span>

                                    </div>



                                    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                                </form>
                            </div>

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
        $('#deposited').hide();
        $('#example-radios-inline1').prop('disabled', true);
        $('#example-radios-inline2').prop('disabled', true);

        $('#deposit').blur(function(){
            if($(this).val() > 0){
                 $('#deposited').show();
                 $('#example-radios-inline1').prop('disabled', false);
        $('#example-radios-inline2').prop('disabled', false);
            }else{
                $('#deposited').hide();
                $('#example-radios-inline1').prop('disabled', true);
        $('#example-radios-inline2').prop('disabled', true);
            }

        });

        $('tbody tr:nth-child(odd)').addClass("bg-city-lighter");

        $('#room').on("change", function(){
            var classID = $(this).val();
            var link = "{{ url('admin/wardmodelajax/') }}";

            if(classID) {
                $.ajax({
                    url: link+"/"+classID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $.each(data, function(key, value) {

                            $('#bed').append(
                            '<option value="'+ value +'"> Bed-'+ value +'</option>');

                            });
                        }
                        });

                        }
                        else{
                            $('select[name="drug_subcategory"]').empty();
                            }


            });
            $('#datetimepicker3').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY hh:mm:ss A',
                sideBySide: true
            });



    });


</script>

@endsection
