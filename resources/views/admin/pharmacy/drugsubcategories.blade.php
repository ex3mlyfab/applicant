@extends('admin.admin')

@section('content')
<div class="content">
    <h2 class="content-heading text-center">Drugsubcategories</h2>
    <div class="row">
        <div class="col-sm-4"> 
            <div class="block block-theme">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Add Sub-Category of {{ $drugcategory->name}}</h3>
                </div>

                <div class="block-content block-content-full">
                <form @if (isset($task))
                    action="{{route('drugsubcategory.update', $task->id)}}"
                @else
                    action="{{route('drugsubcategory.store', $drugcategory->id)}}"
                @endif method="post" autocapitalize autocomplete="off">
                        @csrf
                        @if (isset($task))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="example-text-input">sub category Name</label>
                        <input type="text" class="form-control" @if (isset($task))
                        value="{{ $task->name}}"
                    @endif  id="example-text-input" name="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mr-auto" data-toggle="click-ripple"><i class="fa fa-fw fa-plus mr-1"></i>{{ isset($task)? 'Update ': 'Add '}}  drugsubcategory</button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-8">
            <div class="block block-fx-shadow block-rounded bg-">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title"> {{ strtoupper($drugcategory->name)}} drug subcategories List</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>

                               <th>drug subcategory</th>
                               <th class="text-right"><strong>Action</strong></th>

                        </thead>
                        <tbody>
                            @foreach ($drugcategory->drugSubCategories as $drugsubcategory)
                            <tr>
                                <td>{{$drugsubcategory->name}}</td>
                                <td class="text-right">
                                    <span class="btn-group">
                                        <a href="{{route('drugsubcategory.edit',$drugsubcategory->id)}}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="update drugsubcategory"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{route('drugsubcategory.destroy', $drugsubcategory->id)}}" method="POST" >
                                        @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete drugsubcategory" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
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
