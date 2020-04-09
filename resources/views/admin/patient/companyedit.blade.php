@extends('admin.admin')

@section('title')
    Add company
@endsection
@section('content')
<div class="content">
    <div class="block block-fx-shadow">
        <div class="block-header bg-modern-dark text-center">
            <h3 class="block-title text-white">
                Add New company
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{ route('company.update', $company->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                       
                        <div class="form-group">
                            <label for="organisation_name">Company Name</label>
                        <input type="text" name="organisation_name" id="organisation_name" class="form-control form-control-lg" value="{{$company->organisation_name}}">
                        </div>
                        <div class="form-group">
                            <label for="organisation_address">Company address</label>
                            <textarea name="address" id="organisation_address"  rows="4" class="form-control">
                                {{$company->organisation_name ?? ""}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="organisation_phone">Company Phone</label>
                            <input type="text" name="contact_phone" id="organisation_phone" class="form-control" value="{{$company->organisation_phone}}">
                        </div>
                        
                        <button type="submit" class="btn btn-block btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
