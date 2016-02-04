<?php
	require("database.php");
	require_once("mc_table.php");
	require_once("diagram.php");
	require_once("/fpdf/fpdf.php");
    session_start();// Starting Session

    $value=$_SESSION['value'];
    $total_no = $_SESSION['total_no'];
    $Year = $_SESSION['Year'];
    $recordCount = 0;
	$month = array('January','February','March','April','May','June','July','August','September','October','November','December');


	$pdf = new PDF_Diagram();
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
	$pdf->Cell(0,10,"Incident Reports from January ".$Year." to December ".$Year,0,1,"C",1);
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


		$query = "select * from reports where year(report_date) = ".$Year." 
					order by report_date asc";
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
	$pdf->Ln(4);
	$pdf->Cell(0,10,"Total number of record:  ".$recordCount." reports",0,1,"R");


	//VALUES PER MONTH
	$data = array($month[0].': '.$value[0].' record' => $value[0], 
		          $month[1].': '.$value[1].' record' => $value[1], 
		          $month[2].': '.$value[2].' record' => $value[2],
				  $month[3].': '.$value[3].' record' => $value[3], 
				  $month[4].': '.$value[4].' record' => $value[4], 
				  $month[5].': '.$value[5].' record' => $value[5],
				  $month[6].': '.$value[6].' record' => $value[6], 
				  $month[7].': '.$value[7].' record' => $value[7], 
				  $month[8].': '.$value[8].' record' => $value[8],
				  $month[9].': '.$value[9].' record' => $value[9], 
				  $month[10].': '.$value[10].' record' => $value[10], 
				  $month[11].': '.$value[11].' record' => $value[11]);
	
	//COLOR CODINGS PER MONTH
	$color = array( array(0,76,153), array(0,204,204), array(0,153,76), array(204,102,0),
					array(64,64,64), array(76,0,153), array(255,51,51),	array(139,69,19),
					array(0,128,128), array(128,0,0), array(204,204,0), array(102,255,102));

		$pdf->AddPage('L');
		$pdf->Ln(4);
		$pdf->SetFont("Arial","B","16");
		$pdf->Cell(0,10,"Broadcast System & Maintenance",0,1,"C");
		$pdf->SetFont("Arial","","12");
		$pdf->Cell(0,10,"Technical Operation Division",0,1,"C");
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFillColor(64,64,64);
		$pdf->SetFont("Arial","B","14");
		$pdf->Cell(0,10,"Statistics Reports".$Year,0,1,"C",1);
		$pdf->SetTextColor(0,0,0);
		$pdf->Ln(5);
		$valX = $pdf->GetX();
		$valY = $pdf->GetY();
		$pdf->SetXY(40, $valY);	
		$pdf->PieChart(400, 110, $data, '%l (%p)', $color);


				  
	$pdf->Output();
?>
