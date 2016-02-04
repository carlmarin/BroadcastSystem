	
<!doctype html>
<html>
	<head>
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
	    <link rel="shortcut icon" type="image/x-icon" href="../images/coderedicon.ico" />
	    <!-- Bootstrap Core JavaScript -->
	    <script src="../js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/navVertical.css" type="text/css">
        <link rel="stylesheet" href="../css/frame.css" type="text/css">
	 
	</head>
	<body style="overflow: hidden">
        <ul>
          <li><a class="active">MENU</a></li>
          <li><a href="../views/weekly_report.php"  target="secondaryFrame">Weekly Reports</a></li>
          <li><a href="../views/monthly_report.php"  target="secondaryFrame">Monthly Reports</a></li>
          <li><a href="../views/machine_report.php"  target="secondaryFrame">Machine Incident Reports</a></li>
          <li><a href="../views/location_report.php"  target="secondaryFrame">Location Incident Reports</a></li>
        </ul>

        <div style="margin-left:25%;height:100%;">
            <iframe  src="../views/weekly_report.php"  name="secondaryFrame" id="frame" class="window" ></iframe>
        </div>

	</body>
</html>

