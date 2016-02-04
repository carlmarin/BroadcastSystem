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
        $studioValue = array();$obValue = array();$counter = 0;$totalStudio=0;$totalOB=0;
        $max=0; $total = 0;
        //TOTAL STUDIO
        for($index = 0; $index < 12 ; $index++){
            $query = "select count(*) Total_Report from reports where  DATENAME(MM,report_date) 
                    ='".$month[$index]."' and year(report_date) = '".$Year."' and report_location like '%Studio%'";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $studioValue[$index] = $out['Total_Report'];
                $totalStudio += $studioValue[$index];
                $total++;
            }
        }
        //TOTAL OB VAN
        for($index = 0; $index < 12 ; $index++){
            $query = "select count(*) Total_Report from reports where  DATENAME(MM,report_date) 
                    ='".$month[$index]."' and year(report_date) = '".$Year."' and report_location like '%OB Van%'";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $obValue[$index] = $out['Total_Report'];
                $totalOB += $obValue[$index];
                $total++;
            }
        }

        $max = max($obValue) + max($studioValue);
	}else{
		$studioValue = array();$obValue = array();$counter = 0;$totalStudio=0;$totalOB=0;
		$Year = date("Y");$max=0; $total = 0;
        //TOTAL STUDIO
        for($index = 0; $index < 12 ; $index++){
			$query = "select count(*) Total_Report from reports where  DATENAME(MM,report_date) 
					='".$month[$index]."' and year(report_date) = '".$Year."' and report_location like '%Studio%'";
		 	$result = odbc_exec($conn,$query);
		 	if($out = odbc_fetch_array($result)){
				$studioValue[$index] = $out['Total_Report'];
				$totalStudio += $studioValue[$index];
                $total++;
			}
		}
        //TOTAL OB VAN
        for($index = 0; $index < 12 ; $index++){
            $query = "select count(*) Total_Report from reports where  DATENAME(MM,report_date) 
                    ='".$month[$index]."' and year(report_date) = '".$Year."' and report_location like '%OB Van%'";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $obValue[$index] = $out['Total_Report'];
                $totalOB += $obValue[$index];
                $total++;
            }
        }

        $max = max($obValue) + max($studioValue);
	}
?>
		
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
  		<script src="../js/Chart.js"></script>
  		<link rel="stylesheet" type="text/css" href="../css/chart_style.css"/>
        <link rel="stylesheet" href="../css/navVertical.css" type="text/css">

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
            <div class="col-sm-2">
                <button type="submit" name="search"  class="btn btn-primary">SEARCH</button>
            </div>
        </form>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h3 align = "center">Location Reports from January <?php echo $Year?> to December <?php echo $Year?></h3>
            <h4 align = "center">Total No. of Records:  <?php echo $total ?></h4>
        </div>
        <div class="col-sm-2"></div>
    </div> 
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h4 align="center"><button id="box" style="background-color:#0066cc;" disabled></button>Studio - <?php echo $totalStudio ?> record
                 <button  id="box" style = "background-color:#00994c" disabled></button>OB Van - <?php echo $totalOB ?> record</h4>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row" >
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
               <canvas id="bar-graph" height="420" width="700"></canvas>
        </div>
        <div class="col-sm-2"></div>
    </div>
   <div class="row"><br><br></div>  


	<script>
      
    //Bar GRAPH
     var studioValue = <?php echo json_encode($studioValue);?>;
     var obValue = <?php echo json_encode($obValue);?>;
     var max = <?php echo json_encode($max);?>;
        var barChartData = {
            labels : ['January','February','March','April','May','June','July','August','September','October','November','December'],
             datasets : [
                  {
                    label: "My First dataset",
                    fillColor: "rgba(0,102,204,.7)",
                    strokeColor: "rgba(0,102,204,.1)",
                    highlightFill: "#3399ff",
                    highlightStroke: "rgba(0,102,204,.9)",
                    data: studioValue
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(0,128,0,.7)",
                    strokeColor: "rgba(0,102,204,.1)",
                    highlightFill: "#008000",
                    highlightStroke: "rgba(0,128,0,.9)",
                    data: obValue
                }]
        }
        var bar = document.getElementById("bar-graph").getContext("2d");
        window.myLine = new Chart(bar).Bar(barChartData, {
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(160,160,160,.4)",
            animation:true,
            scaleOverride:true,
            scaleSteps:max,
            scaleStartValue:0,
            scaleStepWidth:1
        });
 	
 	    </script>
	</body>
</html>

