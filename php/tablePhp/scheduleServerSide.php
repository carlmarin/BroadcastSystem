<?php

try
{
	//Open database connection
	require("database.php");
 

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
				//Get record count
				$query = "select count(*) as RecordCount from schedule ";
				$result = odbc_exec($conn,$query);
				if($row = odbc_fetch_array($result))
						$recordCount = $row['RecordCount'];
					
				//Get records from database
				$rows = array();
				$query = "select *  from schedule";
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

   else if($_GET["action"] == "create")
	{
		//Insert record into database
		$insert = "INSERT INTO schedule (name, monday, tuesday, wednesday,
                      thursday, friday, saturday, sunday)
                        values('".$_POST['name']."', '".$_POST['monday']."', 
                        	'".$_POST['tuesday']."', '".$_POST['wednesday']."', 
                            '".$_POST['thursday']."', '".$_POST['friday']."', 
                            '".$_POST['saturday']."', '".$_POST['sunday']."')";
		$stmt = odbc_exec($conn,$insert);

		//Get last inserted record (to return to jTable)

		$query = "SELECT  * FROM schedule  where sched_id = (select top 1 sched_id from schedule order by sched_id desc)";
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
		$update = "UPDATE schedule SET monday = '".$_POST['monday']."', 
					tuesday = '".$_POST['tuesday']."', 
					wednesday = '".$_POST['wednesday']."', 
					thursday = '".$_POST['thursday']."', 
					friday = '".$_POST['friday']."', 
					saturday = '".$_POST['saturday']."', 
					sunday = '".$_POST['sunday']."' 
					WHERE sched_id = ".$_POST['sched_id']." ";
		$stmt = odbc_exec($conn,$update);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	else if($_GET["action"] == "delete"){
		//delteing record in database
		$delete = "delete from schedule WHERE sched_id = ".$_POST['sched_id']."";
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