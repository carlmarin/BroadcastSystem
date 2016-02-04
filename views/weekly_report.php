<?php
    require("database.php");

    session_start();// Starting Session
    date_default_timezone_set('Asia/Manila');
    $user_check=$_SESSION['login_user'];
    $date_display = date("Y-m-d");
    $value = array(); 
    $counter = -1;
    $total_no = 0;

    if(isset ($_POST['search'])){
        $date_picker = $_POST['date_picker'];
        $date_display = $date_picker;
        $counter = -1;
        $total_no = 0;
        $studio_total = 0;
        $ob_total = 0;
        //GET DATA FOR A WEEK DYNAMICALLY
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as Total_Report FROM reports WHERE report_date = 
                       DATEADD(wk, DATEDIFF(wk,0,'".$date_picker."'), ".$counter.")";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $value[$index] = $out['Total_Report'];
                $total_no+= $value[$index];
            }
            $counter++;
        }

        $counter = -1;
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as TotalStudio FROM reports WHERE report_date = 
                       DATEADD(wk, DATEDIFF(wk,0,'".$date_picker."'), ".$counter.")and report_location like '%Studio%' ";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $studVal[$index] = $out['TotalStudio'];
                $studio_total+= $studVal[$index];
            }
            $counter++;
        }

        $counter = -1;
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as TotalOB FROM reports WHERE report_date = 
                       DATEADD(wk, DATEDIFF(wk,0,'".$date_picker."'), ".$counter.") and report_location like %'OB Van'%";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $obVal[$index] = $out['TotalOB'];
                $ob_total+= $obVal[$index];
            }
            $counter++;
        }

        //GET STARTING AND END DAY FOR A DYNAMIC WEEK   
        $query = "SELECT left(DATEADD(wk, DATEDIFF(wk,0,'".$date_picker."'), -1),11) as StartDay, left(DATEADD(wk, DATEDIFF(wk,0,'".$date_picker."'), 5),11) as EndDay";
        $result = odbc_exec($conn,$query);
        if($out = odbc_fetch_array($result)){
            $start_day = $out['StartDay'];
            $end_day = $out['EndDay'];
        }
        //pass this variables
        $_SESSION['value']=$value;
        $_SESSION['start_day']=$start_day;
        $_SESSION['end_day']=$end_day;
        $_SESSION['date_display']=$date_picker;
    //FIRST RUN      
    }else{
        $studio_total = 0;
        $ob_total = 0;
        //VALUE DATA ON CURRENT WEEK
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as Total_Report FROM reports WHERE report_date = 
                    DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), ".$counter.")";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $value[$index] = $out['Total_Report'];
                $total_no+= $value[$index];
            }
            $counter++;
        }

        $counter = -1;
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as TotalStudio FROM reports WHERE report_date = 
                       DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), ".$counter.") and report_location like '%Studio%'";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $studVal[$index] = $out['TotalStudio'];
                $studio_total+= $studVal[$index];
            }
            $counter++;
        }

        $counter = -1;
        for($index = 0; $index < 7 ; $index++){
            $query = "SELECT count(*) as TotalOB FROM reports WHERE report_date = 
                       DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), ".$counter.") and report_location like '%OB Van%'";
            $result = odbc_exec($conn,$query);
            if($out = odbc_fetch_array($result)){
                $obVal[$index] = $out['TotalOB'];
                $ob_total+= $obVal[$index];
            }
            $counter++;
        }
        //VALUE FOR STARTING AND END DAY OF CURRENT WEEK
        $query = "SELECT left(DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), -1),11) as StartDay, left(DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), 5),11) as EndDay";
        $result = odbc_exec($conn,$query);
        if($out = odbc_fetch_array($result)){
            $start_day = $out['StartDay'];
            $end_day = $out['EndDay'];
        }
        //pass this variables
        $_SESSION['value']=$value;
        $_SESSION['start_day']=$start_day;
        $_SESSION['end_day']=$end_day;
        $_SESSION['date_display']= date("Y-m-d");
  }
   $max = max($value);
?>


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
     <link rel="stylesheet" href="../css/navVertical.css" type="text/css">
   
  </head>
  <body>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-sm-2"></div>
        <form method="post" action="#">
            <div class="col-sm-2">                  
                <h4 align = "center"> Select a week: </h4>       
            </div>
            <div class="col-sm-3">                  
                <input class="form-control" id="meeting" name ="date_picker" type="date" value="<?php echo $date_display ?>"/>                        
            </div> 
            <div class="col-sm-1">
                <button type="submit" name="search"  class="btn btn-primary">SEARCH</button>
            </div>
            <div class="col-sm-1">
                <button id="print" style="background-color:#606060" type="button" name="print"  onclick="printFunction()" class="btn btn-primary">PRINT PDF</button>
            </div>
        </form>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h3 align = "center">Incident Reports from <?php echo $start_day?> to <?php echo $end_day?></h3>
            <h4 align = "center">Total No. of Records:  <?php echo $total_no ?>
        </div>
        <div class="col-sm-2"></div>
    </div> 
    <div class="row" >
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
                <canvas id="line-graph" height="420" width="700"></canvas>
        </div>
        <div class="col-sm-2"></div>
    </div><br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h3 align = "center">Studio and OB Van Reports</h3>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">          
            <h4 align="center"><button  id="box" style="background-color:#0066cc;" disabled></button>Studio - <?php echo $studio_total ?> record
                 <button  id="box" style = "background-color:#00994c" disabled></button>OB Van - <?php echo $ob_total ?> record</h4>
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
    //LINE GRAPH
     var values = <?php echo json_encode($value);?>;
     var max = <?php echo json_encode($max);?>;
        var lineChartData = {
            labels : ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
             datasets : [
                {
                    label: 'Incident Report',
                    fillColor : "rgba(220,220,220,0.2)",
                    strokeColor : "rgba(0,128,255,1)",
                    pointColor : "rgba(0,153,0,1)",
                    pointStrokeColor : "#606060",
                    pointHighlightFill : "#000066",
                    pointHighlightStroke : "rgba(204,102,0,1)",
                    data : values
                }
            ]
        }
        var line = document.getElementById("line-graph").getContext("2d");
        window.myLine = new Chart(line).Line(lineChartData, {
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(160,160,160,.4)",
            animation:true,
            scaleOverride:true,
            scaleSteps:max,
            scaleStartValue:0,
            scaleStepWidth:1
        });

    //Bar GRAPH
     var studVal = <?php echo json_encode($studVal);?>;
     var obVal = <?php echo json_encode($obVal);?>;
     var max = <?php echo json_encode($max);?>;
        var barChartData = {
            labels : ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
             datasets : [
                  {
                    label: "My First dataset",
                    fillColor: "rgba(0,102,204,.7)",
                    strokeColor: "rgba(0,102,204,.1)",
                    highlightFill: "#3399ff",
                    highlightStroke: "rgba(0,102,204,.9)",
                    data: studVal
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(0,128,0,.7)",
                    strokeColor: "rgba(0,102,204,.1)",
                    highlightFill: "#008000",
                    highlightStroke: "rgba(0,128,0,.9)",
                    data: obVal
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

 
            function printFunction() {
                 window.open('../php/pdf/weekly_pdf.php', '_blank'); 
            }

        </script> 

    </body>
</html>
