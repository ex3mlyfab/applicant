@extends('admin.admin')

@section('title')
    nursing round
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link href="{{asset('backend')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
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
                                            <button type="button" class="btn mr-2 btn-md btn-danger mb-2 text-uppercase" data-toggle="modal" data-target="#discharge-block-normal">Discharge <br> Summary </button>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('admin.Nursing.includes.vitalsigns')
            </div>
            <div class="col-md-10">
                <div class="block text-center" style="border-radius: 20%;">
                    <div class="block-header" style="background: linear-gradient(to bottom right, rgba(2,0,36,1) 0%, rgba(9,34,121,0.6898109585631127) 26%, rgba(0,212,255,0.6337885495995272) 100%);">
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
                <div class="block block-fx-pop pentacare-bg">
                    <div class="block-content block-content-full">
                         <!-- Block Tabs Alternative Style -->
                         <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt text-uppercase bg-city-lighter" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-treatment">Treatment Chart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-fluid">Fluid Intake/Output</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-home">History Taking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-profile">F. H.P.</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-followup">Physical Assessment</a>
                                </li>
                                @if ($inpatient->dischargeSummaries->count())
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-discharge">Discharge Summary</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-vitals">Vital Signs chart</a>
                                </li>

                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane active" id="btabs-alt-static-treatment" role="tabpanel">
                                    @include('admin.Nursing.includes.treatmentsheet')

                                </div>
                                <div class="tab-pane" id="btabs-alt-static-fluid" role="tabpanel">


                                    @include('admin.Nursing.includes.getfluidhistory')


                                </div>
                                <div class="tab-pane" id="btabs-alt-static-home" role="tabpanel">
                                    @include('admin.Nursing.includes.patienthistory')

                                    @include('admin.Nursing.includes.getpatienthistory')


                                </div>
                                <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                                   @include('admin.Nursing.includes.getfunhealth')
                                     @include('admin.Nursing.includes.funHealth')


                                </div>

                                <div class="tab-pane" id="btabs-alt-static-followup" role="tabpanel">





                                    @include('admin.Nursing.includes.getphysicalassessment')

                                    @include('admin.Nursing.includes.physicalassessment')
                                    </div>


                                @if ($inpatient->dischargeSummaries->count())
                                    <div class="tab-pane" id="btabs-alt-static-discharge" role="tabpanel">
                                        @include('admin.inpatient.includes.discharge')
                                    </div>
                                @endif
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.Nursing.includes.modal')

@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('backend')}}/assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/additional-methods.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/moment.js"></script>
<script src="{{asset('backend')}}/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('backend')}}/assets/js/pages/be_forms_wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>


<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>

<script>
    $(function(){
            $('label').css("text-transform", "uppercase");

            $('#open-health').click(function(){
                $('.get-health').show();
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


    var cData = JSON.parse(`<?php echo $dataChart['chart_data']; ?>`);
    @if ($inpatient->nursingHistoryTaking->count())
        $('.get-health').hide();
    @endif
    @if($inpatient->nursingFunctionalhp->count())
        $('.get-funhealth').hide();
    @endif
    @if ($inpatient->nursingPhysicalAssessments->count())
        $('.get-physical').hide();
    @endif
    $('#show-physical').click(function(){
        $('.get-physical').show();
    });
    $('#show-funhealth').click(function(){
        $('.get-funhealth').show();
    });
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
            }
        }
    });
    $('#new-fluid').hide();

    $('#select-fluid').change(function(){
        if($(this).val()== 'others')
        {
            $('#new-fluid').show();
        }else{
            $('#new-fluid').hide();
        }
    });
    $('#datetimepicker3').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY hh:mm A',
                sideBySide: true
            });
    $('#datetimepicker4').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY hh:mm A',
                sideBySide: true
            });

    $('.treatment-charting').bind('click',function(){
        let id = $(this).data('id');
        let treatment = $(this).data('treatment');
        $('#treatment-title').html(treatment);
        $('#treatment-id').val(id);

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
                    <i class="fa fa-times-plus text-white mr-1"></i>
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


</script>


@endsection
