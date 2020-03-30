@extends('admin.admin');
@section('title')
    Staff Directory
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Staff Directory</h3>
            <div class="block-options">
            <a href="{{route('user.create')}}" class="btn btn-outline-info">Add new user</a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                Staff ID
                            </th>
                            <th>
                                Fullname
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Phone Number
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $item)
                        <tr>
                            <td>
                                {{$item->id}}
                            </td>
                            <td>
                                {{$item->full_name }}
                            </td>
                            <td>
                                {{$item->getRoleNames()[0]}}
                            </td>
                            <td>
                                {{$item->phone}}
                            </td>
                            <td>
                                <span class="btn-group">
                                    <a href="{{route('user.edit',$item->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="update user"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="{{route('user.show',$item->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="view user"><i class="fa fa-user-alt"></i></a>
                                    <form action="{{route('user.destroy', $item->id)}}" method="POST" >
                                    @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete user" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
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

@endsection
