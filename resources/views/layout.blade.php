<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Optimals</title>

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />

    <!-- boostrap 5:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.min.css" />

    <link rel="stylesheet" href="/assets/css/demo_1/style.css" />
    <link rel="shortcut icon" href="/assets/images/favicon.png" />

    <style>
        .card {
            border-radius: 20px !important;
        }

        .loader {
            position: fixed;
            z-index: 2000;
            height: 100vh;
            width: 100vw;
            background-color: rgba(255, 255, 255, 1);


        }

        .img-loader {
            position: inherit;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #area-card {
            cursor: pointer;
            transition: 0.3s;
        }

        #area-card:hover {
            transform: scale(1.1);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        th {
            font-weight: bold !important;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="loader">
        <div class="img-loader">
            <img class="" src="/assets/images/loader.svg" alt="">
        </div>
    </div>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item  nav-profile border-bottom" id="parent">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-image">
                            <img src="/assets/images/9242076.png" alt="profile" />
                        </div>
                        <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                            <span class="font-weight-semibold mb-1 mt-2 text-center">{{ Auth::user()->name }}</span>
                            <span
                                class="text-secondary text-center">{{ ucfirst(Auth::user()->getRoleNames()[0]) }}</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item " id="parent">
                    <img class="sidebar-brand-logo" src="/assets/images/optimalx.png" alt="" width="200" />
                </li>
                <li class="nav-item @yield('dashboard')">
                    <a class="nav-link" type="button" href="/">
                        <i class="mdi mdi mdi-speedometer menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                @canany(['view_user', 'view_area', 'view_qna'])
                    <li class="pt-2 pb-1">
                        <span class="nav-item-head">Master Data</span>
                    </li>
                @endcanany
                @can('view_user')
                    <li class="nav-item @yield('md-user')" id="parent">
                        <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="true"
                            aria-controls="ui-basic">
                            <i class="mdi mdi-database menu-icon"></i>
                            <span class="menu-title">User </span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="collapse @yield('coll-md-user')" id="ui-basic" style="">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link @yield('all-user')" type="button" href="/user?status=active">All
                                        User</a>
                                </li>
                                @can('view_roles')
                                    <li class="nav-item ">
                                        <a class="nav-link @yield('roles')" type="button" href="/roles">Management Roles</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('view_area')
                    <li class="nav-item @yield('area')">
                        <a class="nav-link" type="button" href="/area?status=active">
                            <i class="mdi mdi-database menu-icon"></i>
                            <span class="menu-title">Area</span>
                        </a>
                    </li>
                @endcan
                @can('view_qna')
                    <li class="nav-item @yield('qna')">
                        <a class="nav-link" type="button" href="/qna">
                            <i class="mdi mdi-database menu-icon"></i>
                            <span class="menu-title">Question & Answer</span>
                        </a>
                    </li>
                @endcan
                @canany(['view_daily_inspection', 'view_issue'])
                    <li class="pt-2 pb-1">
                        <span class="nav-item-head">Transactions</span>
                    </li>
                @endcanany
                @can('view_daily_inspection')
                    <li class="nav-item @yield('daily_inspection')">
                        <a class="nav-link" type="button" href="/daily-inspection">
                            <i class="mdi mdi-checkbox-multiple-marked-circle menu-icon"></i>
                            <span class="menu-title">Daily Inspection</span>
                        </a>
                    </li>
                @endcan
                @can('view_issue')
                    <li class="nav-item @yield('issue')">
                        <a href="/issue" class="nav-link" type="button">
                            <i class="mdi mdi-checkbox-multiple-blank-circle menu-icon"></i>
                            <span class="menu-title">ISSUE</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-item" id="parent">

                    <!-- Active/Inactive -->
                    <script type="text/javascript">
                        function soons() {
                            Swal.fire({
                                title: 'Comming Soon',
                                icon: 'info',
                                showCancelButton: false,
                                confirmButtonText: 'Oke',
                            })
                        };
                    </script>
                    <a class="nav-link" type="button" onclick="soons()">
                        <i class="mdi mdi-checkbox-multiple-blank-circle menu-icon"></i>
                        <span class="menu-title">PICCA</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch" style="background: #dc3545;">
                    {{-- <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-chevron-double-left"></span>
                    </button> --}}
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown" id="parent">
                            <h5><i class="mdi mdi mdi-view-dashboard menu-icon"></i><i>GoodMiningPractice</i><small> |
                                    PT Mandiri Intiperkasa</small></h5>
                        </li>
                    </ul>
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                src="/assets/images/logo-mini.svg" alt="logo" /></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown d-none d-md-block" id="parent">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                                data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-text">Account </div>
                            </a>
                            <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" onclick="logout()">
                                    Logout
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-logout d-none d-lg-block">
                            <a class="nav-link" href="/">
                                <i class="mdi mdi-home-circle"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper px-5 ">
                    <div class="row">
                        <div class="page-header p-0">
                            <h3 class="page-title">{{ $title }}</h3>
                            @if (isset($breadcrumb))
                                {{ Breadcrumbs::render($breadcrumb) }}
                            @endif
                            {{-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Buttons </li>
                                </ol>
                            </nav> --}}
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="row">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <h5>Success ! &#128512;</h5>
                                {!! session('message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h5>Failed ! &#128532;</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach

                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            mandiricoal.co.id 2023</span>
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"> Optimals By: <a
                                href="https://themewagon.com/">mandiricoal.co.id</a></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Modal MD-->
    <div class="modal fade" id="modal-md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-md-body"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    {{-- <script src="/assets/vendors/js/vendor.bundle.base.js"></script> --}}


    <!-- Plugin js for this page -->
    {{-- <script src="/assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/vendors/flot/jquery.flot.js"></script>
    <script src="/assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="/assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="/assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="/assets/vendors/flot/jquery.flot.stack.js"></script> --}}

    <!-- inject:js -->
    {{-- <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script> --}}

    <!-- Custom js for this page -->
    {{-- <script src="/assets/js/dashboard.js"></script> --}}
    {{-- <script src="/assets/vendors/select2/select2.min.js"></script> --}}
    {{-- <script src="/assets/js/select2.js"></script> --}}

    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style type="text/css">
        .size {
            : #f96868;
        }

        tfoot input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;

            border: 1px solid #e4e9f0;
            font-family: "Open Sans", sans-serif;
            font-weight: 400;
            font-size: 0.8125rem;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            hideLoader();

            $('.nav-link').click(function() {
                if (!($(this).parent('.nav-item').attr('id') == 'parent')) {
                    showLoader();
                }
            })
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',

                    {
                        extend: 'excelHtml5',
                        text: '<i style="font-size: 14px;" class="mdi mdi-file-excel"></i> Excel',
                        titleAttr: 'Create New Record',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i style="font-size: 14px;" class="mdi mdi-printer"></i> Print',
                        titleAttr: 'Create New Record',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i style="font-size: 14px;" class="mdi mdi-eye"></i> Visibility',
                        titleAttr: 'Create New Record',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
                order: [],

                initComplete: function() {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-dark');
                    btns.removeClass('dt-button');

                    this.api().columns().every(function() {
                        let column = this;
                        let title = column.footer().textContent;

                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.footer().replaceChildren(input);
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
                }
            });

            $('#example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    {
                        extend: 'colvis',
                        text: '<i style="font-size: 14px;" class="mdi mdi-eye"></i> Visibility',
                        titleAttr: 'Create New Record',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
                order: [],
                initComplete: function() {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-dark');
                    btns.removeClass('dt-button');

                    this.api().columns().every(function() {
                        let column = this;
                        let title = column.footer().textContent;

                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.footer().replaceChildren(input);
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        function logout() {
            Swal.fire({
                title: 'Logout?',
                text: 'Do you want to Logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {

                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '/logout'
                }

            });
        };
    </script>
    <script src="/assets/js/custom.js"></script>

    <script>
        const loader = $('.loader');
        if (loader.prop('hidden') == false) {
            showLoader();
        }

        function showLoader() {
            // loader.prop('hidden', false);
            loader.fadeIn('fast');
        }

        function hideLoader() {
            // loader.prop('hidden', true);
            loader.fadeOut('slow');
        }
    </script>
    <script>
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
    @yield('js')
</body>

</html>
