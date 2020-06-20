@include('admin.section.header')
    @include('admin.section.nav')
    
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-12">
                        @include('admin.section.notify')
                    </div>
                </div>



                @yield('main-content')
                
            </div>
            <!-- END PAGE CONTENT-->
            @include('admin.section.copy')
        </div>
@include('admin.section.footer')