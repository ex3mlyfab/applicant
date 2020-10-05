@extends('admin.admin')

@section('title')
Insurance category
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-fx-pop">
                <div class="block-header bg-info-light">
                    <h3 class="block-header">Add Insurance Category</h3>
                </div>
                <div class="block-content block-content-full">
                <form @if (isset($task))
                action="{{route('insuranceCategory.update', $task->id)}}"
                @else
                    action="{{route('insuranceCategory.store')}}"
                @endif
                 method="post">
                        @csrf
                        @isset($task)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                      @isset($task)  value="
                            {{$task->name}}
                       " @endisset >
                       <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" id="description" cols="4" class="form-control"  @isset($task)  value="
                           {{$task->description}}
                      " @endisset></textarea>
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
                                <th>Description</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->description  }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('insuranceCategory.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
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
