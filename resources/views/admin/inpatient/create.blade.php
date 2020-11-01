@extends('admin.admin')

@section('title')
    ward round
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
                        <img class="img-fluid img-fluid-100 options-item" src="{{ $inpatient->user->avatar ? asset('backend/images/avatar/'. $inpatient->user->avatar) : asset('backend/images/no_image.png')}}" alt="">
                        <div class="table-responsive">
                            <table class="table table-borderless table-vcenter">
                                <tbody>
                                    <tr class="mb-0">

                                        <td>{{$inpatient->user->full_name}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$inpatient->user->folder_number}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$inpatient->user->sex}}</td>
                                    </tr>
                                    <tr>

                                        <td>{{$inpatient->user->age}}</td>
                                    </tr>
                                    <tr class="bg-city-light">
                                        <td>
                                            <p class="text-white text-center">admitted: {{\Carbon\Carbon::parse( $inpatient->date_of_admission)->diffForHumans()}} </p>
                                            {{\Carbon\Carbon::parse( $inpatient->date_of_admission)->format('d-M-Y, H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn mr-2 btn-md btn-danger mb-2 text-uppercase" data-toggle="modal" data-target="#discharge-block-normal">Discharge<br> Summary </button>
                                        </td>

                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('admin.inpatient.includes.vitalsigns')
            </div>
            <div class="col-md-10">
                <div class="block block-fx-pop pentacare-bg">
                    <div class="block-content block-content-full">
                         <!-- Block Tabs Alternative Style -->
                         <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt text-uppercase bg-city-lighter" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (!($inpatient->user->encounters->count() > 1))
                                        active
                                    @endif " href="#btabs-alt-static-home">Presenting Complaints</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-profile">Physical Exam</a>
                                </li>
                                @if (($inpatient->user->encounters->count() > 1))
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-followup">Daily Monitor</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-action">Action Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-vitals">Vital Signs chart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-nursing">Nursing Report</a>
                                </li>

                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane @if (!($inpatient->user->encounters->count() > 1))
                                    active
                                @endif " id="btabs-alt-static-home" role="tabpanel">



                                    @include('admin.inpatient.includes.presentingHistory')
                                    <span class="presenting">
                                    @include('admin.inpatient.includes.presenting')
                                    </span>

                                </div>
                                <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                                    @include('admin.inpatient.includes.physicalHistory')
                                    <span class="physical">
                                        @include('admin.inpatient.includes.physical')
                                    </span>
                                    @include('admin.inpatient.includes.treatment')

                                </div>
                                @if (($inpatient->user->encounters->count() > 1))
                                    <div class="tab-pane active" id="btabs-alt-static-followup" role="tabpanel">
                                        <div class="block text-center" style="border-radius: 20%;">
                                            <div class="block-header" style="background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(9,34,121,0.6898109585631127) 26%, rgba(0,212,255,0.6337885495995272) 100%);">
                                                <h3 class="text-center text-white text-uppercase">Working Diagnosis</h3>
                                            </div>
                                            <div class="block-content">
                                                @foreach ($inpatient->user->encounters as $item)
                                                @if ($item->physicalExams->count())
                                                    {{
                                                       $item->physicalExams->last()->initial_diagnosis
                                                    }}
                                                @endif


                                                @endforeach

                                            </div>
                                        </div>

                                        @include('admin.inpatient.includes.followupHistory')


                                    @include('admin.inpatient.includes.followup')
                                    @include('admin.inpatient.includes.treatment')

                                    </div>
                                @endif

                                <div class="tab-pane" id="btabs-alt-static-action" role="tabpanel">

                                    @include('admin.inpatient.includes.actions')


                                </div>
                                <div class="tab-pane" id="btabs-alt-static-vitals" role="tabpanel">
                                    <div class="block">
                                        <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#babtabswo-static-home">Chart</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#babtabswo-static-profile">Tabular</a>
                                            </li>
                                            <li class="nav-item ml-auto">
                                                <div class="block-options pl-3 pr-2">
                                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                                                        <i class="si si-pin"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="block-content tab-content">
                                            <div class="tab-pane active" id="babtabswo-static-home" role="tabpanel">
                                                <canvas class="js-chartjs-lines" width="800" height="450"></canvas>
                                            </div>
                                            <div class="tab-pane" id="babtabswo-static-profile" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="bg-amethyst text-white text-center">
                                                            <th>
                                                             time done
                                                            </th>
                                                            <th>
                                                                BP
                                                            </th>

                                                            <th>
                                                                pr
                                                            </th>
                                                            <th>
                                                                rr
                                                            </th>
                                                            <th>
                                                                spO<sub>2</sub>
                                                            </th>
                                                            <th>
                                                                temp <sup>o</sup>C
                                                            </th>
                                                            <th>
                                                                weight/height
                                                            </th>
                                                            <th>
                                                                bmi
                                                            </th>
                                                            <th>
                                                                done by
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inpatient->user->vitalsigns as $item)
                                                            <tr>
                                                                <td>
                                                                    {{$item->created_at->diffForHumans()}}
                                                                    <br>
                                                                    ({{
                                                                        $item->created_at
                                                                    }})
                                                                </td>
                                                                <td>
                                                                    {{$item->systolic}}/{{$item->diastolic}}
                                                                </td>
                                                                <td>
                                                                    {{$item->pr}}
                                                                </td>
                                                                <td>
                                                                    {{$item->rr}}
                                                                </td>
                                                                <td>
                                                                    {{$item->spo2}}
                                                                </td>
                                                                <td>
                                                                    {{$item->temp}}
                                                                </td>
                                                                <td>
                                                                    {{$item->weight}}/
                                                                    {{$item->height}}
                                                                </td>
                                                                <td>
                                                                    {{$item->bmi}}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                    $item->doneBy->name
                                                                    }}
                                                                </td>
                                                            </tr>

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full">


                                        <button type="button" class="btn btn-md btn-danger w-100 takevitals" data-toggle="modal"  data-target="#vital-signs" data-pictures="{{asset('backend')}}/images/avatar/{{$inpatient->user->avatar}}" data-fullname="{{ $inpatient->user->full_name}}" data-user-id="{{$inpatient->user->id}}" data-folder-no="{{ $inpatient->user->folder_number}}" data-sex="{{ $inpatient->user->sex}}">
                                            <span data-toggle="tooltip" title="take vitals sign"><i class="fa fa-fw fa-2x fa-stopwatch"></i></span>
                                        </button>
                                    </div>


                                </div>
                                <div class="tab-pane" id="btabs-alt-static-nursing" role="tabpanel">
                                    @include('admin.inpatient.includes.nursing')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.inpatient.includes.modal')

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

            $('#specify').hide();
            $('#specify_symptoms').hide();

            $('#username123').hide();

            $('#radio123').on('click', function(){
                $('#username123').show();
            });

            $('#radio234').on('click', function(){
                $('#username123').hide();
            });

            @if($inpatient->user->consults->count() >= 1)
               @foreach($inpatient->user->encounters as $patent)
                @if($patent->presentingComplaints->count())
                    $('.presenting').hide();
                @endif
                @if($patent->physicalExams->count())
                    $('.physical').hide();
                @endif
               @endforeach
            @endif

            $('.prescribe-review').bind('click', function(){
                    let model = $(this).data('model');
                    let id = $(this).data('type');
                    let url = "{{url('admin/pharmreq')}}" + '/'+ id;

                $.get(url, prescription);


            });

            function prescription(data){
                $('#drugs-review tbody').html('');
                $('#totalBalance-review').val(data.pharmreq.total);
                $('#drugSubmit-review').text(data.pharmreq.status);
                $('#prescribed-by').append(data.pharmreq.seen_by.name);

                $.each(data.prescription, function(key, value){
                   setTimeout(function(){
                        let tablerow = `
                <tr>

                    <td>
                        <input type="text" value="${value.drugName}" class="form-control"  readonly >

                    </td>
                    <td>
                        <input type="text"  value="${value.drug_form}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text"  value="${value.dosage}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text" name="duration[]" value="${value.duration}" class="form-control drugDuration" readonly>
                    </td>
                    <td>
                        <input type="text" name="quantity[]" value="${value.quantity}" class="form-control quantity" readonly>
                    </td>
                    <td>
                        <input type="text" name="price[]" value="${value.cost/value.quantity}" class="form-control" readonly>
                    </td>

                    <td>
                        <input type="text" name="linecost[]" value="${value.cost}" class="form-control" readonly>
                    </td>

                </tr>`;

                $('#drugs-review tbody').append(tablerow);
                    }, 200);
                    });


            }
        $('.treatment-status').bind('click',function(){
               let pid = $(this).data('id');

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });


            var type = "POST";
            var ajaxurl = 'changestatus';
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

            })
            $('#treatment-add').click(function(){


                const newRow=`
                <tr>

                    <td>
                        <input type="text" name="treatment[]" class="form-control form-control-lg" required>
                    </td>
                    <td class="remove-row" style="text-align: center">
                    <a class="btn btn-danger" onclick="deleteRowTreat()">
                    <i class="fa fa-times-circle text-white mr-1"></i>
                    <span class="text-white"> Delete</span></a>
                </td>

                </tr>
                `;
                $('#treatment-body').append(newRow);
            });

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

            $('#drug-subcategory').select2({
                dropdownParent: $('#pharmacy-block-normal')
            });

            $('#others').change(function(){
                if(this.checked){
                    $('#specify').show();
                }else{
                    $('#specify').hide();
                }
            });

            var count = 1;
            $('#drug-subcategory').on("change", function(){
                var classID = $(this).val();
                var link = "{{ url('admin/selectdrug/') }}";
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

                            $('#forms').val(response.forms+ ' -'+response.strength)
                            $('#price').val(response.price);

                            }
                            });

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
                    $('#patient_identity').val( $(this).data('user-id'));
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
                $('#addDrug').attr('disabled', true);
                $('#drugSubmit').attr('disabled', true);


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
                        "borderColor":"#D92657"
                    },
                    {
                        "label":"Diastolic",
                        "data":cData.diastolic,
                        "fill":"-1",
                        "borderColor":"#26D9A8"
                    },
                    {
                        "label":"SPO2",
                        "data":cData.spo2,
                        "fill":false,
                        "borderColor":"#19c341"
                    },
                    {
                        "label":"Respiratory Rate",
                        "data":cData.rr,
                        "fill":false,
                        "borderColor":"#E908F1"
                    },
                    {
                        "label":"Pulse Rate",
                        "data":cData.pr,
                        "fill":false,
                        "borderColor":"#1248EE"
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
            text: '{{$inpatient->full_name}} Vital Signs Chart'
            },
            elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                }
        }
    });


    $('#qty').blur(function(){
            let price = $('#price').val();
            let quantity = $('#qty').val();

            if(Number(quantity) > 0){
                setTimeout(function(){
                     $('#lineCost').val((parseFloat(price)*parseFloat(quantity)).toFixed(2));
                $('#addDrug').attr('disabled', false);
                }, 200);

            }
        });
    });

    function rowAdd(){

            let drugName =  $("#drug-subcategory option:selected").text();
            let drug = $('#drug-subcategory').val();
            let drugForms = $('#forms').val();
            let price =$('#price').val();
            let qty= $('#qty').val();
            let dosage = $('#dosage').val();
            let duration = $('#duration1').val();
            let lineCost = $('#lineCost').val();
            let currentTotal = 0;
            let lineCosts = [];


            setTimeout(function(){
                let tablerow = `
            <tr>

                <td>
                    <input type="text" value="${drugName}" class="form-control"  readonly >
                    <input type="hidden" name="drug_model_id[]" value="${drug}" class="drug_model">
                </td>
                <td>
                    <input type="text"  value="${drugForms}" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" name="dosage[]" value="${dosage}" class="form-control drugDosage" readonly>
                </td>
                <td>
                    <input type="text" name="duration[]" value="${duration}" class="form-control drugDuration" readonly>
                </td>
                <td>
                    <input type="text" name="quantity[]" value="${qty}" class="form-control quantity" readonly>
                </td>
                <td>
                    <input type="text" name="price[]" value="${price}" class="form-control dosage" readonly>
                </td>

                <td>
                    <input type="text" name="linecost[]" value="${lineCost}" class="form-control costLine" readonly>
                </td>

                <td class="remove" style="text-align: center">
                    <a class="btn btn-danger" onclick="deleteRow()">
                    <i class="fa fa-times-circle text-white mr-1"></i>
                    <span class="text-white"> Delete</span></a>
                </td>

            </tr>`;

        $('#drugs tbody').append(tablerow);

        $(".costLine").each(function(){
             lineCosts.push(parseFloat($(this).val()));

         });

        let purchase = (Array.isArray(lineCosts) && lineCosts.length) ? lineCosts.reduce((total, amount) => total + amount, 0) : lineCost ;
         $('#totalBalance').val(parseFloat(purchase).toFixed(2));

         if(purchase >0) $('#drugSubmit').attr('disabled', false);

        //
 }, 200);

        $('#drug-subcategory').val('');
        $('#price').val('');
        $('#forms').val('');
        $('#qty').val('');
        $('#dosage').val('');
        $('#duration1').val('');
        $('#lineCost').val('');
        $('#addDrug').attr('disabled', true);




    }
    function deleteRow()
        {
            $(document).on('click', '.remove', function()
            {
                $(this).parent('tr').remove();

            setTimeout(function(){

                let lineCosts =[];
                $(".costLine").each(function(){

                 lineCosts.push(parseFloat($(this).val()));

                });

            let purchase = (Array.isArray(lineCosts) && lineCosts.length) ? lineCosts.reduce((total, amount) => total + amount, 0) : 0 ;

            $('#totalBalance').val(parseFloat(purchase).toFixed(2));
                if(purchase > 0){
                    $('#drugSubmit').attr('disabled', false);
                }else{
                    $('#drugSubmit').attr('disabled', true);
                }
            }, 300);

            });
        }
    function deleteRowTreat(){
        $(document).on('click','.remove-row', function(){
            $(this).parent('tr').remove();
        });
    }


</script>


@endsection
