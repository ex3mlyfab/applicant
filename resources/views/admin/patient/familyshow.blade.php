@extends('admin.admin')
@section('title')
    {{$family->users->first()->full_name}}
@endsection
@section('content')
<div class="bg-info" >
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="options-container fx-item-zoom-in fx-overlay-slide-top">
                <img class="img-fluid img-fluid-100 options-item" src="{{asset('backend')}}/images/avatar/{{$family->users->first()->avatar}}" alt="">
                    <div class="options-overlay bg-black-75">
                        <div class="options-overlay-content">


                        <a class="btn btn-sm btn-light" href="{{route('patient.edit', $family->users->first()->id)}}">
                                <i class="fa fa-pencil-alt text-primary mr-1"></i> Edit
                            </a>
                        <a class="btn btn-sm btn-light" href="{{route('clinicalappointment.index')}}#btabs-animated-slideleft-settings">
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
                                            <td>{{$family->users->first()->full_name}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Folder Number:</strong></th>
                                            <td>{{$family->folder_number}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Sex:</strong></th>
                                            <td>{{$family->users->first()->sex}}</td>
                                        </tr>




                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-7">
                                <table class="table table-borderless table-vcenter">
                                    <tbody>
                                        <tr>
                                            <th style="width: 35%;"><strong>Phone/email</strong></th>
                                            <td>{{$family->users->first()->phone}}/{{$family->users->first()->email}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>Address:</strong></th>
                                            <td>{{$family->users->first()->address}}</td>

                                        </tr>
                                        <tr>
                                            <th style="width: 35%;"><strong>city/state</strong></th>
                                            <td>{{$family->users->first()->city}}/{{$family->users->first()->state}}</td>
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
                        @foreach ($family->users as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                            <a href="{{route('patient.show', $item->id)}}">{{$item->full_name}}</a>
                            </td>
                            <td>
                                <img class="img-avatar img-avatar128 options-item" src="{{asset('backend')}}/images/avatar/{{$item->avatar}}" alt="">
                            </td>
                            <td>
                                {{$item->folder_number}}
                            </td>
                            <td>
                                <div class="btn-group">
                                   
                                    <a href="{{route('patient.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                   
                                   
                                    @role('super-admin') 
                                    @if (!($loop->first))
                                    <form action="{{route('patient.destroy', $item->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                        </form>
                                    @endif
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
