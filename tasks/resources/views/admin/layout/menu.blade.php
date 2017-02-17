<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item @if(URL::current() == url('admin'))start active open @endif">
            <a href="{{url('/admin')}}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">{{trans('admin.home')}}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
        </li>
        <li class="nav-item @if(URL::current() == url('admin/users'))start active open @endif">
            <a href="{{url('admin/users')}}" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">{{trans('admin.users')}}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
        </li>

        <li class="nav-item @if(URL::current() == url('admin/tasks'))start active open @endif">
            <a href="{{url('admin/tasks')}}" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">{{trans('admin.tasks')}}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
        </li>
        <li class="nav-item @if(URL::current() == url('admin/images'))start active open @endif">
            <a href="{{url('admin/images')}}" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">{{trans('admin.images')}}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
        </li>




    </ul>
    <!-- END SIDEBAR MENU -->
</div>
