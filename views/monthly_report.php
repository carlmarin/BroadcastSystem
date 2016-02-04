<?php
	require("database.php");
 	session_start();// Starting Session
    date_default_timezone_set('Asia/Manila');
	$user_check=$_SESSION['login_user'];
    $distinct_years = array();
    $index_count = 0;
	$month = array('January','February','March','April','May','June','July','August','September','October','November','December');
	
    //GET DISTINCT YEARS MINIMUM AND MAXIMUM YEARS
    $query = "select distinct year(report_date) as Distinct_Year from reports order by year(report_date) asc";
    $result = odbc_exec($conn,$query);
    while($out = odbc_fetch_array($result)){
        $distinct_years[$index_count] = $out['Distinct_Year'];
        $index_count++;
    }
        $yearMin = $distinct_years[0];
        $yearMax = $distinct_years[$index_count - 1];

    if(isset ($_POST['search'])){
		$Year = $_POST['Year'];
        $value = array();
		$counter = 0;$total_no=0;
		for($index = 0; $index < 12 ; $index++){
			$query = "select count(*) Total_Report from reports where DATENAME(MM,report_date) 
						='".$month[$index]."' and year(report_date) = ".$Year."";
		 	$result = odbc_exec($conn,$query);
		 	if($out = odbc_fetch_array($result)){
				$value[$index] = $out['Total_Report'];
				$total_no += $value[$index];
			}
			$counter++;
		} 
        $_SESSION['value']=$value;
        $_SESSION['Year']=$Year;
        $_SESSION['total_no']=$total_no;
	}else{
		$value = array();$counter = 0;$total_no=0;
		$Year = date("Y");
        for($index = 0; $index < 12 ; $index++){
			$query = "select count(*) Total_Report from reports where  DATENAME(MM,report_date) 
					='".$month[$index]."' and year(report_date) = '".$Year."'";
		 	$result = odbc_exec($conn,$query);
		 	if($out = odbc_fetch_array($result)){
				$value[$index] = $out['Total_Report'];
				$total_no += $value[$index];
			}
		}
        $_SESSION['value']=$value;
        $_SESSION['total_no']=$total_no;
        $_SESSION['Year']=$Year;
	}
?>
		
<!doctype html>
<html>
	<head>
    <!--Jtable-->
    <link rel="stylesheet" type="text/css" href="../jtable/themes/redmond/jquery-ui-1.8.16.custom.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/scripts/jtable/themes/metro/lightgray/jtable.css" />
    <script src="../jtable/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="../jtable/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="../jtable/scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
    <script type="text/javascript" src="../jtable/scripts/jtable/extensions/jquery.jtable.toolbarsearch.js"></script>
    <script type="text/javascript" src="../jtable/scripts/jtable/extensions/jquery.jtable.spreadsheet.js"></script>
  
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.accordion.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.all.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.base.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.button.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.dialog.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.progressbar.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.slider.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.tabs.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.theme.css" />
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
  		<script src="../js/Chart.js"></script>
  		<link rel="stylesheet" type="text/css" href="../css/chart_style.css"/>
	    <style>
			#canvas-holder{width:25%;}
		</style>

	</head>
	<body>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-sm-2"></div>
        <form method="post" action="#">
            <div class="col-sm-2">                  
                <h4 align = "right"> Enter a Year: </h4>       
            </div>
            <div class="col-sm-2">                  
                <input class="form-control" min="<?php echo $yearMin ?>" max="<?php echo $yearMax ?>" name ="Year" type="number" value="<?php echo $Year ?>"/>                        
            </div> 
            <div class="col-sm-1">
                <button type="submit" name="search"  class="btn btn-primary">SEARCH</button>
            </div>
            <div class="col-sm-2">
                <button style="background-color:#606060" type="button" name="print" onclick="printFunction()"  class="btn btn-primary">PRINT <?php echo $Year ?> Record</button>
            </div>
        </form>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h3 align = "center">Incident Reports from January <?php echo $Year?> to December <?php echo $Year?></h3>
            <h4 align = "center">Total No. of Records:  <?php echo $total_no ?></h4>
        </div>
        <div class="col-sm-2"></div>
    </div> 
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-5" id="canvas-holder" >
			<canvas id="chart-area" width="500" height="500"></canvas>			
		</div>
		<div class="col-sm-5" style = " padding-top: 1%; font-size:18px;">
			<div id="js-legend" class="chart-legend"></div>			
		</div>
    </div>
   <div class="row"><br><br></div>  


	<script>
      
	//DOUGNUT CHART
			var total_no =  <?php echo json_encode($total_no); ?>;
            var val = <?php echo json_encode($value);?>;
            var percentage = [];
            var data = [];
            var colorSet = ["#004C99","#46BFBD","#00994C","#CC6600","#404040","#660066","#CC0000","#8B4513","#008080","#800000","#FFFF00","#00CC66"]
            var highlightColor = ["#0066CC","#5AD3D1","#00CC66","#FF8000","#606060","#990099","#FF3333","#A0522D","#00CED1","#B22222","#FFFF99","#00FF80"]
            var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            var objects = [];
            for(var count = 0; count < 12; count++){
                var get_percent = (val[count] / total_no) * 100;
                percentage[count] = get_percent.toFixed(2);
                data[count] = {
                    value: percentage[count],
                    color: colorSet[count],
                     highlight: highlightColor[count],
                    label: months[count] + " : "+ val[count] + "  Incidents"
                };
     	        objects.push(data[count]);                                                                              
            }

            var settings = {
            	responsive : true,
            	animationEasing: "easeOutQuart",
            	animateRotate : true,
	            animationSteps : 100,
	            segmentShowStroke : true
            };
            var ctx = document.getElementById("chart-area").getContext("2d");
            var myDoughnut = new Chart(ctx).Doughnut(objects, settings);
            document.getElementById('js-legend').innerHTML = myDoughnut.generateLegend();

            function printFunction() {
                 window.open('../php/pdf/monthly_pdf.php', '_blank'); 
            }
 
 	
 	    </script>
	</body>
</html>

