<?php

try
{
	//Open database connection
	require("database.php");
 

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		if(empty($_POST['date_place']) &&  empty($_POST['current_location']) &&  empty($_POST['machine_name'])){
			
				//Get record count
				$query = "select count(*) as RecordCount from machine ";
				$result = odbc_exec($conn,$query);
				if($row = odbc_fetch_array($result))
						$recordCount = $row['RecordCount'];
					
				//Get records from database
				$rows = array();
				$query = "select machine_id, machine_name, machine_model, serial_no, current_location,
						          date_place, history from machine order by current_location ";
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
				$query = "select count(*) as RecordCount from machine ";
				$result = odbc_exec($conn,$query);
				if($row = odbc_fetch_array($result))
						$recordCount = $row['RecordCount'];
					
				//Get records from database
				$rows = array();
				$query = "select machine_id, machine_name, machine_model, serial_no, current_location,
						  date_place, history from machine where machine_name like '%".$_POST['machine_name']."%' and 
						  current_location like '%".$_POST['current_location']."%' and 
						  date_place like '%".$_POST['date_place']."%'
						  order by current_location ";
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

   if($_GET["action"] == "create")
	{
		//Insert record into database
		$insert = "INSERT INTO machine (machine_name, machine_model, serial_no, current_location,
			       date_place, history) values('".$_POST['machine_name']."', '".$_POST['machine_model']."', 
                   '".$_POST['serial_no']."', '".$_POST['current_location']."', 
                   '".$_POST['date_place']."', '".$_POST['current_location']." : ".$_POST['date_place']."' )";
		$stmt = odbc_exec($conn,$insert);

		//Get last inserted record (to return to jTable)

		$query = "SELECT  * FROM machine  where machine_id = (select top 1 machine_id from machine order by machine_id desc)";
		$result = odbc_exec($conn,$query);
		$row = odbc_fetch_array($result);


		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}

	//Updating a record (updateAction)
	if($_GET["action"] == "update"){
		//select history
		$sel = "select history from machine where machine_id = ".$_POST['machine_id'];
		$res = odbc_exec($conn,$sel);
		if($out = odbc_fetch_array($res))
				$newHistory = $out['history'];

		//Update record in database
		$update = "UPDATE machine SET date_place = '".$_POST['date_place']."', 
					current_location = '".$_POST['current_location']."',
					history = '".$_POST['current_location']." : 
					".$_POST['date_place'].", ".$newHistory."'
					WHERE machine_id = ".$_POST['machine_id']." ";
		$stmt = odbc_exec($conn,$update);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	else if($_GET["action"] == "delete"){
		//delteing record in database
		$delete = "delete from machine WHERE machine_id = ".$_POST['machine_id']."";
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