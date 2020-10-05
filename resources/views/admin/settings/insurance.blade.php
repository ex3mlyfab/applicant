@extends('admin.admin')

@section('title')
    add insurance
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
                    <h3 class="block-header">Add Insurance Company</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('insurance.update', $task->id)}}"
                @else
                    action="{{route('insurance.store')}}"
                @endif
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="{{$task->name}}"@endisset required>
                        </div>
                        <div class="form-group">
                            <label for="description">Contact Telephone</label>

                            <input type="text" name="contact_telephone" id="description" class="form-control form-control-lg" @isset($task)  value="{{$task->contact_telephone}}"@endisset required>


                        </div>
                        <div class="form-group">
                            <label for="">insurance Categories</label>
                            <select name="insurance_category_id" id="" class="form-control form-control-lg">
                                @foreach ($categories as $item)
                            <option value="{{$item->id}}"
                                @isset($task)
                                    {{ ($task->insuranceCategory->name == $item->name) ?'selected="selected"' : '' }}
                                @endisset >{{$item->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Company Registration Number</label>
                            <input type="text" name="reg_no" id="description3" class="form-control form-control-lg" @isset($task)  value="{{$task->reg_no}}"@endisset >

                        </div>
                        <div class="form-group">
                            <label>
                                Company Address
                            </label>
                            <textarea name="address" class="form-control" cols="30" @isset($task)  value="{{$task->address}}"@endisset ></textarea>
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
                                <th>Phone</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($insurances as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{route('insurance.show', $item->id)}}"> {{$item->name}} </a></td>
                                    <td>{{$item->insuranceCategory->name}}</td>
                                    <td>{{$item->contact_telephone}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('insurance.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('insurance.destroy', $item->id)}}" method="POST" >
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
