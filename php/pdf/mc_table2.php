<?php
require("fpdf/fpdf.php");

class PDF_MC_Tables extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}


//line graph
    function LineGraph($w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=10){
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.2);
        $keys = array_keys($data);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $this->getX()+$ordinateWidth;
        $valY = $this->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $this->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $this->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $this->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $this->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data as $key => $value){
            foreach($data[$key] as $val){
                $ValArray[]=$val;                    
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $this->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $this->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
                if($i<(count($data[$keys[0]])-1)){
                    $this->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $this->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data as $key => $value){
            $this->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $this->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $this->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $this->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $this->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $this->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $this->SetXY($keyX+8,$keyY+$n*$lineh);
            $this->Cell($keyW,$lineh,$key,0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $this->SetXY($graphValX,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $this->SetXY($graphValX+$graphValW-30,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $this->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $this->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $this->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.2);
    }
}
?>
