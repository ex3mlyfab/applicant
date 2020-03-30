@extends('admin.admin')

@section('title')
 {{ $admin->full_name}} Profile page

@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/dropzone/dist/min/dropzone.min.css">

@endsection

@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{asset('public/backend')}}/assets/media/photos/photo8@2x.jpg');">
    <div class="bg-black-50">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar128" @if (isset($admin->avatar))
            src="{{asset('public/backend')}}/images/documents/{{$admin->avatar}}"
                @else
                src="{{asset('public/backend')}}/assets/media/avatars/avatar13.jpg"
            @endif  alt="{{$admin->full_name}} picture">
            </div>
            <h1 class="h2 text-white mb-0"> {{ $admin->full_name}} </h1>
            <span class="text-white-75">{{$admin->getRoleNames()[0]}}</span>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block">
        <div class="block-header bg-amethyst-lighter">
            <h3 class="block-title text-center"> </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-pop">
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
<script src="{{asset('public/backend')}}/assets/js/plugins/dropzone/dropzone.min.js"></script>

@endsection
