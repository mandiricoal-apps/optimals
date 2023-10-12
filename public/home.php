<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Optimals</title>

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />

    <!-- boostrap 5:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />

    <link rel="stylesheet" href="assets/css/demo_1/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile border-bottom">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-image">
                            <img src="assets/images/9242076.png" alt="profile" />
                        </div>
                        <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                            <span class="font-weight-semibold mb-1 mt-2 text-center">Andika Debi Putra</span>
                            <span class="text-secondary text-center">Administrator</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <img class="sidebar-brand-logo" src="assets/images/optimalx.png" alt="" width="200" />
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=dashboard")'>
                        <i class="mdi mdi mdi-speedometer menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="pt-2 pb-1">
                    <span class="nav-item-head">Master Data</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="true" aria-controls="ui-basic">
                        <i class="mdi mdi-database menu-icon"></i>
                        <span class="menu-title">User </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=user")'>All User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=roles")'>User Roles</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=area")'>
                        <i class="mdi mdi-database menu-icon"></i>
                        <span class="menu-title">Area</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=question")'>
                        <i class="mdi mdi-database menu-icon"></i>
                        <span class="menu-title">Question & Answer</span>
                    </a>
                </li>
                <li class="pt-2 pb-1">
                    <span class="nav-item-head">Transactions</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=dailyinspection")'>
                        <i class="mdi mdi-checkbox-multiple-marked-circle menu-icon"></i>
                        <span class="menu-title">Daily Inspection</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" onclick='window.location.replace("home.php?view=issue")'>
                        <i class="mdi mdi-checkbox-multiple-blank-circle menu-icon"></i>
                        <span class="menu-title">ISSUE</span>
                    </a>
                </li>
                <li class="nav-item">

                    <!-- Active/Inactive -->
                    <script type="text/javascript">
                        function soons() {
                            Swal.fire({
                                title: 'Comming Soon',
                                icon: 'info',
                                showCancelButton: false,
                                confirmButtonText: 'Oke',
                            }).then((result) => {
                                location.reload();
                            });
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
                    <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
						<span class="mdi mdi-chevron-double-left"></span>
					</button> -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <h5><i class="mdi mdi mdi-view-dashboard menu-icon"></i><i>GoodMiningPractice</i><small> | PT Mandiri Intiperkasa</small></h5>
                        </li>
                    </ul>
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown d-none d-md-block">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-text">Account </div>
                            </a>
                            <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#" onclick="logout()">
                                    Logout
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-logout d-none d-lg-block">
                            <a class="nav-link" href="index.html">
                                <i class="mdi mdi-home-circle"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper px-5 ">
                    <?php
                    if (@$_GET['view'] == "dashboard") {
                        include "dashboard.php";
                    } else if (@$_GET['view'] == "user") {
                        include "user.php";
                    } else if (@$_GET['view'] == "roles") {
                        include "roles.php";
                    } else if (@$_GET['view'] == "roles_management") {
                        include "roles_management.php";
                    } else if (@$_GET['view'] == "area") {
                        include "area.php";
                    } else if (@$_GET['view'] == "question") {
                        include "question.php";
                    } else if (@$_GET['view'] == "question_list") {
                        include "question_list.php";
                    } else if (@$_GET['view'] == "answer") {
                        include "answer.php";
                    } else if (@$_GET['view'] == "dailyinspection") {
                        include "dailyinspection.php";
                    } else if (@$_GET['view'] == "dailyinspection_list") {
                        include "dailyinspection_list.php";
                    } else if (@$_GET['view'] == "dailyinspection_answer") {
                        include "dailyinspection_answer.php";
                    } else if (@$_GET['view'] == "issue") {
                        include "issue.php";
                    } else if (@$_GET['view'] == "issue_detail") {
                        include "issue_detail.php";
                    } else if (@$_GET['view'] == "pica") {
                        include "pica.php";
                    } else {
                        include "dashboard.php";
                    } ?>
                </div><br>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © mandiricoal.co.id 2023</span>
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"> Optimals By: <a href="https://themewagon.com/">mandiricoal.co.id</a></span>
                    </div><br>
                </footer>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>

    <!-- Plugin js for this page -->
    <script src="assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>

    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>

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

    <style type="text/css">
        .size {
            background-color: #f96868;
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
                location.reload();
            });
        };
    </script>
</body>

</html>