<?php

namespace App\Http\Controllers\Reports;

use Codedge\Fpdf\Fpdf\Fpdf;

class PdfReport extends FPDF
{
    function Header()
    {
        // Logo 1
        $this->Image('malaybalaylogo.png',10,6,30);
        // Logo 2
        $this->Image('cdrrmologo.png',170,6,30);
        
        // Title
        $this->Ln(7);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'City Disaster Risk Reduction Management Office',0,0,'C');
        $this->Ln(7);
        $this->Cell(0,0,'Malaybalay City, Bukidnon',0,0,'C');
      
       
        // Line break
        $this->Ln(20);
    }
   
    function BasicTable($header, $data)
    {

        $this->SetFont('Arial', 'B', 11);

        // Header
        foreach($header as $col)
            $this->Cell(31.6,10,$col,1);
        $this->Ln();
        // Data

        $this->SetFont('Arial', '', 10);

        foreach($data as $col)
            $this->Cell(31.6,10,$col,1);
        $this->Ln();
    }

    function ReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);

    // Header
    foreach($header as $col)
        $this->Cell(90,10,$col,1,0,'C');
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    foreach($data as $row) {
        foreach($row as $col) {
            // Center align the cell
            $this->Cell(90,10,$col,1,0,'C');
        }
        $this->Ln();
    }
}



function RegisteredUserTable($header, $data)
{
    $this->SetFont('Arial', 'B', 9);

    $colWidths = [60, 25, 25, 25, 26, 32];

    // Header
    foreach($header as $key => $col) {
        $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
    }
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 9);
    foreach($data as $row) {
        foreach($row as $key => $col) {
            // Center align the cell
            $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
        }
        $this->Ln();
    }
}

function BarangayReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);

    // Header
    foreach($header as $col)
        $this->Cell(38,10,$col,1,0,'L');
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    foreach($data as $row) {
        foreach($row as $col) {
            $this->Cell(38,10,$col,1,0,'L');
        }
        $this->Ln(); 
    }
}

function AllReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 9);

    // Define column widths
    $colWidths = [60, 25, 25, 25, 25, 32];

    // Header
    foreach($header as $key => $col) {
        $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
    }
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 9);
    foreach($data as $row) {
        foreach($row as $key => $col) {
            // Center align the cell
            $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
        }
        $this->Ln();
    }
}



function IndividualReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 9);
    $colWidths = [60, 25, 25, 26, 24, 32];

    // Header
    foreach($header as $key => $col) {
        $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
    }
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 9);
    foreach($data as $row) {
        foreach($row as $key => $col) {
            // Center align the cell
            $this->Cell($colWidths[$key], 10, $col, 1, 0, 'L');
        }
        $this->Ln();
    }
}



function DashboardTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);
    $colWidths = [20, 90, 50, 30];
    // Header
    foreach($header as $key => $col) {
        $this->Cell($colWidths[$key], 10, $col, 1, 0, 'C');
    }
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    $colWidths = [20, 90, 50, 30];
    $count = 0;
    foreach($data as $row) {
        foreach($row as $key => $col) {
            // Center align the cell
            $this->Cell($colWidths[$key], 10, $col, 1, 0, 'C');
            $count++;
        }
        $this->Ln();
    }
}


