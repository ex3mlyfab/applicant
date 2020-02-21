@extends('admin.admin')

@section('title')
    Consult patients
@endsection

@section('content')
<div class="content">
    <div class="block block-fx-pop">
        <div class="block-header bg-info-light">
            <h3 class="block-title"> Patient List</h3>
        </div>
        <div cla<div class="col-lg-12">

                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-alt-static-home">Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-alt-static-profile">Patient Register</a>
                        </li>

                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                            <h4 class="font-w400">Patient on Appointment</h4>
                             <div class="block block-bordered block-fx-pop">
                                <div class="block-header bg-info"> </div>
                                <div class="block-content block-content-full">
                                    <h4 class="font-w400">Today's Appointment {{ now()->today()}}</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-stripped table-bordered table-vcenter">
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
                                                            @foreach ($today as $item)
                                                                <tr>
                                                                    <td>
                                                                        {{$loop->iteration}}
                                                                    </td>
                                                                    <td>
                                                                        {{ $item->user->full_name}}
                                                                    </td>
                                                                    <td>
                                                                    <img src="{{asset('public/backend')}}/images/avatar/{{$item->user->avatar}}" alt="" class="img-fluid image-clean shadow"><br>
                                                                    {{$item->user->folder_number}}
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
                                                                    <td>
                                                                        <div class="btn-group">
                                                                        <a href="{{route('vitals.create', $item->user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="take vitals">
                                                                                <i class="fa fa-fw fa-clipboard"></i>
                                                                            </a>
                                                                            @if ( $item->status == "vitals sign taken")
                                                                        <a href="{{route('consult.create', $item->user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Start Consultation">
                                                                                    <i class="fa fa-fw fa-stethoscope"></i>
                                                                                </a>
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
                        <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                            <h4 class="font-w400">Profile Content</h4>
                            <p>...</p>
                        </div>

                    </div>
                </div>
        <!-- END Blockss="block-content block-content-full">
              Tabs Alternative Style -->
            </div>
        </div>
    </div>


</div>
@endsection
