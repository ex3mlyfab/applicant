@extends('admin.admin')

@section('title')
 {{ $admin->full_name}} Profile page

@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/dropzone/dist/min/dropzone.min.css">

@endsection

@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header" style="height: 50px; background: rgb(51, 70, 128);">
            <h3 class="block-title text-center text-white"> {{$admin->full_name}}({{$admin->getRoleNames()[0]}}) </h3>
        </div>
        <div class="block-content block-content-full pentacare-bg">
            <div class="block block-fx-pop pentacare-bg">
                <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswo-static-home">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static-profile">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static-password">Change Password/upload Picture</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="block-options pl-3 pr-2">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>

                        </div>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                        @include('admin.user.includes.profile')
                    </div>
                    <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                        @include('admin.user.includes.documents')
                    </div>
                    <div class="tab-pane" id="btabswo-static-password" role="tabpanel">
                        @include('admin.user.includes.password')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/dropzone/dropzone.min.js"></script>

@endsection