//CHART
function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
{
    $d0 = $a - $b;
    if($cw){
        $d = $b;
        $b = $o - $a;
        $a = $o - $d;
    }else{
        $b += $o;
        $a += $o;
    }
    while($a<0)
        $a += 360;
    while($a>360)
        $a -= 360;
    while($b<0)
        $b += 360;
    while($b>360)
        $b -= 360;
    if ($a > $b)
        $b += 360;
    $b = $b/360*2*M_PI;
    $a = $a/360*2*M_PI;
    $d = $b - $a;
    if ($d == 0 && $d0 != 0)
        $d = 2*M_PI;
    $k = $this->k;
    $hp = $this->h;
    if (sin($d/2))
        $MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
    else
        $MyArc = 0;
    //first put the center
    $this->_out(sprintf('%.2F %.2F m',($xc)*$k,($hp-$yc)*$k));
    //put the first point
    $this->_out(sprintf('%.2F %.2F l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
    //draw the arc
    if ($d < M_PI/2){
        $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                    $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                    $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                    $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                    $xc+$r*cos($b),
                    $yc-$r*sin($b)
                    );
    }else{
        $b = $a + $d/4;
        $MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
        $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                    $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                    $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                    $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                    $xc+$r*cos($b),
                    $yc-$r*sin($b)
                    );
        $a = $b;
        $b = $a + $d/4;
        $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                    $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                    $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                    $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                    $xc+$r*cos($b),
                    $yc-$r*sin($b)
                    );
        $a = $b;
        $b = $a + $d/4;
        $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                    $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                    $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                    $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                    $xc+$r*cos($b),
                    $yc-$r*sin($b)
                    );
        $a = $b;
        $b = $a + $d/4;
        $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                    $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                    $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                    $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                    $xc+$r*cos($b),
                    $yc-$r*sin($b)
                    );
    }
    //terminate drawing
    if($style=='F')
        $op='f';
    elseif($style=='FD' || $style=='DF')
        $op='b';
    else
        $op='s';
    $this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3 )
{
    $h = $this->h;
    $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
        $x1*$this->k,
        ($h-$y1)*$this->k,
        $x2*$this->k,
        ($h-$y2)*$this->k,
        $x3*$this->k,
        ($h-$y3)*$this->k));
}

function PieChart($w, $h, $data, $format, $colors=null)
{
    $this->SetFont('Courier', '', 10);
    $this->SetLegends($data,$format);

    $XPage = $this->GetX();
    $YPage = $this->GetY();
    $margin = 2;
    $hLegend = 5;
    $radius = min($w - $margin * 4 - $hLegend - $this->wLegend, $h - $margin * 2);
    $radius = floor($radius / 2);
    $XDiag = $XPage + $margin + $radius;
    $YDiag = $YPage + $margin + $radius;
    if($colors == null) {
        for($i = 0; $i < $this->NbVal; $i++) {
            $gray = $i * intval(255 / $this->NbVal);
            $colors[$i] = array($gray,$gray,$gray);
        }
    }

    //Sectors
    $this->SetLineWidth(0.2);
    $angleStart = 0;
    $angleEnd = 0;
    $i = 0;
    foreach($data as $val) {
        $angle = ($val * 360) / doubleval($this->sum);
        if ($angle != 0) {
            $angleEnd = $angleStart + $angle;
            $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
            // Draw only filled area without the border
            $this->Sector($XDiag, $YDiag, $radius, $angleStart, $angleEnd, 'F');
            $angleStart += $angle;
        }
        $i++;
    }

    //Legends
    $this->SetFont('Courier', '', 10);
    $x1 = $XPage + 2 * $radius + 4 * $margin;
    $x2 = $x1 + $hLegend + $margin;
    $y1 = $YDiag - $radius + (2 * $radius - $this->NbVal*($hLegend + $margin)) / 2;
    for($i=0; $i<$this->NbVal; $i++) {
        $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
        // Draw only filled area without the border
        $this->Rect($x1, $y1, $hLegend, $hLegend, 'F');
        $this->SetXY($x2,$y1);
        $this->Cell(0,$hLegend,$this->legends[$i]);
        $y1+=$hLegend + $margin;
    }
}



