<?php
    require("database.php");
    session_start();// Starting Session

    date_default_timezone_set('Asia/Manila');
    $user_check=$_SESSION['login_user'];
    $value = array();
    $distinct_machine = array();
    $loop_counter = 0;$total_no = 0;$counter = 0; $index_count= 0;
 
  


    if(isset ($_POST['search'])){
       $Year = $_POST['Year'];

    //GET TOTAL NUMBER OF YEARS AVAILABLE
    $stm = "select count(distinct (machine)) as Total_Machine from reports where 
            year(report_date) = '".$Year."'";
    $res = odbc_exec($conn,$stm);
    if($data = odbc_fetch_array($res))
            $counter = $data['Total_Machine'];

    //GET DISTINCT YEARS MINIMUM AND MAXIMUM YEARS
    $query = "select distinct machine as Distinct_Machine from reports where 
            year(report_date) = '".$Year."'";
    $result = odbc_exec($conn,$query);
    while($out = odbc_fetch_array($result)){
        $distinct_machine[$index_count] = $out['Distinct_Machine'];
        $index_count++;
    }

        for($iterration = 0; $iterration < $counter; $iterration++){
            // GET TOTAL REPORTS FOR EACH YEARS
            $query2 = "select count(*) as Total_Report from reports 
                        where machine = '".$distinct_machine[$loop_counter]."' AND 
                        year(report_date) = '".$Year."'";
            $result2 = odbc_exec($conn,$query2); 
            if($out2 = odbc_fetch_array($result2)){
                $value[$loop_counter] = $out2['Total_Report'];
                $total_no += $value[$loop_counter];
            }   
            $loop_counter++;
        }

    }else{

        //GET DISTINCT YEAR 
         $Year = date("Y");

    //GET TOTAL NUMBER OF YEARS AVAILABLE
    $stm = "select count(distinct (machine)) as Total_Machine from reports where 
            year(report_date) = '".$Year."'";
    $res = odbc_exec($conn,$stm);
    if($data = odbc_fetch_array($res))
            $counter = $data['Total_Machine'];

    //GET DISTINCT YEARS MINIMUM AND MAXIMUM YEARS
    $query = "select distinct machine as Distinct_Machine from reports where 
            year(report_date) = '".$Year."'";
    $result = odbc_exec($conn,$query);
    while($out = odbc_fetch_array($result)){
        $distinct_machine[$index_count] = $out['Distinct_Machine'];
        $index_count++;
    }

        for($iterration = 0; $iterration < $counter; $iterration++){
            // GET TOTAL REPORTS FOR EACH YEARS
            $query2 = "select count(*) as Total_Report from reports 
                        where machine = '".$distinct_machine[$loop_counter]."' AND 
                        year(report_date) = '".$Year."'";
            $result2 = odbc_exec($conn,$query2); 
            if($out2 = odbc_fetch_array($result2)){
                $value[$loop_counter] = $out2['Total_Report'];
                $total_no += $value[$loop_counter];
            }   
            $loop_counter++;
        }

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
			#canvas-holder{width:30%;}
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
                <input class="form-control" name ="Year" type="number" value="<?php echo $Year ?>"/>                        
            </div> 
            <div class="col-sm-1">
                <button type="submit" name="search"  class="btn btn-primary">SEARCH</button>
            </div>
        </form>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h3 align = "center">Machinery Reports from January <?php echo $Year?> to December <?php echo $Year?></h3>
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
            var total_no =  <?php echo json_encode($total_no);?>;
            var counter =  <?php echo json_encode($counter); ?>;
            var distinct_machine =  <?php echo json_encode($distinct_machine);?>;
            var val = <?php echo json_encode($value);?>;
            var percentage = [];
            var data = [];
            var colorSet = ["#004C99","#46BFBD","#00994C","#CC6600","#404040","#660066","#CC0000","#8B4513","#008080","#800000","#FFFF00","#00CC66"]
            var highlightColor = ["#0066CC","#5AD3D1","#00CC66","#FF8000","#606060","#990099","#FF3333","#A0522D","#00CED1","#B22222","#FFFF99","#00FF80"]
            var distinct_machine = <?php echo json_encode($distinct_machine);?>;
            var objects = [];
            for(var count = 0; count < counter; count++){
                var get_percent = (val[count] / total_no) * 100;
                percentage[count] = get_percent.toFixed(2);
                data[count] = {
                    value: percentage[count],
                    color: colorSet[count],
                     highlight: highlightColor[count],
                    label: distinct_machine[count] + " : "+ val[count] + "  Incidents"
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
            var myDoughnut = new Chart(ctx).Pie(objects, settings);
            document.getElementById('js-legend').innerHTML = myDoughnut.generateLegend();
    
        </script>
    </body>
</html>

