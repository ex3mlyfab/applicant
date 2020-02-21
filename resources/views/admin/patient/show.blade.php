@extends('admin.admin')
@section('title')
{{$patient->full_name}}

@endsection
@section('content')
     <!-- Hero -->
<div class="bg-info" >
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="options-container fx-item-zoom-in fx-overlay-slide-top">
                <img class="img-fluid img-fluid-100 options-item" src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="">
                    <div class="options-overlay bg-black-75">
                        <div class="options-overlay-content">


                        <a class="btn btn-sm btn-light" href="{{route('patient.edit', $patient->id)}}">
                                <i class="fa fa-pencil-alt text-primary mr-1"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                <i class="fa fa-times text-danger mr-1"></i> book appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="block block-fx-pop block-rounded">
                    <div class="block-content content-full">
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table table-borderless table-vcenter">
                                    <tbody>
                                        <tr class="mb-0">
                                            <th style="width: 35%;"><strong>NAME:</strong></th>
                                            <td>{{$patient->full_name}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Folder Number:</strong></th>
                                            <td>{{$patient->folder_number}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Sex:</strong></th>
                                            <td>{{$patient->sex}}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Marital Status:</strong></th>
                                            <td>{{$patient->marital_status}}</td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-7">
                                <table class="table table-borderless table-vcenter">
                                    <tbody>
                                        <tr>
                                            <th style="width: 35%;"><strong>Phone/email</strong></th>
                                            <td>{{$patient->phone}}/{{$patient->email}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Address:</strong></th>
                                            <td>{{$patient->address}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>city/state</strong></th>
                                            <td>{{$patient->city}}/{{$patient->state}}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Age:</strong></th>
                                            <td>{{$patient->age}}</td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="block block-fx-shadow">
                <div class="block-header block-header-default bg-info">
                    <h3 class="block-title">Next of Kin Information</h3> </div>
                <div class="block-content block-content-full">
                    <table class="table table-borderless table-vcenter">
                        <tbody>
                            <tr>
                                <th style="width: 35%;"><strong>Next of Kin</strong></th>
                                <td>{{$patient->nok}}</td>

                            </tr>

                            <tr>
                                <th style="width: 35%;"><strong>Relationship</strong></th>
                                <td>{{$patient->nok_relationship}}</td>
                            </tr>
                            <tr>
                                <th style="width: 35%;"><strong>Phone</strong></th>
                                <td>{{$patient->nok_phone}}</td>
                            </tr>
<tr>
                                <th style="width: 35%;"><strong>Address:</strong></th>
                                <td>{{$patient->nok_address}}</td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-fx-shadow">
                <div class="block-header block-header-default bg-info">
                    <h3 class="block-title"> hospital Visits</h3>
                </div>
                <div class="block-content-full"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="block block-fx-shadow">
                <div class="block-header block-header-default bg-info">
                    <h3 class="block-title"> Reports</h3>
                </div>
                <div class="block-content-full"></div>
            </div>
        </div>
    </div>
</div>
@endsection
