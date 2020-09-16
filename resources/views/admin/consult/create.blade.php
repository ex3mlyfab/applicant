@extends('admin.admin')

@section('title')
    consultation
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')
    <div class="content">
        <div class="row gutters-tiny">
            <div class="col-md-2">
                <div class="block block-bordered block-rounded block-fx-shadow">
                    <div class="block-content">
                        <img class="img-fluid img-fluid-100 options-item" src="{{ $patient->avatar ? asset('backend/images/avatar/'. $patient->avatar) : asset('backend/images/no_image.png')}}" alt="">
                        <div class="table-responsive">
                            <table class="table table-borderless table-vcenter">
                                <tbody>
                                    <tr class="mb-0">

                                        <td>{{$patient->full_name}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$patient->folder_number}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$patient->sex}}</td>
                                    </tr>
                                    <tr>

                                        <td>{{$patient->age}}</td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('admin.consult.includes.vitalsigns')
            </div>
            <div class="col-md-10">
                <div class="block block-fx-pop">
                    <div class="block-content block-content-full">
                         <!-- Block Tabs Alternative Style -->
                         <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt text-uppercase bg-city-lighter" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (!($consults->count() > 1))
                                        active
                                    @endif " href="#btabs-alt-static-home">Presenting Complaints</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-profile">Physical Exam</a>
                                </li>
                                @if (($consults->count() > 1))
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-followup">Follow Up</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-action">Action Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-vitals">Vital Signs chart</a>
                                </li>

                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane @if (!($consults->count() > 1))
                                    active
                                @endif " id="btabs-alt-static-home" role="tabpanel">


                                    <span class="presenting">
                                    @include('admin.consult.includes.presenting')
                                    </span>
                                    @include('admin.consult.includes.presentingHistory')

                                </div>
                                <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">


                                    <span class="physical">
                                    @include('admin.consult.includes.physical')
                                    </span>
                                    @include('admin.consult.includes.physicalHistory')
                                </div>
                                @if (($consults->count() > 1))
                                    <div class="tab-pane active" id="btabs-alt-static-followup" role="tabpanel">


                                        @include('admin.consult.includes.followupHistory')


                                    @include('admin.consult.includes.followup')


                                </div>
                                @endif

                                <div class="tab-pane" id="btabs-alt-static-action" role="tabpanel">

                                    @include('admin.consult.includes.actions')


                                </div>
                                <div class="tab-pane" id="btabs-alt-static-vitals" role="tabpanel">

                                    <div class="block-content block-content-full">
                                        <canvas class="js-chartjs-lines" width="800" height="450"></canvas>
                                        <button type="button" class="btn btn-md btn-danger w-100 takevitals" data-toggle="modal"  data-target="#vital-signs" data-pictures="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" data-fullname="{{ $patient->full_name}}" data-patient-id="{{$patient->id}}" data-folder-no="{{ $patient->folder_number}}" data-sex="{{ $patient->sex}}">
                                            <span data-toggle="tooltip" title="take vitals sign"><i class="fa fa-fw fa-2x fa-stopwatch"></i></span>
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.consult.includes.modal')
@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('backend')}}/assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/additional-methods.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_forms_wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>

