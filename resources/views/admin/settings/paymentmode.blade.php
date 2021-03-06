@extends('admin.admin')

@section('title')
    Add Payment Mode
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add Payment Mode</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('paymentmode.update', $task->id)}}"
                @else
                    action="{{route('paymentmode.store')}}"
                @endif
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name"></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="
                            {{$task->name}}
                       " @endisset >
                        </div>

                        <button type="submit"><i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Submit</button>
                    </form>
                 </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All paymentmodes</div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($paymentmodes as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td></td>
                                    <td>{{$item->is_active}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('paymentmode.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('paymentmode.destroy', $item->id)}}" method="POST" >
                                                @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                                </form>
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
    </div>
</div>

@endsection
