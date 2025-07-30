@include('layouts.inc.vendor.header')
@include('layouts.inc.vendor.navbar')

<div id="app">
    <main>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            @include('layouts.inc.vendor.sidebar')

            <!-- #sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Dashboard</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>

                <div class="container-fluid px-4">
                    @if(Session::has('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
@include('layouts.inc.vendor.footer')
