@extends('admin.admin')

@section('title')
    Add Payment method
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add Payment method</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('paymentmethod.update', $task->id)}}"
                @else
                    action="{{route('paymentmethod.store')}}"
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
                <div class="block-header bg-info-light">All paymentmethods</div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Decsription</th>
                                <th>Status</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($paymentmethods as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->is_active}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('paymentmethod.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
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
