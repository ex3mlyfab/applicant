@extends('admin.admin')
@section('title')
    Drug Request

@endsection
@section('content')
<div class="content">
    <div class="col-12">
        <div class="block pentacare-bg">
            <div class="block-header with-border text-white" style="background: rgb(51, 70, 128, 0.8)">
                <h4 class="block-title text-white">Prescription List</h4>
                <div class="block-option">
                    <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                </div>

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
                            <td>{{$item->encounter->user->full_name}}</td>
                            <td>{{$item->encounter->user->folder_number}}</td>
                            <td><img src="{{ $item->encounter->user->avatar ? asset('backend/images/avatar/'. $item->encounter->user->avatar) : asset('frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar48" ></td>
                            <td><span class="badge badge-warning">{{$item->encounter->user->sex}}</span></td>

                            <td>{{$item->admin->name}}</td>
                            <td><span class="badge badge-success">{{$item->status}}</span></td>
                            <td>
                            <span class="btn-group">
                                @if (!(isset($item->status)))
                                    <form action="{{route('pharmacy.billdrug')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-primary">Cost Drug</button>
                                    </form>
                                @elseif(($item->status=='invoice generated'))
                                <a href="{{route('pharmreq.review', $item->id)}}">review Prescription</a>
                                @elseif (($item->status == 'item paid')||($item->status == 'inpatient'))

                                    <a href="{{route('pharmacy.dispensedrug',$item->id )}}" class="btn btn-sm btn-primary">Dispense Drugs</a>

                                @endif
                            </span>




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
