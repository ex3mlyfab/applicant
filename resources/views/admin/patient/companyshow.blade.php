@extends('admin.admin')
@section('title')
    {{$company->name}}
@endsection
@section('content')
<div class="bg-info" >
    <div class="content">
        <div class="row">

            <div class="col-md-9">
                <div class="block block-fx-pop block-rounded">
                    <div class="block-content content-full">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="table-responsiveness">
                                    <table class="table table-borderless table-vcenter">
                                        <tbody>
                                            <tr class="mb-0">
                                                <th style="width: 35%;"><strong>NAME:</strong></th>
                                                <td>{{$company->organisation_name}}</td>

                                            </tr>
                                            <tr>
                                                <th style="width: 35%;"><strong>Folder Number:</strong></th>
                                                <td>{{$company->folder_number}}</td>

                                            </tr>
                                            <tr>
                                                <th style="width: 35%;"><strong>Address</strong></th>
                                                <td>{{$company->address}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 35%;"><strong>Contact Phone Number</strong></th>
                                                <td>{{$company->organisation_phone}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if ($company->enrolment_count <= $company->registrationType->max_enrollment)
                                <a href="{{route('company.enroll', $company->id)}}" class="btn btn-info">Enroll members</a>
                            @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-fx-pop">
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-city-light text-uppercase">
                        <tr>
                            <th>
                                S/NO
                            </th>
                            <th>
                                Full Name
                            </th>
                            <th>
                                picture
                            </th>
                            <th>
                                Folder Number
                            </th>
                            <th>
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($company->users as $company)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                            <a href="{{route('patient.show', $company->id)}}">{{$company->full_name}}</a>
                            </td>
                            <td>
                                <img class="img-avatar img-avatar128 options-company" src="{{asset('backend')}}/images/avatar/{{$company->avatar}}" alt="">
                            </td>
                            <td>
                                {{$company->folder_number}}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('patient.edit', $company->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    @role('super-admin')
                                    <form action="{{route('patient.destroy', $company->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                        </form>
                                    @endrole
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

@endsection
