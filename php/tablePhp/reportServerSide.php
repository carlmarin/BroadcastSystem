<?php
try
{
	require("database.php");
 	session_start();// Starting Session

	date_default_timezone_set('Asia/Manila');
    $curr_date= date("m/d/Y");


	//Getting records (listAction)
	if($_GET["action"] == "list")
	{ 
			if(empty($_POST['report_location']) &&  empty($_POST['report_date']) &&  empty($_POST['machine']) &&  empty($_POST['program']) ){
				//Get record count
				$query = "select count(*) as RecordCount from reports ";
				$result = odbc_exec($conn,$query);
				if($row = odbc_fetch_array($result))
						$recordCount = $row['RecordCount'];
					
				//Get records from database
				$rows = array();
				$query = "select report_id, report_date, report_location, machine
					      ,serial_no, program, problem, diagnosis, work_done, remarks, system_engineer 
							from reports order by report_id desc";
				$result = odbc_exec($conn,$query);
					while($out = odbc_fetch_array($result)){
						$rows[] = $out;
				}

				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				$jTableResult['TotalRecordCount'] = $recordCount;
				$jTableResult['Records'] = $rows;
				print json_encode($jTableResult);
			}else{			

				//Get record count
				$query = "select count(*) as RecordCount from reports ";
				$result = odbc_exec($conn,$query);
				if($row = odbc_fetch_array($result))
						$recordCount = $row['RecordCount'];
					
				//Get records from database
				$rows = array();
				$query = "select report_id, report_date, report_location, machine
					      ,serial_no, program, problem, diagnosis, work_done, remarks, system_engineer 
							from reports where report_location LIKE '%".$_POST['report_location']."%' and 
							report_date like '%".$_POST['report_date']."%' and 
							machine like '%".$_POST['machine']."%' 
							and program like '%".$_POST['program']."%'
							order by report_id desc";
				$result = odbc_exec($conn,$query);
					while($out = odbc_fetch_array($result)){
						$rows[] = $out;
				}

				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				$jTableResult['TotalRecordCount'] = $recordCount;
				$jTableResult['Records'] = $rows;
				print json_encode($jTableResult);
			}	
	}

   else if($_GET["action"] == "create")
	{
		//Insert record into database
		$insert = "INSERT INTO reports (report_date, machine, serial_no, report_location,
                      program, problem, diagnosis, work_done, remarks, system_engineer)
                        values('".$_POST['report_date']."', '".$_POST['machine']."', 
                        	'".$_POST['serial_no']."', '".$_POST['report_location']."', 
                            '".$_POST['program']."', '".$_POST['problem']."', 
                            '".$_POST['diagnosis']."', '".$_POST['work_done']."', 
                            '".$_POST['remarks']."', '".$_POST['system_engineer']."')";
		$stmt = odbc_exec($conn,$insert);

		//Get last inserted record (to return to jTable)

		$query = "SELECT  * FROM reports  where report_id = (select top 1 report_id from reports order by report_id desc)";
		$result = odbc_exec($conn,$query);
		$row = odbc_fetch_array($result);


		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}

	//updating a record (updateAction)
	else if($_GET["action"] == "update"){
		//Update record in database
		$update = "UPDATE reports SET report_date = '".$_POST['report_date']."', report_location = '".$_POST['report_location']."', 
					machine = '".$_POST['machine']."', serial_no = '".$_POST['serial_no']."', 
					program = '".$_POST['program']."', problem = '".$_POST['problem']."', 
					diagnosis = '".$_POST['diagnosis']."', remarks = '".$_POST['remarks']."', 
					system_engineer = '".$_POST['system_engineer']."' 
					WHERE report_id = ".$_POST['report_id']." ";
		$stmt = odbc_exec($conn,$update);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	else if($_GET["action"] == "delete"){
		//delteing record in database
		$delete = "delete from reports WHERE report_id = ".$_POST['report_id']."";
		$stmt = odbc_exec($conn,$delete);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}


	//Close database connection
	odbc_close($conn);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>