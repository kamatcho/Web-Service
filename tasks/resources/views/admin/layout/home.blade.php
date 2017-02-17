@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')
<div class="clearfix"></div>
<div class="row">
    @include('admin.layout.warning')


    @yield('content')
<!-- END DASHBOARD STATS 1-->

</div>
</div>
<!-- END CONTENT BODY -->
</div>

@include('admin.layout.footer')
