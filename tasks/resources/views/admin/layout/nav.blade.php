
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->
        <!-- END THEME PANEL -->

        @if(session()->has('lang'))
            @if(session()->get('lang')=='en')
                {!! App::setLocale('en') !!}

            @else
                {!! App::setLocale('ar') !!}

            @endif
        @endif

            <ul class="breadcrumb">

                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/admin')}}">{{trans('admin.home')}}</a>
                    @if(!empty($title)) <i class="icon-angle-right"></i>@endif
                </li>
                @if(!empty(Request::segment(3)))
                @if(!empty(Request::segment(2)))<li><a href="{{url('/admin/'.Request::segment(2))}}">{{ucfirst(Request::segment(2))}}</a></li>@endif
                @endif
                @if(!empty($title))<li><a href="{{URL::current()}}">{{$title}}</a></li>@endif

            </ul>
        <!-- END PAGE HEADER-->