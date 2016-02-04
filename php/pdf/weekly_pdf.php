<?php
	require("database.php");
	require_once("mc_table.php");
	require_once("diagram.php");
	require_once("/fpdf/fpdf.php");
    session_start();// Starting Session

    $value=$_SESSION['value'];
    $start_day=$_SESSION['start_day'];
    $end_day=$_SESSION['end_day'];
    $date_display=$_SESSION['date_display'];
    $total_no=0;
	$array_list = array();
	$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$counter = -1;$recordCount = 0;$id = 0;

	$pdf=new PDF_MC_Table();
	$pdf->Open();
	$pdf->AddPage('L');
	//$pdf->Image($picture,20,5,20,20);
	$pdf->SetFont("Arial","B","16");
	$pdf->Cell(0,10,"Broadcast System & Maintenance",0,1,"C");
	$pdf->SetFont("Arial","","12");
	$pdf->Cell(0,10,"Technical Operation Division",0,1,"C");
	$pdf->SetFont("Arial","B","14");
	$pdf->SetXY(10,35);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFillColor(64,64,64);
	$pdf->Cell(0,10,"Weekly Reports from ".$start_day." to ".$end_day,0,1,"C",1);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont("Arial","B","12");
	$pdf->SetXY(10,50);
	$pdf->Write(5,"Rep#");
	$pdf->SetXY(30,50);
	$pdf->Write(5,"Date");
	$pdf->SetXY(50,50);
	$pdf->Write(5,"Location");
	$pdf->SetXY(75,50);
	$pdf->Write(5,"Machine");
	$pdf->SetXY(105,50);
	$pdf->Write(5,"Serial #");
	$pdf->SetXY(135,50);
	$pdf->Write(5,"Program");
	$pdf->SetXY(165,50);
	$pdf->Write(5,"Problem");
	$pdf->SetXY(190,50);
	$pdf->Write(5,"Diagnosis");
	$pdf->SetXY(220,50);
	$pdf->Write(5,"Remarks");
	$pdf->SetXY(250,50);
	$pdf->Write(5,"System Engr.");
	$pdf->Ln(7);

	for($index = 0; $index < 7 ; $index++){
       	$total_no+= $value[$index];
		$array_list += array($days[$index] => $value [$index]);		//GET VALUE FOR LINEGRAPH	
		$query = "select * from reports where report_date = 
				DATEADD(wk, DATEDIFF(wk,0,'".$date_display."'), ".$counter.")
				order by day(report_date) asc";
		$result = odbc_exec($conn,$query);
		while($data = odbc_fetch_array($result)){
			$recordCount++;
			$report_id = $data['report_id'];
            $report_date = $data['report_date'];
            $report_location = $data['report_location'];
            $machine = $data['machine'];
            $serial_no = $data['serial_no'];
            $program = $data['program'];
            $problem = $data['problem'];
            $diagnosis = $data['diagnosis'];  
            $work_done = $data['work_done'];
            $remarks = $data['remarks'];  
            $system_engineer = $data['system_engineer'];
			
			$pdf->SetFont('Arial', '', 12);
			$pdf->SetX(10);
			$pdf->SetWidths(array(15, 25, 20, 30, 30, 30, 30, 30, 30, 30, 40));
			$pdf->Row(array($recordCount, $report_date, $report_location, $machine, $serial_no,
							$program, $problem, $diagnosis, $remarks, $system_engineer ));				
		}
		$counter++;
	}
	$pdf->Ln(4);
	$pdf->Cell(0,10,"Total number of record:  ".$recordCount." reports",0,1,"R");
				  

	//LINE GRAPH
	$max = max($value);
	$pdf->AddPage('L');
	$pdf->Ln(4);
	$pdf->SetFont("Arial","B","14");
	$pdf->Cell(0,10,'Reported Incidents Flow',0,1,"C");
	$data=array( 'Reports'=> $array_list);
	$pdf->Ln(10);				
	$colors = array('Reports' => array(0,128,255));
	$pdf->LineGraph(270,100,$data,'VHkBvBgBdB',$colors,$max + 3,10);

	$pdf->SetXY(228,35);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetWidths(array(25,25));
	$pdf->Row(array('Days', 'Incident #'));
	$pdf->SetFont('Arial', '', 12);
	$yAxis = 40;
	for($loop_count = 0; $loop_count < 7; $loop_count++){
		$pdf->SetXY(228,$yAxis);
		$pdf->SetWidths(array(25,25));
		$pdf->Row(array($days[$loop_count], $value[$loop_count]));
		$yAxis+=5;
	}
	$pdf->SetXY(228,$yAxis);	
	$pdf->SetWidths(array(25,25));
	$pdf->Row(array('Total : ', $recordCount));
	$pdf->Output();
?>
