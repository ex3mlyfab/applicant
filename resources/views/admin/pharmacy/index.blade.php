@extends('admin.admin')
@section('content')
<div class="content">
    <div class="col-12">
        <div class="block">
            <div class="block-header with-border">
                <h4 class="block-title">Prescription List</h4>


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
                            <th>Pics</th>
                            <th>sex</th>
                            <th>Consultant</th>
                            <th>Status</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prescriptions as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->clinicalAppointment->user->full_name}}</td>
                            <td>{{$item->clinicalAppointment->user->folder_number}}</td>
                            <td><img src="{{ $item->clinicalAppointment->user->avatar ? asset('public/backend/images/avatar/'. $item->clinicalAppointment->user->avatar) : asset('public/frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar48" ></td>
                            <td><span class="badge badge-warning">{{$item->clinicalAppointment->user->sex}}</span></td>

                            <td>{{$item->clinicalAppointment->admin->name ?? ''}}</td>
                            <td><span class="badge badge-success">Requested</span></td>
                            <td><a href="#" data-toggle="modal" data-target="#result" class="text-info">Result  </a>
                                <a href="#">LMIS  </a>
                                <a href="#" data-toggle="modal" data-target="#comment-dialog" class="text-info">Comment  </a>
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
