<?php
	require("database.php");
 	session_start();// Starting Session
    date_default_timezone_set('Asia/Manila');
	$user_check=$_SESSION['login_user'];
    $date_display = date("Y-m-d");

  if(isset ($_POST['ok'])){
        $date_picker = $_POST['date_picker'];
        $location = $_POST['location'];
        $machine = $_POST['machine'];
        $serial_no = $_POST['serial_no'];
        $program = $_POST['program'];
        $problem = $_POST['problem'];
        $diagnosis = $_POST['diagnosis'];  
        $workDone = $_POST['workDone'];
        $remarks = $_POST['remarks'];  
        $engineer = $_POST['engineer'];     

            $query = "INSERT INTO reports (report_date, machine, serial_no, report_location,
                      program, problem, diagnosis, work_done, remarks, system_engineer)
                        values('".$date_picker."', '".$machine."', '".$serial_no."', '".$location."', 
                            '".$program."', '".$problem."', '".$diagnosis."', '".$workDone."', '".$remarks."'
                            , '".$engineer."')";
            $result = odbc_exec($conn,$query);
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
	<body  style="background-color:#e0e0e0;">
    <div class="row"><br><br><br></div>
    <div class="row">
        <form method="post" action="#">
        <div class="col-sm-6">
            <!-- ABS-CBN LOGO-->
            <div class="row"> 
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <img src="../images/ABS_CBNlogo.jpg" style="height: 10%; width:10%;" />
                </div>              
            </div><br>

            <!--Date and Location Field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2">                  
                        <h4 align = "left"> Date: </h4>       
                </div>
                <div class="col-sm-4">                  
                    <input class="form-control" id="reportDate" name ="date_picker" type="date" value="<?php echo $date_display ?>"/>                        
                </div>     
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Location: </h4>       
                </div>
                <div class="col-sm-3">                  
                    <select class="form-control" name="location">
                        <option value=""></option>
                        <option value="Studio 1">Studio 1</option>
                        <option value="Studio 2">Studio 2</option>
                        <option value="Studio 3">Studio 3</option>
                        <option value="Studio 4">Studio 4</option>
                        <option value="Studio 5">Studio 5</option>
                        <option value="Studio 6">Studio 6</option>
                        <option value="Studio 7">Studio 7</option>
                        <option value="Studio 8">Studio 8</option>
                        <option value="Studio 9">Studio 9</option>
                        <option value="Studio 10">Studio 10</option>
                        <option value="OB Van 1">OB Van 1</option>
                        <option value="OB Van 2">OB Van 2</option>
                        <option value="OB Van 3">OB Van 3</option>
                        <option value="OB Van 4">OB Van 4</option>
                        <option value="OB Van 5">OB Van 5</option>
                        <option value="OB Van 6">OB Van 6</option>
                        <option value="OB Van 7">OB Van 7</option>
                        <option value="OB Van 8">OB Van 8</option>
                        <option value="OB Van 9">OB Van 9</option>
                        <option value="OB Van 10">OB Van 10</option>
                        <option value="Grandia 1">Grandia 1</option>
                        <option value="Grandia 2">Grandia 2</option>
                        <option value="Grandia 3">Grandia 3</option>
                        <option value="Grandia 4">Grandia 4</option>
                        <option value="Grandia 5">Grandia 5</option>
                  </select>                        
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
                    <input class="form-control" name ="machine" type="text" />
                </div> 
                 <div class="col-sm-1"  allign="left">                  
                        <h4 align = "left"> Serial: </h4>       
                </div>
                <div class="col-sm-4">                  
                    <input class="form-control" name ="serial_no" type="text" />
                </div>             
            </div><br>

            <!--Program field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Program: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input class="form-control" name ="program" type="text" />                       
                </div>            
            </div><br>

            <!--Problem field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Problem: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input class="form-control" name ="problem" type="text" />                       
                </div>            
            </div><br>

            <!--Diagnosis field-->
            <div class="row">
                <div class="col-sm-1"></div>
                 <div class="col-sm-2"  allign="left">                  
                        <h4 align = "left"> Diagnosis: </h4>       
                </div>
                <div class="col-sm-9">                  
                     <input class="form-control" name ="diagnosis" type="text" />                       
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
                    <textarea rows="10" name="workDone" cols="50" style="resize: none;" class="form-control"></textarea>                 
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
                     <input class="form-control" name ="remarks" type="text" />                       
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
                     <input class="form-control" name ="engineer" type="text" />                       
                </div> 
                 <div class="col-sm-3"></div>
            </div><br>

            <div class="row">
                <div class="col-sm-8"></div>
                 <div class="col-sm-3"  allign="left">                  
                        <button type="submit" name="ok"  class="btn btn-primary">Submit</button>      
                        <button type="reset" name="clear"  class="btn btn-primary">Clear</button>
                </div> 
                <div class="col-sm-1"></div>
            </div>
            <div class="row"><br><br><br><br></div>

        </div>
    </form>
   </div>


    <div class="row"></div>

	</body>
</html>

