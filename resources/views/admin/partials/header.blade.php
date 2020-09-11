<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" style="color: rgb(51, 70, 128)" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i style="color: rgb(51, 70, 128)" class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i style="color: rgb(51, 70, 128)" class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                <i style="color: rgb(51, 70, 128)" class="si si-magnifier"></i>
            </button>
            <!-- END Open Search Section -->

            <!-- Search Form (visible on larger screens) -->
            <form class="d-none d-sm-inline-block" action="be_pages_generic_search.html" method="POST">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-body border-0">
                            <i style="color: rgb(51, 70, 128)" class="si si-magnifier"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex align-items-center">
            <span style="font-size: 23px; color: rgb(51, 70, 128); cursor: pointer" class="bx bx-tada bx-envelope"></span>
            <span style="font-size: 23px; cursor: pointer" class="text-success bx-spin ml-3 bx bx-cog"></span>
            <span style="font-size: 23px; cursor: pointer; color: rgb(51, 70, 128)" class="ml-3 bx-burst bx bx-lock"></span>
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{route('admin.logout')}}">
                <span style="font-size: 23px; cursor: pointer" class="text-danger ml-3 bx bx-log-in"></span>
            </a>
            <div class="dropdown d-inline-block ml-2">
                <button type="button" style="border: 1px solid rgb(51, 70, 128); color: rgb(51, 70, 128); border-radius: 5px" class="btn btn-sm ml-2 btn-dual ml-3" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img class="rounded" @if (isset(Auth::user()->avatar))
            src="{{asset('backend')}}/images/documents/{{Auth::user()->avatar}}"
                @else
                src="{{asset('backend')}}/assets/media/avatars/avatar13.jpg"
            @endif  alt="{{Auth::user()->full_name}} picture" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->full_name }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" @if (isset(Auth::user()->avatar))
            src="{{asset('backend')}}/images/documents/{{Auth::user()->avatar}}"
                @else
                src="{{asset('backend')}}/assets/media/avatars/avatar13.jpg"
            @endif  alt="{{Auth::user()->full_name}} picture">
                    </div>
            </div>
        </div>
    </div>
</div>
    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
