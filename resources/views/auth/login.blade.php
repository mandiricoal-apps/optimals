<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/assets/images/logo/logo_img4.png" />

    <!-- animation css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style type="text/css">
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

        .login-block {
            background: #DE6262;
            background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);
            background: linear-gradient(to bottom, #FFB88C, #DE6262);
            float: left;
            width: 100%;
            padding: 50px 0;
        }

        .carousel-inner {
            border-radius: 0 10px 10px 0;
        }

        .carousel-caption {
            text-align: left;
            left: 5%;
        }

        .login-sec {
            padding: 30px 30px;
            position: relative;
        }

        .login-sec .copy-text {
            position: absolute;
            width: 80%;
            bottom: 20px;
            font-size: 13px;
            text-align: center;
        }

        .login-sec .copy-text i {
            color: #000;
        }

        .login-sec .copy-text a {
            color: #E36262;
        }

        .login-sec h2 {
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 30px;
            color: #dc3545;
        }

        .login-sec h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FEB58A;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: auto
        }

        .btn-login {
            background: #0033c4;
            color: #fff;
            font-weight: 600;
        }

        .banner-text {
            width: 70%;
            position: absolute;
            bottom: 315px;
            padding-left: 20px;
        }

        .banner-text h2 {
            color: #fff;
            font-weight: 600;
        }

        .banner-text h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FFF;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
        }

        .banner-text p {
            color: #fff;
        }
    </style>
    <!------ Include the above in your HEAD tag ---------->

    <title>Optimals</title>

</head>

<body>
    <section class="">
        <div class="container mt-5 p-5">
            <div class="card" style="border: 0px solid rgba(0,0,0,.125);">
                <div class="row  ">
                    <div class="col-md-8 banner-sec animate__animated animate__pulse">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="/assets/images/dashboard/img3.jpg" alt="New york"
                                    style="width:100%;border-radius: 15px;">
                                </div>
                                <div class="item ">
                                    <img src="/assets/images/dashboard/img1.jpeg" alt="Los Angeles"
                                    style="width:100%;border-radius: 15px;">
                                </div>
                                <div class="item">
                                    <img src="/assets/images/dashboard/img2.jpg" alt="Chicago"
                                    style="width:100%;border-radius: 15px;">
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev"
                            style="border-radius: 15px;">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"
                        style="border-radius: 15px;">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-md-4 pt-0 login-sec animate__animated animate__flipInY">
                <!-- <marquee class="mt-0" width="100%"><i>Optimals by Mandiricoal | #GoodMiningPractice</i></marquee> -->
                <center><img class="d-block img-fluid" src="/assets/images/logo/logo_img3.png" alt="First slide"
                    width="100%">
                </center>
                <!-- <img class="d-block img-fluid" src="assets/images/mcol.PNG" alt="First slide" width="50%"> -->
                @if ($errors->has('nik'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $errors->first('nik') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form class="login-form p-4" method="Post" action="/login">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" class=""><b><i
                            class="mdi mdi-account menu-icon"></i> User ID</b></label>
                            <input type="text" class="form-control" placeholder="User ID" name="user_id" id="user_id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class=""><b><i
                                class="mdi mdi-lock-outline menu-icon"></i> Password</b></label>
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" onclick="show()"> Show Password
                            </div><br>
                            <button type="submit" class="form-control btn btn-login float-right"
                            style="color:white;background: #dc3545;"><i
                            class="mdi mdi-login-variant menu-icon"></i>
                        Sign In</button>
                    </form>
                    <br>
                    <div class="p-4 text-center"><i>Copyright mandiricoal.co.id 2023</i></div>
                </div>
            </div>

            <div class="col-md-12 p-0 animate__animated animate__pulse">
                <div class="card mb-3" style="border-radius: 15px; border-color: #dc3545;">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-8">
                                <h3 class="card-title">Optimals - GMP</h3>
                                <p class="card-text"><strong>Optimals - GMP (Good Mining Practice)</strong> adalah Operational System PT Mandiri Intiperkasa yang mengelola inspeksi lapangan secara digital berdasarkan kaidah pertambangan yang baik agar tercipta operasi yang aman dan produktif. <i><strong>Optimalkan diri dan tim kita, dengan Optimals GMP!</strong></i>
                                </p>
                                <hr>
                                <i><strong>optimals v1.0.0</strong><br>Copyright © <a href="https://mandiricoal.co.id/">mandiricoal.co.id</a> 2023</i><br><br>
                            </div>
                            <div class="col-md-4">
                                <center>
                                    <a href="https://optimals.mandiricoal.co.id/download/optimals.apk">
                                        <img class="d-block img-fluid" src="/assets/images/barcode/optimals.png"width="60%">
                                    </a>
                                    <i>Scan here or Click to download <strong>Optimals Apps</strong></i>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    function show() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>