function LineGraph($w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=4) {
    $this->SetFont('Courier', '', 10);
    $this->SetDrawColor(0, 0, 0);
    $this->SetLineWidth(0.2);
    $keys = array_keys($data);
    $ordinateWidth = 10;
    $w -= $ordinateWidth;
    $valX = $this->getX() + $ordinateWidth;
    $valY = $this->getY();
    $margin = 1;
    $titleH = 8;
    $titleW = $w;
    $lineh = 5;
    $keyH = count($data) * $lineh;
    $keyW = $w / 5;
    $graphValH = 5;
    $graphValW = $w - $keyW - 3 * $margin;
    $graphH = $h - (3 * $margin) - $graphValH;
    $graphW = $w - (2 * $margin) - ($keyW + $margin);
    $graphX = $valX + $margin;
    $graphY = $valY + $margin;
    $graphValX = $valX + $margin;
    $graphValY = $valY + 2 * $margin + $graphH;
    $keyX = $valX + (2 * $margin) + $graphW;
    $keyY = $valY + $margin + .5 * ($h - (2 * $margin)) - .5 * ($keyH);
    //draw single rectangle border for the entire graph area
    if (strstr($options, 'b')) {
        $this->Rect($valX, $valY, $w, $h);
    }
    //define colors
    if ($colors === null) {
        $safeColors = array(0, 51, 102, 153, 204, 225);
        for ($i = 0; $i < count($data); $i++) {
            $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)], $safeColors[array_rand($safeColors)], $safeColors[array_rand($safeColors)]);
        }
    }
    // Replace color for 'Group 1' with blue
    $colors['Group 1'] = array(0, 0, 255); // Blue color

    //form an array with all data values from the multi-dimensional $data array
    $ValArray = array();
    foreach ($data as $key => $value) {
        foreach ($data[$key] as $val) {
            $ValArray[] = $val;
        }
    }
    //define max value
    if ($maxVal < ceil(max($ValArray))) {
        $maxVal = ceil(max($ValArray));
    }
    //draw horizontal lines
    $vertDivH = $graphH / $nbDiv;
    if (strstr($options, 'H')) {
        for ($i = 0; $i <= $nbDiv; $i++) {
            if ($i < $nbDiv) {
                $this->Line($graphX, $graphY + $i * $vertDivH, $graphX + $graphW, $graphY + $i * $vertDivH);
            } else {
                $this->Line($graphX, $graphY + $graphH, $graphX + $graphW, $graphY + $graphH);
            }
        }
    }
    //draw graph lines
    foreach ($data as $key => $value) {
        $this->setDrawColor($colors[$key][0], $colors[$key][1], $colors[$key][2]);
        $this->SetLineWidth(0.8);
        $valueKeys = array_keys($value);
        for ($i = 0; $i < count($value); $i++) {
            if ($i == count($value) - 2) {
                $this->Line($graphX + ($i * $graphW / (count($value) - 1)), $graphY + $graphH - ($value[$valueKeys[$i]] / $maxVal * $graphH), $graphX + $graphW, $graphY + $graphH - ($value[$valueKeys[$i + 1]] / $maxVal * $graphH));
            } else if ($i < (count($value) - 1)) {
                $this->Line($graphX + ($i * $graphW / (count($value) - 1)), $graphY + $graphH - ($value[$valueKeys[$i]] / $maxVal * $graphH), $graphX + ($i + 1) * $graphW / (count($value) - 1), $graphY + $graphH - ($value[$valueKeys[$i + 1]] / $maxVal * $graphH));
            }
        }
    }
    //print the abscissa values
    $labelWidth = $graphW / (count($valueKeys) - 1);
    $cellWidth = 20; // Adjust this value according to your preference
    foreach ($valueKeys as $key => $value) {
        if ($key == 0) {
            $this->SetXY($graphValX, $graphValY);
            $this->Cell($cellWidth, $lineh, $value, 0, 0, 'L');
        } else if ($key == count($valueKeys) - 1) {
            $this->SetXY($graphValX + $graphValW - $cellWidth, $graphValY);
            $this->Cell($cellWidth, $lineh, $value, 0, 0, 'R');
        } else {
            $this->SetXY($graphValX + $key * $labelWidth - ($cellWidth / 2), $graphValY);
            $this->Cell($cellWidth, $lineh, $value, 0, 0, 'C');
        }
    }
    //print the ordinate values
    for ($i = 0; $i <= $nbDiv; $i++) {
        $this->SetXY($graphValX - 10, $graphY + ($nbDiv - $i) * $vertDivH - 3);
        $this->Cell(8, 6, round($maxVal / $nbDiv * $i), 0, 0, 'R');
    }
    // Draw circles for data points
    foreach ($data as $key => $value) {
        $this->setDrawColor($colors[$key][0], $colors[$key][1], $colors[$key][2]);
        foreach ($value as $x => $y) {
            if (is_numeric($x)) {
                $x_coord = $graphX + ($x * $graphW / (count($value) - 1));
                $y_coord = $graphY + $graphH - ($y / $maxVal * $graphH);
                $this->Circle($x_coord, $y_coord, 6, 'F');
            }
        }
    }

    $this->SetDrawColor(0, 0, 0);
    $this->SetLineWidth(0.2);
}



