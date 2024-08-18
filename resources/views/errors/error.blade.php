
@include('Dashboard.Layouts.header')


<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Container -->
            <div class="flex-fill">

                <!-- Error title -->
                @yield('error')
                <!-- /error title -->


                <!-- Error content -->
                <div class="row">
                    <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">




                        <!-- Buttons -->
                        <div class="container ">
                            <div class="center">
                                <a href="{{route('dashboard.index')}}" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i>
                                    {{__('main.dashboard')}}</a>
                            </div>


                        </div>
                        <!-- /buttons -->

                    </div>
                </div>
                <!-- /error wrapper -->

            </div>
            <!-- /container -->

        </div>
        <!-- /content area -->


        <!-- Footer -->


    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
