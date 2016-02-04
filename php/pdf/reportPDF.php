<?php
	require("database.php");
	require_once("mc_table.php");
	require_once("linegraph.php");
	require_once("diagram.php");
	require_once("/fpdf/fpdf.php");

    //$picture = "D://xampp//htdocs//BroadcastSystem//images//abs_cbn logo.png";



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
				$pdf->Cell(0,10,"List of All Reports",0,1,"C",1);
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
		
		$query = "select * from reports order by report_id asc";
		$result = odbc_exec($conn,$query);
		$counter = 1;$total = 0;
	    while($data = odbc_fetch_array($result)){
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
			$pdf->Row(array($counter, $report_date, $report_location, $machine, $serial_no,
							$program, $problem, $diagnosis, $remarks, $system_engineer ));
			$total++;
			$counter++;
		}
			  $pdf->Ln(4);
			  $pdf->Cell(0,10,"Total number of record:  ".$total,0,1,"R");	
 			 $s = $pdf->Output('file.pdf','I');
 			 // die();

?>