function BarDiagram($w, $h, $data, $format, $color=null, $maxVal=0, $nbDiv=4)
{
    $this->SetFont('Courier', '', 10);
    $this->SetLegends($data,$format);

    $XPage = $this->GetX();
    $YPage = $this->GetY();
    $margin = 5; // Increased margin for more space below
    $YDiag = $YPage + $margin;
    $hDiag = floor($h - $margin * 3); // Adjusted for scale values
    $XDiag = $XPage + $margin * 2 + $this->wLegend;
    $lDiag = floor($w - $margin * 3 - $this->wLegend);
    if($color == null)
        $color=array(155,155,155);
    if ($maxVal == 0) {
        $maxVal = max($data);
    }
    $valIndRepere = ceil($maxVal / $nbDiv);
    $maxVal = $valIndRepere * $nbDiv;
    $lRepere = floor($lDiag / $nbDiv);
    $lDiag = $lRepere * $nbDiv;
    $unit = $lDiag / $maxVal;
    $hBar = floor($hDiag / ($this->NbVal + 1));
    $hDiag = $hBar * ($this->NbVal + 1);
    $eBaton = floor($hBar * 80 / 100);

    $this->SetLineWidth(0.2);
    $this->Rect($XDiag, $YDiag, $lDiag, $hDiag);

    $this->SetFont('Courier', '', 10);
    $this->SetFillColor($color[0],$color[1],$color[2]);
    $i=0;
    foreach($data as $val) {
        //Bar
        $xval = $XDiag;
        $lval = (int)($val * $unit);
        $yval = $YDiag + ($i + 1) * $hBar - $eBaton / 2;
        $hval = $eBaton;
        $this->Rect($xval, $yval, $lval, $hval, 'DF');
        //Legend
        $this->SetXY(0, $yval);
        $this->Cell($xval - $margin, $hval, $this->legends[$i],0,0,'R');
        $i++;
    }

    //Scales
    for ($i = 0; $i <= $nbDiv; $i++) {
        $xpos = $XDiag + $lRepere * $i;
        $this->Line($xpos, $YDiag, $xpos, $YDiag + $hDiag);
        $val = $i * $valIndRepere;
        $xpos = $XDiag + $lRepere * $i - $this->GetStringWidth($val) / 2;
        $ypos = $YDiag + $hDiag + $margin; // Positioned even further below the graph
        $this->Text($xpos, $ypos, $val);
    }
}







function RotateText($x, $y, $text) {
    $characters = str_split($text);
    $charHeight = $this->FontSize;
    $rotation = 90;

    foreach($characters as $char) {
        $this->Text($x, $y, $char);
        $y += $charHeight;
    }
}




function SetLegends($data, $format)
{
    $this->legends=array();
    $this->wLegend=0;
    $this->sum=array_sum($data);
    $this->NbVal=count($data);
    foreach($data as $l=>$val)
    {
        $p=sprintf('%.2f',$val/$this->sum*100).'%';
        $legend=str_replace(array('%l','%v','%p'),array($l,$val,$p),$format);
        $this->legends[]=$legend;
        $this->wLegend=max($this->GetStringWidth($legend),$this->wLegend);
    }
}
















    function Footer()
    {


        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Date: '.date('m/d/Y'), 0, 0, 'L');


        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
         $this->Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'R');
    }
}

    