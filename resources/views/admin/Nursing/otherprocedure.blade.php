{{-- //place usage template for emergency and theater
//other procedure for the nursing unit --}}
@extends('admin.admin')

@section('title')
    Other Procedure
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="block block-fx-pop">
        <div class="block-header bg-info-light">
            <h3 class="block-title"> Patient List</h3>
        </div>
        <div class="col-lg-12">

            <div class="block">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-alt-static-home">Patients list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-alt-static-profile">book patients</a>
                    </li>

                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                        <h4 class="font-w400">Procedure List</h4>
                            <div class="block block-bordered block-fx-pop">

                            <div class="block-content block-content-full">
                                <h4 class="font-w400">Today's Procedure {{ now()->today()->format('d-M-Y')}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-stripped table-bordered table-vcenter">
                                        <thead>
                                            <th>S/no</th>
                                            <th>Name</th>
                                            <th class="text-center">Picture/f-no</th>
                                            <th>sex</th>
                                            <th>Age</th>
                                            <th>status</th>
                                            <th>action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($procedures as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{ $item->user->full_name}}
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ $item->user->avatar ? asset('backend/images/avatar/'. $item->user->avatar) : asset('backend/images/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
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
                                                <td class="text-center">
                                                    <div class="btn-group">

                                                        <button type="button" class="btn btn-md btn-danger text-uppercase takevitals" data-toggle="modal"  data-target="#modal-block-normal" data-pictures="{{asset('backend')}}/images/avatar/{{$item->user->avatar}}" data-fullname="{{ $item->user->full_name}}" data-patient-id="{{$item->user->id}}" data-folder-number="{{ $item->user->folder_number}}" data-sex="{{ $item->user->sex}}"><span data-toggle="tooltip" title="complete other procedure"> <i class="fa fa-fw fa-clipboard"></i> </span></button>


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
                    <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                        <h4 class="font-w400">book patient</h4>
                        <form action="{{route('otherprocedure.store')}}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group form-row">
                                <div class="col-md-4">
                                    <label for="patient_id"> Patient Name</label>
                                    <select name="patient_id" id="patient_id" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one.." >
                                        <option></option>
                                        @foreach ($patients as $item)
                                           <option value="{{$item->id}}">{{$item->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 w-100">
                                    <span id="space">

                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
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
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>procedure type</label>
                                    <input type="text" name="name" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-6">
                                    <label>costs</label>
                                    <input type="number" name="cost" class="form-control form-control-lg">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        <!-- END Blockss="block-content block-content-full">
              Tabs Alternative Style -->

        </div>
    </div>


@endsection
@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['select2']); });</script>

<script>
    $(function(){

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
                    console.log(response);
                    $('#space').html('');
                    response.forEach(function(data) {

                        $('#space').append('<img src="'+ imgPath + '/' + data.avatar+ '" class="img-fluid rounded img-avatar96 w-100">')
                        $('#sex').val(data.sex);
                        $('#folder_number').val(data.folder_number);
                        $('#phone').val(data.phone);
                    });

                }
            });

            });



        $('tbody tr:nth-child(odd)').addClass("bg-city-lighter");
    });
</script>

@endsection
