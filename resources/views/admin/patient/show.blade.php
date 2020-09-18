@extends('admin.admin')
@section('title')
{{$patient->full_name}}

@endsection
@section('content')
     <!-- Hero -->
     <div class="" style="background: rgb(255, 255, 255, 0.8)">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h5">
                PATIENT DETAILS
            </h1>
        </div>
    </div>
</div>
<div>
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="options-container fx-item-zoom-in fx-overlay-slide-top">
                <img style="height: 345px; border-radius: 10px" class="img-fluid img-fluid-100 options-item" src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="">
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
            <div class="col-md-8">
                <div class="block block-fx-pop block-rounded pentacare-bg">
                    <div class="block-content content-full">
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table table-borderless table-vcenter">
                                    <tbody>
                                        <tr class="mb-0">
                                            <th style="width: 35%;"><strong>NAME:</strong></th>
                                            <td class="text-capitalize">{{$patient->full_name}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Folder Number:</strong></th>
                                            <td class="text-capitalize">{{$patient->folder_number}}</td>

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
                                            <td>{{$patient->phone}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Email</strong></th>
                                            <td>{{$patient->email}}</td>

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
                        @role('super-admin')
                        <form action="{{route('patient.destroy', $patient->id)}}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-center mb-2">
                                <button class="btn btn-md btn-danger" data-toggle="tooltip" data-placement="top" title="delete patient" type="submit"><i class="fa fa-times text-white ml-auto"></i> Delete</button>
                            </div>
                        </form>
                        @endrole

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="block block-fx-shadow pentacare-bg">
                <div class="block-header block-header-default text-white" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="block-title text-white">Next of Kin Information</h3> </div>
                <div class="block-content block-content-full">
                    <table class="table table-borderless table-vcenter">
                        <tbody>
                            <tr>
                                <th style="width: 35%;"><strong>Next of Kin</strong></th>
                                <td class="textm-capitalize">{{$patient->nok}}</td>

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
        <div class="col-md-7">
            <div class="block block-fx-shadow pentacare-bg">
                <div class="block-header block-header-default" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="block-title text-white"> hospital Visits</h3>
                </div>
                <div class="block-content-full">
                    <ul class="mt-2">
                    @foreach ($patient->consults as $item)
                        <li class="mb-2">
                            <p style="font-size: 16px">{{$item->created_at->format('d-M-Y')}}</p>


                        </li>

                    @endforeach
                </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="block block-fx-shadow pentacare-bg">
                <div class="block-header block-header-default text-white" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="text-white block-title"> Reports</h3>
                </div>
                <div class="block-content-full"></div>
            </div>
        </div>
    </div>
</div>
@endsection
