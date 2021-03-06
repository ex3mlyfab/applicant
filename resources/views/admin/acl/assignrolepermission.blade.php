@extends('admin.admin')

@section('title')
    assign permission to role
@endsection

@section('content')
    <div class="content">
        <div class="block block-bordered block-fx-shadow">
            <div class="block-header bg-flat-darker text-center">
                <h3 class="block-title text-white-75">Assign Permissions to role</h3>
            </div>
            <div class="block-content block-content-full">
            <p class="display-2">{{ ucfirst($role->name) }}</p>
            <hr style="width:80%;">
            <h3 class="block-title border-info">Abilities</h3>
            <div class="row">
            @foreach ($role->permissions->sortBy('name') as $item)
                <div class="col-md-2">
                    <p class="text-capitalize badge-pill badge-info">{{$item->name}}</p>
                </div>

            @endforeach
            </div>
            <hr>
            @php
                $known = $role->permissions->pluck('name')

            @endphp
            <h3 class="block-title border"> Assign Abilities </h3>
        <form action="{{route('role.assignpermission', $role->id)}}" method="post" autocomplete="off">
            @csrf
            <div class="form-group form-row">
                @foreach ($permissions as $permission)
                   <div class="col-md-3 border">
                       <div class="form-check-inline mb-2">
                       <input type="checkbox" name="name[]" class="form-check-input" value="{{ $permission->name}}" @if ($known->contains($permission->name))
                           checked
                       @endif >
                           <label class="form-check-label">{{ ucfirst($permission->name) }}</label>
                       </div>
                   </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-info w-100">save</button>
        </form>
        </div>
        </div>
        
    </div>
@endsection
