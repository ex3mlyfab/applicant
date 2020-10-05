@extends('admin.admin')

@section('title')
all Banks
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add Bank</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('bank.update', $task->id)}}"
                @else
                    action="{{route('bank.store')}}"
                @endif
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name">Bank Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->name}}" @endisset >
                        </div>
                        <div class="form-group">
                            <label for="name1">Account Name</label>
                            <input type="text" name="account_name" id="name1" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->account_name}}" @endisset >
                        </div>

                        <div class="form-group">
                            <label for="description">Account Number</label>
                            <input type="number" name="account_number" id="description" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->account_number}}" @endisset >

                        </div>
                        <button type="submit"><i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All Banks</div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Account_name</th>
                                <th>Account_number</th>
                                <th>Status</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($banks as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                <td><a href="{{route('bank.show', $item->id)}}">{{$item->name}}</a></td>
                                    <td>{{$item->account_name}}</td>
                                    <td>{{$item->account_number}}</td>
                                    <td>{{$item->is_active}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('bank.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('bank.destroy', $item->id)}}" method="POST" >
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
