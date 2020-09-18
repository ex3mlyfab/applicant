@extends('admin.admin')

@section('title')
    Add Drug Class
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <div class="block block-theme pentacare-bg">
                <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="block-title text-white">Add Drug Class</h3>
                </div>

                <div class="block-content block-content-full">
                <form @if (isset($task))
                    action="{{route('drugclass.update', $task->id)}}"
                @else
                    action="{{route('drugclass.store')}}"
                @endif method="post" autocapitalize autocomplete="off">
                        @csrf
                        @if (isset($task))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="example-text-input">Drug Class Name</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->name}}"
                    @endif  id="example-text-input" name="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-auto" data-toggle="click-ripple"><i class="fa fa-fw fa-plus-circle mr-1"></i>{{ isset($task)? 'Update ': 'Add '}}  drugclass</button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-8">
            <div class="block block-fx-shadow block-rounded pentacare-bg">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title text-white">Drug Class List</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>

                               <th>Drug Class</th>
                               <th class="text-right"><strong>Action</strong></th>

                        </thead>
                        <tbody>
                            @foreach ($drugcategories as $drugclass)
                            <tr>
                            <td><a href="{{route('drugclass.show', $drugclass->id) }}"> {{$drugclass->name}}</a></td>
                                <td class="text-right">
                                    <span class="btn-group">
                                        <a href="{{route('drugclass.edit',$drugclass->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="update drugclass"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{route('drugclass.destroy', $drugclass->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete drugclass" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
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
