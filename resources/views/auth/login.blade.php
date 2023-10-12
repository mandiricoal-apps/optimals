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
    <title>Optimal Dashboard| Login</title>
</head>

<body>
    <section class="">
        <div class="container mt-5 p-5">
            <div class="card" style="border: 0px solid rgba(0,0,0,.125);">
                <div class="row">
                    <div class="col-md-8 banner-sec">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <!-- <div class="banner-text">
         <h2><I>#GoodMiningPractice</I></h2>
         <p>PT MANDIRI INTIPERKASA</p>
        </div> -->
                                    <img class="d-block img-fluid" src="/assets/images/dashboard/HDS.png"
                                        alt="First slide" width="100%">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="banner-text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 login-sec">
                        <!-- <marquee class="mt-0" width="100%"><i>Optimals by Mandiricoal | #GoodMiningPractice</i></marquee> -->
                        <center><img class="d-block img-fluid" src="/assets/images/optimal.png" alt="First slide"
                                width="60%"></center>
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
                                            class="mdi mdi-account menu-icon"></i> NIK</b></label>
                                <input type="text" class="form-control" placeholder="" name="nik" id="nik">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class=""><b><i
                                            class="mdi mdi-lock-outline menu-icon"></i> Password</b></label>
                                <input type="password" class="form-control" placeholder="" name="password"
                                    id="password">
                            </div><br>
                            <button type="submit" class="form-control btn btn-login float-right"
                                style="color:white;background: #dc3545;"><i class="mdi mdi-login-variant menu-icon"></i>
                                Sign In</button>
                        </form>
                        <br>
                        <div class="p-4 text-center"><i>Copyright mandiricoal.co.id 2023</i></div>
                    </div>
                </div>
            </div>
    </section>


</body>

</html>
