<?php
	require("database.php");
 	session_start();// Starting Session
    date_default_timezone_set('Asia/Manila');
	$user_check=$_SESSION['login_user'];
    $date_display = date("Y-m-d");
    $total = 0;

 

   if(isset ($_POST['search'])){
        $report_no = $_POST['report_no'];
        $reportNo = $report_no;

         $query = "select count(*) as total from reports where report_id = ".$report_no;
         $result = odbc_exec($conn,$query);
         if($row = odbc_fetch_array($result))
            $total = $row['total'];

        if($total == 0){
                $report_date = "";
                $report_location = "";
                $machine = "";
                $serial_no = "";
                $program = "";
                $problem = "";
                $diagnosis = ""; 
                $work_done = "";
                $remarks = ""; 
                $system_engineer = "";              
        }else{
             $query = "select * from reports where report_id = ".$report_no;
             $result = odbc_exec($conn,$query);
             if($row = odbc_fetch_array($result)){
                $report_date = $row['report_date'];
                $report_location = $row['report_location'];
                $machine = $row['machine'];
                $serial_no = $row['serial_no'];
                $program = $row['program'];
                $problem = $row['problem'];
                $diagnosis = $row['diagnosis'];  
                $work_done = $row['work_done'];
                $remarks = $row['remarks'];  
                $system_engineer = $row['system_engineer']; 
             }
        }         
            $_SESSION['reportNo']=$reportNo;        
    }else{
            //get last reportID
    $reportNo = 0;
     $query = "select top 1 report_id from reports order by report_id desc";
     $result = odbc_exec($conn,$query);
     if($row = odbc_fetch_array($result))
        $reportNo = $row['report_id'];

        if($reportNo == 0){
                $report_date = "";
                $report_location = "";
                $machine = "";
                $serial_no = "";
                $program = "";
                $problem = "";
                $diagnosis = ""; 
                $work_done = "";
                $remarks = ""; 
                $system_engineer = "";              
        }else{      
            $sel = "select * from reports where report_id = ".$reportNo;
            $res = odbc_exec($conn,$sel);
            if($out = odbc_fetch_array($res)){
                    $report_date = $out['report_date'];
                    $report_location = $out['report_location'];
                    $machine = $out['machine'];
                    $serial_no = $out['serial_no'];
                    $program = $out['program'];
                    $problem = $out['problem'];
                    $diagnosis = $out['diagnosis'];  
                    $work_done = $out['work_done'];
                    $remarks = $out['remarks'];  
                    $system_engineer = $out['system_engineer'];

                    $_SESSION['reportNo']=$reportNo;
            }
        }
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
	 
	</head>
	<body >
    <div class="row"><br><br><br></div>
    <div class="row">
        <form method="post" action="#">
        <div class="col-sm-6">
            <!-- ABS-CBN LOGO-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2">                  
                        <h4 align = "left"> Report #: </h4>       
                </div>
                <div class="col-sm-2">                  
                    <input class="form-control" id="report_no"  name ="report_no" type="number" value="<?php echo $reportNo ?>"  min="1"/>                        
                </div>  
                <div class="col-sm-5">                  
                    <button type="submit" name="search"  class="btn btn-primary">Search</button> 
                    <button type="button" name="print" onclick="printFunction()" class="btn btn-primary">Print</button>                        
                </div>    
                <div class="col-sm-1"></div>        
            </div><br>

            <!--Date and Location Field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2">                  
                        <h4 align = "left"> Date: </h4>       
                </div>
                <div class="col-sm-4">                  
                    <input disabled class="form-control" id="reportDate" name ="date_picker" value="<?php echo $report_date ?>" type="date"/>                        
                </div>     
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Location: </h4>       
                </div>
                <div class="col-sm-3">                  
                    <input disabled class="form-control" value="<?php echo $report_location ?>" name ="location" type="text" />                      
                </div>
                <div class="col-sm-1"></div>        
            </div><br>

            <!--Machine and Serial no field-->
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Machine: </h4>       
                </div>
                <div class="col-sm-4">                  
                    <input disabled class="form-control" value="<?php echo $machine ?>" name ="machine" type="text" />
                </div> 
                 <div class="col-sm-1"  allign="left">                  
                        <h4 align = "left"> Serial: </h4>       
                </div>
                <div class="col-sm-4">                  
                    <input disabled class="form-control" value="<?php echo $serial_no ?>" name ="serial_no" type="text" />
                </div>             
            </div><br>

            <!--Program field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Program: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input disabled class="form-control" value="<?php echo $program ?>" name ="program" type="text" />                       
                </div>            
            </div><br>

            <!--Problem field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Problem: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input disabled class="form-control" value="<?php echo $problem ?>" name ="problem" type="text" />                       
                </div>            
            </div><br>

            <!--Diagnosis field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Diagnosis: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input disabled class="form-control" value="<?php echo $diagnosis ?>" name ="diagnosis" type="text" />                       
                </div>            
            </div><br>
       </div>
        
        <!--Work Done Field-->
       <div class="col-sm-6"><br><br>
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-10"  allign="left">                  
                        <h4 align = "left"> Work Done: </h4>       
                </div>
               <div class="col-sm-1"></div>
            </div>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-7">                  
                    <textarea disabled rows="10" name="workDone" cols="60" style="resize: none;" class="form-control"><?php echo $work_done; ?></textarea>                 
                </div> 
                 <div class="col-sm-3"></div>
            </div><br>

            <!--Remarks field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-3"  allign="left">                  
                        <h4 align = "left"> Remarks: </h4>       
                </div>
                <div class="col-sm-4">                  
                     <input disabled class="form-control" value="<?php echo $remarks ?>" name ="remarks" type="text" />                       
                </div> 
                 <div class="col-sm-5"></div>
            </div>

            <!--System Engineer field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-3"  allign="left">                  
                        <h4 align = "left"> System Engineer: </h4>       
                </div>
                <div class="col-sm-5">                  
                     <input disabled class="form-control" value="<?php echo $system_engineer ?>" name ="engineer" type="text" />                       
                </div> 
                 <div class="col-sm-3"></div>
            </div><br>



        </div>
    </form>
   </div>


    <div class="row"></div>

    <script>
            function printFunction() {
                 window.open('../php/pdf/singleReport.php', '_blank'); 
            }
    </script>

	</body>
</html>

