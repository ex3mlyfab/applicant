@extends('admin.admin')

@section('title')
    Add expense
@endsection

@section('content')
<div class="content">
    <h2 class="content-heading text-center">expenses Type</h2>
    <div class="block block-fx-pop">
        <block-content class="block-content-full">
            <h3 class="content-heading">Search Expenses</h3>
            <form action="" method="post" class="d-inline-flex"></form>
        </block-content>
    </div>
    <div class="row gutters-tiny">
        <div class="col-sm-3">
            <div class="block block-theme">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Add expense</h3>
                </div>

                <div class="block-content block-content-full">
                <form @if (isset($task))
                    action="{{route('expense.update', $task->id)}}"
                @else
                    action="{{route('expense.store')}}"
                @endif method="post" autocomplete="off" autocapitalize="on">
                        @csrf
                        @if (isset($task))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="example1">Expense Head</label>
                            <select name="expense_head_id" id="example1" class="form-control">
                                @foreach ($expenseheads as $class)
                            <option value="{{$class->id}}"
                                @if (isset($task))

                                {{($task->id===$class->id)? 'selected ': ''}}
                                @endif
                             > {{$class->name }}
                            </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="example-text-">expense Name</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->name}}"
                    @endif  id="example-text-" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="example-text-inpu">Paid to:</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->received_by}}"
                    @endif  id="example-text-inpu" name="received_by">
                        </div>

                        <div class="form-group">
                            <label for="example-text-inpt">Amount:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₦</span>
                            </div>
                            <input type="number" class="form-control" @if (isset($task))
                        value="{{ $task->amount}}"
                    @endif  id="example-text-inpt" name="amount" required>

                        </div>
                        </div>
                        <div class="form-group">
                            <label for="exampl-text-input">Note:</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->status}}"
                    @endif  id="exampl-text-input" name="status">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mr-auto" data-toggle="click-ripple"><i class="fa fa-fw fa-plus mr-1"></i>{{ isset($task)? 'Update ': 'Add '}}  expense</button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-9">
            <div class="block block-fx-shadow block-rounded">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">expenses List for the month of {{date('M')}}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>date</th>
                               <th>expense</th>
                               <th>Expense Head</th>
                               <th>Amount</th>
                               <th>Paid to</th>
                                <th>note</th>
                               <th class="text-right"><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{$expense->created_at->format('d/m/Y')}}</td>
                                <td>{{$expense->name}}</td>
                                <td>{{$expense->expenseHead->name}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->recieved_by}}</td>
                                <td>{{$expense->status}}</td>
                                <td class="text-right">
                                    <span class="btn-group">
                                        <a href="{{route('expense.edit',$expense->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="update expense"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{route('expense.destroy', $expense->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
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
