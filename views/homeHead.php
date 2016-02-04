<?php
    require("../views/database.php");
    include('../php/session.php');
    include('../views/editProfile.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!--Author: CodeRED Group-->

    <title>Broadcast System Database</title>

    <!--Bootstrap and JQuery Online-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--Bootstrap Core CSS-->

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <!--Logo-->

    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />

    <!--CSS-->

    <link rel="stylesheet" type="text/css" href="../css/homelayout.css">
    <link rel="stylesheet" href="../css/animate.min.css" type="text/css">
    <link rel="stylesheet" href="../css/frame.css" type="text/css">

    <!-- Custom Fonts -->

    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- jQuery -->

    <script src="../js/jquery-1.11.3.js"></script>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/jquery-migrate-1.2.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <script src="../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->

    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/jquery.fittext.js"></script>
    <script src="../js/wow.min.js"></script>

    <!-- Slick CSS -->

    <link rel="stylesheet" type="text/css" href="../slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css"/>

    <!-- Slick JavaScript -->

    <script type="text/javascript" src="../slick/slick.min.js"></script>

    <!-- Custom Theme JavaScript -->

    <script src="../js/home.js"></script>

    <!-- Google Maps -->

    <script src="../js/map.js"></script>

</head>
<body style="overflow: hidden;">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                style="margin: 5px; padding: 5px;">
                    <span class="sr-only">Toggle navigation</span>
                    <img src="../images/logo.png" style="height: 30px;" />
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span style="color: #C0C0C0;">
                        <img class="namelogo" src="../images/logo.png" />
                        BROADCAST SYSTEM 
                    </span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../views/report_tableHome.php" target="mainframe">Reports</a></li>
                    <li><a href="../views/statistics.php" target="mainframe">Statistics</a></li>
                   <!--  <li><a href="../views/view_print.php" target="mainframe">View / Print Record</a></li> -->
                    <li><a href="../views/machineHead.php" target="mainframe">Machinery Record</a></li>
                    <li><a href="../views/scheduleHead.php" target="mainframe">Schedule</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" data-toggle="popover"  data-placement="bottom" data-trigger="focus"
                        title="
                            <div class='container-fluid'>
                                <div class='col-sm-12 text-center' >
                                    <img src='../images/user.png' class='img-circle' width='75' height='75'>
                                </div>
                                <div class='col-sm-12 text-center'>
                                    <h4><?php echo $fullname; ?></h4>
                                </div>
                            </div>
                        " 
                        data-content="
                            <div class='container-fluid'>
                                <div class='row'>
                                    <div class='col-sm-12 text-center'>
                                        Online
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-12 text-center'>
                                        <form method='link' action='#/'>
                                            <button type='submit' style='background-color:#0066cc' class='btn btn-success btnRespond' data-toggle='modal' data-target='#Editprofile'>Edit Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ">
                        PROFILE</a>
                    </li>
                    <li>
                        <a href="../php/logout.php" name="logout">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="row" >    
                <iframe  src="../views/report_tableHome.php"  name="mainframe" id="frame" class="window" ></iframe>
            </div>
        </div>
    </nav>

</body>
</html>