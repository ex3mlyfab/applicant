@extends('admin.admin')

@section('title')
    add charge
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add Category</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('charge.update', $task->id)}}"
                @else
                    action="{{route('charge.store')}}"
                @endif
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name">Charges For</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->name}}"@endisset required>
                        </div>
                        <div class="form-group">
                            <label for="description">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        ₦
                                    </span>
                                </div>
                                <input type="number" name="amount" id="description" class="form-control form-control-lg" @isset($task)  value="{{$task->amount}}"@endisset required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Charge Categories</label>
                            <select name="charge_category_id" id="" class="form-control form-control-lg">
                                @foreach ($categories as $item)
                            <option value="{{$item->id}}"
                                @isset($task)
                                    {{ ($task->chargeCategory->name == $item->name) ?'selected="selected"' : '' }}
                                @endisset >{{$item->name}}</option>

                                @endforeach
                            </select>
                            </div>
                        <button type="submit"><i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All Categories</div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($charges as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->chargeCategory->name}}</td>
                                    <td>₦ {{$item->amount}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('charge.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('charge.destroy', $item->id)}}" method="POST" >
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
@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>

@endsection