<script>
    $(function(){
            $('label').css("text-transform", "uppercase");
            $('#specify').hide();
            $('#specify_symptoms').hide();

            $('#username123').hide();

            $('#radio123').on('click', function(){
                $('#username123').show();
            });

            $('#radio234').on('click', function(){
                $('#username123').hide();
            });

            @if($consults->count() > 1)
               @foreach($consults as $consult)
                @if($consult->presentingComplaint)
                    $('.presenting').hide();
                @endif
                @if($consult->physicalExam)
                    $('.physical').hide();
                @endif
               @endforeach
            @endif

            $('#phx').on('click', function(){
                $('.presenting').toggle();
            });
            $('#physical').on('click', function(){
                $('.physical').toggle();
            });

            $('#fbc').change(function(){
                if(this.checked){

                    $('.fbc').prop("checked",true );
                    $('#investigation_required').val('Full Blood Count');
                }else{
                    $('.fbc').prop("checked",false );
                    $('#investigation_required').val('');
                }
            });



            $('#others').change(function(){
                if(this.checked){
                    $('#specify').show();
                }else{
                    $('#specify').hide();
                }
            });

            var count = 1;
            $('#category').on("change", function(){
                            var classID = $(this).val();
                            var link = "{{ url('admin/drugcategory/drugcategoryajax/') }}";

                            if(classID) {
                                $.ajax({
                                    url: link+"/"+classID,
                                    type: "GET",
                                    dataType: "json",
                                    success:function(data) {
                                        $('#drug-subcategory').empty();

                                        $.each(data, function(key, value) {

                                            $('#drug-subcategory').append(
                                            '<option value="'+ key +'">'+ value +'</option>');

                                            });
                                        }
                                        });

                                        }
                                        else{
                                            $('select[name="drug_subcategory"]').empty();
                                            }


                            });
            $('#drug-subcategory').on("change", function(){
                            var classID = $(this).val();
                            var link = "{{ url('admin/drug/drugajax/') }}";
                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            if(classID) {
                                $.ajax({
                                    url: link+"/"+classID,
                                    type: "GET",
                                    dataType: "json",
                                    contentType: "application/json",
                                    data: JSON.stringify({
                                        id : "value",
                                        name: "value",
                                        forms : "value"
                                        }),
                                    success:function(response) {
                                        $('#drug').empty();

                                        response.forEach(function(data){
                                            $('#drug').append(
                                            '<option value="'+ data.id +'">'+ data.name + " - "+data.forms +'</option>');

                                            });
                                        }
                                        });

                                        }
                                        else{
                                            $('select[name="drug_subcategory"]').empty();
                                            }


                            });
                $('#addDrug').attr('disabled', true);

                $('#dosage').blur(function(){
                    $('#addDrug').attr('disabled', false);
                });

                $('#category').on('blur', function(){
                    drugcategory = $('#category').text();
                });

                $('#drug_subcategory').on('blur', function(){
                    drug_subcategory = $('#drug_subcategory').text();
                });
                $('#drug').on('blur', function(){
                    drug_place = $('#drug').text();
                });
                var weight, height, bmi;
                $('.takevitals').bind('click',function(){
                    $('#picture').attr('src', $(this).data('pictures'));
                    $('#fullname1').val( $(this).data('fullname'));
                    $('#folder_no').val( $(this).data('folder-no'));
                    $('#gender0').val( $(this).data('sex'));
                    $('#patient_identity').val( $(this).data('patient-id'));
                });

                $('#height').prop("readonly", true);
                $('#bmi').val('Enter weight and Height for Bmi');

                $('#weight').on('blur', function(){
                    weight = $(this).val();
                    $('#height').prop("readonly",false );

                });
                $('#height').on('blur', function(){
                    height = $(this).val();
                    bmi = weight/(height*height);

                    $('#bmi').val(bmi.toFixed(2));
                });

                $("#drugSubmit").click(function(e){
                    var drugname = [];
                    var dosage = [];
                    var instruction = [];
                    var appointment = $(this).data('appointment');

                    $(".drug_model").each(function(){
                        drugname.push($(this).val());

                    });

                    $(".dosage").each(function(){
                        dosage.push($(this).val());
                    });
                    $(".instruction").each(function(){
                        instruction.push($(this).val());
                    });

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                            });

                            e.preventDefault();
                            var type = "POST";
                            var ajaxurl = 'pharmreq/create';
                                $.ajax({
                                    type: type,
                                    url: ajaxurl,
                                    data: {
                                        clinical_appointment: appointment,
                                        drug_model_id:drugname,
                                        dosage:dosage,
                                        instruction:instruction
                                            },
                                    dataType: 'json',
                                    success: function (data){
                                        let link =`
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-3 ml-2">

                                                </div>
                                                <div class="media-body">
                                                    <div class="font-w600">${data.type}</div>
                                                    <div class="text-success">${data.status}</div>
                                                    <small class="text-muted">${ data.created_at}</small>
                                                </div>
                                            </a>
                                        </li>`;
                                        $("#recenttest").append(link);
                                        $("#pharmacy-block-normal").modal('hide');


                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });

                                });
                                var cData = JSON.parse(`<?php echo $dataChart['chart_data']; ?>`);

                                new Chart($(".js-chartjs-lines"), {
                                    "type": "line",
                                    "data": {
                                        "labels":cData.label,
                                        "datasets":[
                                                {
                                                    "label":"Systolic",
                                                    "data":cData.systolic,
                                                    "fill":false,
                                                    "borderColor":"rgb(235,26,8)"
                                                },
                                                {
                                                    "label":"Diastolic",
                                                    "data":cData.diastolic,
                                                    "fill":false,
                                                    "borderColor":"rgb(235,26,8)"
                                                },
                                                {
                                                    "label":"Height",
                                                    "data":cData.height,
                                                    "fill":false,
                                                    "borderColor":"#19c341"
                                                },
                                                {
                                                    "label":"weight",
                                                    "data":cData.weight,
                                                    "fill":false,
                                                    "borderColor":"#39f3e1"
                                                },
                                                {
                                                    "label":"Respiratory Rate",
                                                    "data":cData.rr,
                                                    "fill":false,
                                                    "borderColor":"#3308cd"
                                                },
                                                {
                                                    "label":"Pulse Rate",
                                                    "data":cData.pr,
                                                    "fill":false,
                                                    "borderColor":"#8e5ea2"
                                                },
                                                {
                                                    "label":"BMI",
                                                    "data":cData.bmi,
                                                    "fill":false,
                                                    "borderColor":"#ee00ff"
                                                },
                                                {
                                                    "label":"Temperature",
                                                    "data":cData.temp,
                                                    "fill":false,
                                                    "borderColor":"#ff0101"
                                                }
                                            ]
                                    },
                                    options: {
                                        title: {
                                        display: true,
                                        text: 'Patients Vital Signs Chart'
                                        }
                                    }
                                });







    });


    function rowAdd(){
        var drug = $('#drug').val();

                    var dosage = $('#dosage').val();
                    var instruction = $('#instruction').val();
                    var drugcategory, drug_subcategory, drug_place;
                    drug_place = $('#drug').text();
                    drugcategory = $('#category').text();
                    drug_subcategory = $('#drug_subcategory').text();

                    var tablet={

                        drug, dosage, instruction
                    }
// console.log(typeof drug_place, typeof drugcategory, typeof drug_subcategory);
                    setTimeout(function(){
                        let tablerow = `
                    <tr>

                        <td colspan="3" class="">
                            <input type="text" value="${drug_place}" class="form-control"  readonly >
                            <input type="hidden" name="drug_model_id[]" value="${tablet.drug}" class="drug_model">
                        </td>
                        <td>
                            <input type="text" name="dosage[]" value="${tablet.dosage}" class="form-control dosage" >
                        </td>
                        <td>
                            <input type="text" name="instruction[]" value="${tablet.instruction}" class="form-control instruction" >
                        </td>
                        <td class="remove" style="text-align: center">
                        <a class="btn btn-danger" onclick="deleteRow()" > <i class="fa fa-times mr-1"></i>Delete</a>
                        </td>

                    </tr>`;
                     $('#drugs tbody').append(tablerow);
                    }, 200);


    }

function deleteRow()
{
    $(document).on('click', '.remove', function()
    {
        $(this).parent('tr').remove();
    });
}

</script>


@endsection
