@extends('admin.admin')

@section('title')
add new user

@endsection

@section('content')
    <div class="block block-fx-shadow">
        <div class="block-header bg-info-light">
            <h3 class="block-title">
                 Add new user
            </h3>
        </div>
        <div class="block-content block-content-full">
            <form action="" method="post">
                @csrf
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="other_names">Other Names</label>
                        <input type="text" name="other_names" id="other_names" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form_control">
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
