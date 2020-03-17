@extends('admin.admin')

@section('title')
    add permission
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
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group" id="area">
                            <label for="name"> permission: </label>
                            <div class="input-group">
                                <input type="text" name="name[]" id="name" class="form-control"
                        @isset($task)  value="
                                {{$task->name}}
                        " @endisset >
                        <div class="input-append">
                            <a class="btn btn-dark" onclick="addrow()"><i class="fa fa-plus-circle"></i> </a>
                        </div>
                            </div>
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
                        <table class="table table-bordered table-striped table-vcenter">
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

@section('foot_js')
<script>

        function addrow(){
            var extra = '<div class="input-group remove"><input type="text" name="name[]" class="form-control"><div class="input-append"><a class="btn btn-dark" onclick="deleterow()"><i class="fa fa-minus-circle"></i></a></div></div>';
            $('#area').append(extra);
        }
        function deleterow(){
    $(document).on('click', '.remove', function()
    {
        $(this).parent('#area').remove();
    });
    }

</script>

@endsection
