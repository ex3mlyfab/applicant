@extends('admin.admin')

@section('title')
{{$insurancepackage->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                <h3 class="block-title text-white">{{$insurancepackage->name . ' for '. $insurancepackage->insurance->name}}</h3>
                <div class="block-options">
                    <button type="button" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-add"></i>Add new enrollee</button>
                </div>

            </div>
            <div class="block-content block-content-full pentcare-bg">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-12 text-center">
                            <p class="mr-2" style="font-size: 17px"> {{ ucfirst($insurancepackage->insurance->name)}} Package Name</p>
                            <h3 class="mr-2" style="font-size: 18px">{{$insurancepackage->name }}</h3>

                            </div>
                        </div>


                    </div>
                </div>
                    <hr>
            <h3 class="text-center">Enrollee Names for the month of {{ date('M')}}</h3>
                    <div class="table-responsive pentacare-bg">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    s/no
                                </th>
                                <th>
                                    Enrollee name
                                </th>
                                <th>
                                    Insurance NUmber
                                </th>
                                <th>
                                    status
                                </th>

                                <th>
                                    Actions
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($insurancepackage->enrollUsers as $item)
                                    @if ($item->user_active)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{$item->last_name. ' '.$item->other_names}}
                                        </td>
                                        <td>
                                            {{$item->insurance_no}}

                                        </td>
                                        <td>
                                            {{$item->status}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                            {{-- <button class="btn btn-sm btn-primary update" data-toggle="tooltip" title="Edit" data-name="{{$item->name}}" data-percentage="{{$item->percentage}}" data-services="{{$item->insuranceServices}}" data-note="{{$item->note}}" data-route="{{route('insurancepackage.update',$item->id)}}">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button> --}}
                                                {{-- <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Enroll a patient for {{ $insurancepackage->name}} for the month of {{ date('M-Y')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                    <form action="{{route('enrolluser.store')}}" method="post" id="form">
                            @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="insurance_no">Insurance Number</label>
                                <input type="text" name="insurance_no" id="insurance_no" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Enrollee Surname</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-lg" required>
                                <input type="hidden" name="insurance_id" value="{{$insurancepackage->id}}">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="other_name">Enrollee Other Names</label>
                                    <input type="text" name="other_names" id="other_name" class="form-control form-control-lg">
                                </div>
                            </div>

                        </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>confirm user enrollment</label>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="example-cb-custom1" name="confirm_enrollment" required>
                                    <label class="custom-control-label" for="example-cb-custom1">Confirm enrollment for month of {{ date('M-Y')}}</label>
                                    </div>
                                </div>
                                <div id="informate" class="text-center col-md-12"></div>

                            </div>

                            <div class="row d-flex text-center">
                                <button type="submit" class="btn btn-outline-success btn-lg" id="control">Submit</button>
                            </div>


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
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){
    One.helpers([ 'select2' ]);

    $('.space-1').hide();
    $('#insurance_no').on('blur', function(){
        let textvalue = $(this).val();
        if(textvalue.length > 5 ){
            var classID = textvalue;
            var link = "{{ url('admin/getinsured') }}";


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:link+"/"+classID,
                dataType: "json",
                contentType: "application/json",
                error : function(data){
                    console.log("error:" + data)
                    },

                success : function(response) {

                    if(Array.isArray(response) && response.length){

                    response.forEach(function(data) {



                        $('#last_name').val(data.last_name).prop('readonly', true);
                        $('#other_name').val(data.other_names).prop('readonly', true);
                        if(data.user_active){
                            $('#control').prop('disabled', true);
                            $('#example-cb-custom1').prop('checked', true);
                            $('#infromate').show();
                            $('#informate').append('<h3 class="text-danger text-uppercase">User Already enrolled for the month</h3>');
                        }else{
                            $('#control').prop('disabled', false);
                            $('#example-cb-custom1').prop('checked', false);
                            $('#informate').hide();
                        }
                    });
                    }else{
                            $('#last_name').val('').prop('readonly', false);
                            $('#other_name').val('').prop('readonly', false);
                            $('#control').prop('disabled', false);
                            $('#example-cb-custom1').prop('checked', false);
                            $('#informate').hide();
                        }
                }
            });

        }
    });

});</script>

@endsection
