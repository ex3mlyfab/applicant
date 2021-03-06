@extends('admin.admin')

@section('title')
add new user

@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection

@section('content')
    <div class="block" style="background: transparent">
        <div class="block-header mt-3">
            <h3 style="font-size: 20px;" class="font-weight-bold block-title" >
                 Add new user
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-shadow pentacare-bg">
                <div class="block-content pentacare-bg">
                    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group form-row">
                    <div class="col-md-4">
                        <label for="last_name">Last Name</label>
                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="name" id="last_name" class="form-control" value="{{old('name')?? ''}}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="other_names">Other Names</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="other_names" id="other_names" value="{{old('other_names')?? ''}}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="email" id="email" value="{{old('email')?? ''}}" class="form-control" required>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label for="phone">Phone</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="phone" id="phone" class="form-control" value="{{old('phone')?? ''}}" required>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label for="marital_status">Marital Status</label>
                        <select style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="marital_status" id="marital_status" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="single" @if (old('marital_status')=='single' )
                            selected
                         @endif > Single (Never Married)</option>
                            <option value="married" @if (old('marital_status')=='married' )
                            selected
                         @endif > Married </option>
                            <option value="divorced" @if (old('marital_status')=='divorced' )
                            selected
                         @endif > Divorced</option>
                            <option value="widowed" @if (old('marital_status')=='widowed' )
                            selected
                         @endif > Widowed</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label for="dob">dob</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="dob" id="dob" class="js-datepicker form-control" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-4">
                        <label for="address">Contact Address</label>
                        <textarea style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="address" id="address"  rows="2" class="form-control" required>
                            {{old('address')?? ''}}
                        </textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="p_address">Permanent Address</label>
                        <textarea style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="p_address" id="p_address"  rows="2" class="form-control" required>
                            {{old('p_address')?? ''}}
                        </textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="gender">Gender</label>
                        <select style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="gender" id="gender" class="form-control" required>
                            <option value="male" @if (old('gender')=='male')
                               selected
                            @endif >Male</option>
                            <option value="female" @if (old('gender')=='female' )
                            selected
                         @endif >Female</option>
                        </select>
                    </div>


                </div>
                <div class="form-group form-row">

                    <div class="col-md-4">
                        <label for="role">Role</label>
                        <select style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="role_id" id="role" class="form-control" required>
                            <option value="">Select one ...</option>
                            {{ create_option('roles','name','name')}}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="qualification">Highest Qualification</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="qualification" id="qualification" class="form-control" value="{{old('qualification')?? ''}}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date_of_joining">Date of Joining</label>
                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="date_of_joining" id="date_of_joining" class="form-control js-datepicker" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" value="{{old('date_of_joining')?? ''}}" required>
                    </div>
                    <fieldset class="border border-info px-3">
                        <legend class="pr-0"> Upload Documents</legend>
                        <div class="form-group form-row">
                            <div class="col-md-6 mb-3">
                                <label for="resume">Curriculum Vitae</label>
                                <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="file" name="resume" id="resume" class="form-control-file" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="application_letter">Application_letter</label>
                                <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="file" name="application_letter" id="application_letter" class="form-control-file" required>
                            </div>
                            <div class="col-md-6">
                                <label for="appointment_letter">Appointment Letter</label><input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="file" name="appointment_letter" id="appointment_letter" class="form-control-file" required>
                            </div>
                            <div class="col-md-6">
                                <label for="acceptance_letter">Acceptance Letter</label><input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="file" name="acceptance_letter" id="acceptance_letter" class="form-control-file">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>
@endsection
