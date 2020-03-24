@extends('admin.admin')
@section('content')
<div class="content">
    <div class="col-12">
        <div class="block">
            <div class="block-header with-border">
                <h4 class="block-title">TEST Requests</h4>


            </div>
        <!-- /.block-header -->
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>P. Full Name</th>
                            <th>Folder NO</th>
                            <th>Pics/sex</th>
                            <th>request</th>
                            <th>Consultant</th>
                            <th>Status</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($haemreqs as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->clinicalAppointment->user->full_name}}</td>
                            <td>{{$item->clinicalAppointment->user->folder_number}}</td>
                            <td><img src="{{ $item->clinicalAppointment->user->avatar ? asset('public/backend/images/avatar/'. $item->clinicalAppointment->user->avatar) : asset('public/frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
                                <span class="badge badge-warning">{{$item->clinicalAppointment->user->sex}}</span>
                            </td>
                            <td>{{$item->investigation_required}}

                            </td>
                            <td>
                                {{$item->clinicalAppointment->admin->name ?? ''}}

                            </td>
                            <td><span class="badge badge-success">{{$item->status}}
                               </span></td>
                            <td>
                                @if(($item->status =='waiting'))
                            <a class="btn btn-info pressed" href="{{route('haematology.invoice', $item->id)}}"><i class="fa fa-money-bill-alt mr-2"></i>Prepare Invoice</a>


                                @elseif (($item->status =='invoice generated'))
                                    Not yet paid
                                @elseif (($item->status =='item paid'))
                                <a href="{{route('haematology.edit', $item->id)}}" class="text-info">Record result  </a>
                                @elseif ($item->status =='completed')
                                <a href="#">PRINT REPORT </a>

                                @endif

                            </td>

                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                    </table>
            </div>
        </div>
        <!-- /.block-body -->
        </div>
        <!-- /.block -->
    </div>
</div>

@endsection

