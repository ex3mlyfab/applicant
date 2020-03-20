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
                            <td><span class="badge badge-success">{{$item->status}}/
                                {{(($item->status) !== 'completed')}}
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
<!-- Normal Block Modal -->
<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Haematology Invoice</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="block block-fx-pop">

                        <div class="clue"></div>
                    </div>

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

