@extends('admin.admin')

@section('title')
    Add Supplier
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
                    <h3 class="block-header">Add Supplier</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('supplier.update', $task->id)}}"
                @else
                    action="{{route('supplier.store')}}"
                @endif
                 method="post" autocomplete="off">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name">Supplier</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->name}}"@endisset required>
                        </div>
                        <div class="form-group">
                            <label for="description">Contact Phone </label>

                            <input type="text" name="contact_phone" id="description" class="form-control form-control-lg" @isset($task)  value="{{$task->contact_phone}}"@endisset required>


                        </div>
                        <div class="form-group">
                            <label for="description2">Contact Person</label>
                            <input type="text" name="contact_person_name" id="description2" class="form-control form-control-lg" @isset($task)  value="{{$task->contact_person}}"@endisset>

                        </div>
                        <div class="form-group">
                            <label for="address">Company Address</label>
                            <textarea name="address" id="address" cols="4" class="form-control form-control-lg"
                            @isset($task)  value="{{$task->address}}"@endisset>

                            </textarea>
                        </div>
                        <button type="submit"><i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All Suppliers</div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Supplier Name</th>
                                <th>Phone</th>
                                <th>Contact Person</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->contact_phone}}</td>
                                    <td>{{$item->contact_person_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('supplier.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('supplier.destroy', $item->id)}}" method="POST" >
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
