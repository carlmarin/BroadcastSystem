<?php
	require("database.php");
	require_once("mc_table.php");
	require_once("linegraph.php");
	require_once("diagram.php");
	require_once("/fpdf/fpdf.php");
	session_start();

	$reportNo=$_SESSION['reportNo']; 

        $query = "select count(*) as total from reports where report_id = ".$reportNo;
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
			$query = "select * from reports where report_id = ".$reportNo;
			$result = odbc_exec($conn,$query);
			$counter = 1;$total = 0;
		    if($data = odbc_fetch_array($result)){
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
	        }
	    }

				$pdf=new PDF_MC_Table();
				$pdf->Open();
				$pdf->AddPage();
				//$pdf->Image($picture,20,5,20,20);
				$pdf->SetFont("Arial","B","16");
				$pdf->Cell(0,10,"Broadcast System & Maintenance",0,1,"C");
				$pdf->SetFont("Arial","","12");
				$pdf->Cell(0,10,"Technical Operation Division",0,1,"C");
			  	$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,40);
				$pdf->Cell(0,10,"Date: " ,0,1);
				$pdf->SetFont("Arial","B","14");
				$pdf->SetXY(25,40);
				$pdf->Cell(0,10,$report_date ,0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,60);
				$pdf->Cell(0,10,"Location: ",0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(40,60);
				$pdf->Cell(0,10,"    ".$report_location."    " ,0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,70);
				$pdf->Cell(0,10,"Program: " ,0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(40,70);
				$pdf->Cell(0,10,"    ".$program."    " ,0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(110,60);
				$pdf->Cell(0,10,"Machine: " ,0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(135,60);
				$pdf->Cell(0,10,"    ".$machine."    ",0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(110,70);
				$pdf->Cell(0,10,"Serial #: " ,0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(135,70);
				$pdf->Cell(0,10,"    ".$serial_no."    ",0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,85 );
				$pdf->Cell(0,10,"Problem: " ,0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(40,85);
				$pdf->Cell(0,10,"        ".$problem."        ",0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,95);
				$pdf->Cell(0,10,"Diagnosis: " ,0,1);
				$pdf->SetFont("Arial","U","14");
				$pdf->SetXY(40,95);
				$pdf->Cell(0,10,"        ".$diagnosis."        ",0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(10,110);
				$pdf->Cell(0,10,"Work Done: " ,0,1);
				$pdf->SetFont("Arial","","14");
				$pdf->SetXY(40,120);
				$pdf->SetWidths(array(150));
			    $pdf->Row(array("\n".$work_done."\n"));

				$pdf->SetFont("Arial","","14");
				$pdf->Ln(10);
				$pdf->Cell(0,10,"Remarks: ".$remarks ,0,1);

				$pdf->SetFont("Arial","","14");
				$pdf->Ln(5);
				$pdf->Cell(0,10,"System Engineer:    ".$system_engineer,0,1);		

			
	
 			  $pdf->output();

?>
