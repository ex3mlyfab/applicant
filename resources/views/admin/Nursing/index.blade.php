@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="block block-bordered block-fx-pop">
            <div class="block-header bg-info"> </div>
            <div class="block-content block-content-full">
                <h4 class="font-w400">Today's Appointment {{\Carbon\Carbon::today()}}</h4>
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
                                                        @if ($item->status == 'vital sign taken')
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
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
@endsection
