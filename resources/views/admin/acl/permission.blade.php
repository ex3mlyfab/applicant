@extends('admin.admin')

@section('title')
    add permission
@endsection

@section('head_css')
 <!-- Page JS Plugins CSS -->
 <link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
 <link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add permission</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('permission.update', $task->id)}}"
                @else
                    action="{{route('permission.store')}}"
                @endif
                 method="post" autocomplete="off">
                        @csrf
                        @if(isset($task))
                            @method('PATCH')
                        @endif
                        <div class="form-group" id="area">
                            <label for="name"> permission: </label>

                                <input type="text" name="name" id="name" class="form-control"
                        @if(isset($task))
                        value="{{$task->name}}"
                        @endif >
                        @if (!(isset($task)))
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="crud" class="form-check-input" >
                                    <label class="form-check-label">CRUD</label>
                                </div>
                        </div>
                        @endif


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
                        <table class="table table-bordered table-striped table-vcenter table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('permission.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('permission.destroy', $item->id)}}" method="POST" >
                                                @csrf
                                                    @method('DELETE')
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete role" type="submit"><i class="fa fa-fw fa-times"></i></button>
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
 <!-- Page JS Plugins -->
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
