<?php
    include('php/login.php'); // Includes Login Script

    if(isset($_SESSION['login_user'])){
        if($_SESSION['access_role'] == 'Admin')
            header("location: views/home.php");
        else if ($_SESSION['access_role'] == 'Head')
            header("location: views/homeHead.php");
        else
            header("location: views/homeRegular.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!--Author: CodeRED Group-->

    <title> Broadcast System Database</title>

    <!--Bootstrap and JQuery Online-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--Bootstrap Core CSS-->

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!--Logo-->

    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

    <!--CSS-->

    <link rel="stylesheet" type="text/css" href="css/indexlayout.css">
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom Fonts -->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- jQuery -->

    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->

    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->

    <script src="js/index.js"></script>
    <script src="js/help.js"></script>

</head>
<body id="page-top" >
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                >
                    <span class="sr-only">Toggle navigation</span>
                    <img src="images/logo.png" style="height: 30px;" />
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span style="color: #C0C0C0;">
                        <img class="namelogo" src="images/logo.png" />&nbsp;&nbsp;&nbsp;
                        | BROADCAST SYSTEM  |     
                    </span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a class="page-scroll" href="#aboutmert">ABOUT</a></li>
                    <li><a class="page-scroll" href="#aboutmcdrrmo">ABS-CBN</a></li>
                    <li><a class="page-scroll" href="#aboutdevelopers">System's Engineers</a></li>
                    <li><a class="page-scroll" href="#contactus">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="modalbtn" data-toggle="modal" data-target="#loginModal">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="header-content">
            <img src="images/logo.png" />
            <img src="images/name.png" />
            <hr>
            <h3>
                Your stylish way to keep records in Broadcast System.
            </h3>
            <a class="page-scroll" href="#aboutmert">
                <i class="fa fa-5x fa-angle-double-down wow bounceIn text-primary" data-wow-delay=".1s" style="color: rgb(175,20,20);"></i>
            </a>
        </div>
    </header>
    <section id="aboutmert">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1" id="mertinfo">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-4 text-center">
                            <img class="wow fadeInLeft" src="images/logoname.png" />
                        </div>
                        <div class="col-sm-8">
                            <p>
                                This web application is designed to be used by the Broadcast System and Maintenance
                                Techinical Operation Division of ABS-CBN to keep track of its operation. Its purpose
                                was to served as database for managing, organizing, and analyzing the operation by 
                                means of interactive reports charts, viewing and updating of records. Below are the
                                primary features of this web application.

                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="triage">
                            <div class="col-sm-3 triage"><div class="circlediv">Record Managing</div></div>
                            <div class="col-sm-3 triage"><div class="circlediv">Interactive Charts</div></div>
                            <div class="col-sm-3 triage"><div class="circlediv">Print Reports</div></div>
                            <div class="col-sm-3 triage"><div class="circlediv">Reports Viewing</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4 service-box">
                            <i class="fa fa-5x fa-android wow bounceIn" data-wow-delay=".2s"></i>
                            <h3>Android</h3>
                            <p>This application is compatible with Android phones for portability of our service.</p>
                        </div>
                        <div class="col-sm-4 service-box">
                            <i class="fa fa-5x fa-apple wow bounceIn" data-wow-delay=".2s"></i>
                            <h3>IOS</h3>
                            <p>This application is compatible with IOS phones portability of our service.</p>
                        </div>
                        <div class="col-sm-4 service-box">
                            <i class="fa fa-5x fa-desktop wow bounceIn" data-wow-delay=".2s"></i>
                            <h3>Website</h3>
                            <p>Our service is also available in this website.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </section>
    <section id="aboutmcdrrmo" >
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3 text-center">
                    <img src="images/abs_cbn logo.png" />
                </div>
                <div class="col-sm-7">
                    <h1 class="wow fadeInRight">ABS-CBN</h1>
                    <h2 class="wow fadeInLeft">Alto Broadcasting System<br>Chronicle Broadcasting Network</h2>
                    <p>
                        ABS-CBN Corporation is the Philippines’ leading information and entertainment multimedia conglomerate. The Company is primarily involved in television and radio broadcasting, as well as in the production of television and radio programming for domestic and international audiences and other related businesses. ABS-CBN produces a wide variety of engaging, world-class entertainment programs that are aired on free-to-air television.
                    </p>
                    <p>
                        The Company is also one of the leading radio broadcasters, operating eighteen radio stations throughout the key cities of the Philippines. ABS-CBN provides news and entertainment programming for nine channels on cable TV and operates the country's largest cable TV service provider. The Company also owns the leading-cinema and music production and distribution outfits in the country. It brings its content to worldwide audiences via cable, satellite, online and mobile.
                    </p>
                    <a href="http://entertainment.abs-cbn.com/Tv/Home" target="_blank" class="btn btn-danger btn-x1 btn-lg">Official Website</a>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </section>
    <section id="aboutdevelopers">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>System's Engineers</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5"><br></div>
                <div class="container-fixed">
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/manuel.jpg" />
                        <h4>Manuel Roxas</h4>
                    </div>
                </div>
                <div class="col-sm-5"><br></div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="container-fixed">
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/rafael.jpg" />
                        <h4>Rafael Sandino Estudillo</h4>
                    </div>
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/elmer.jpg" />
                        <h4>Elmer Santiago</h4>
                    </div>
                </div>
                <div class="container-fixed">
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/rey.jpg" />
                        <h4>Reynante Manuel</h4>
                    </div>
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/lazaro.jpg" />
                        <h4>Lazaro Sacdalan</h4>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="container-fixed">
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/eddie.jpg" />
                        <h4>Eddie Cabalquinto</h4>
                    </div>
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/johnnesh.jpg" />
                        <h4>Johnnesh Amutan</h4>
                    </div>
                </div>
                <div class="container-fixed">
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/alex.jpg" />
                        <h4>Alexander Aguilar</h4>
                    </div>
                    <div class="col-sm-2 col-xs-6 service-box">
                        <img class="img-circle profpic wow pulse" src="images/rico.jpg" />
                        <h4>Rico Chico</h4>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </section>
    <section id="contactus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>CONTACT US</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="col-sm-3 col-xs-3"></div>
                    <div class="col-sm-2 col-xs-2 service-box">
                        <i class="fa fa-3x fa-facebook wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    </div>
                    <div class="col-sm-2 col-xs-2 service-box">
                        <i class="fa fa-3x fa-twitter wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    </div>
                    <div class="col-sm-2 col-xs-2 service-box">
                        <i class="fa fa-3x fa-instagram wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    </div>
                    <div class="col-sm-3 col-xs-3"></div>
                </div>
                <div class="col-sm-3"></div>
            </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    ABS-CBN | Broadcast System Database <br>
                    Copyright &copy; 2016 
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="loginModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="color:white">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Broadcast System Login</h4>
                </div>
                <form role="form" action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="username" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="pwd">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="login">Login</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" >Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>