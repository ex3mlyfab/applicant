@extends('admin.admin')

@section('title')
    Add expensehead
@endsection

@section('content')
<div class="content">
    <h2 class="content-heading text-center">expenseheads Type</h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="block block-theme">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Add expensehead</h3>
                </div>

                <div class="block-content block-content-full">
                <form @if (isset($task))
                    action="{{route('expensehead.update', $task->id)}}"
                @else
                    action="{{route('expensehead.store')}}"
                @endif method="post">
                        @csrf
                        @if (isset($task))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="example-text-input">expensehead Name</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->name}}"
                    @endif  id="example-text-input" name="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mr-auto" data-toggle="click-ripple"><i class="fa fa-fw fa-plus mr-1"></i>{{ isset($task)? 'Update ': 'Add '}}  expensehead</button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-8">
            <div class="block block-fx-shadow block-rounded bg-">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">expenseheads List</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                               <th>expensehead</th>
                               <th class="text-right"><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenseheads as $expensehead)
                            <tr>
                                <td>{{$expensehead->name}}</td>
                                <td class="text-right">
                                    <span class="btn-group">
                                        <a href="{{route('expensehead.edit',$expensehead->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="update expensehead"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{route('expensehead.destroy', $expensehead->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expensehead" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                        </form>
                                    </span>
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
@endsection
