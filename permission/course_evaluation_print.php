<?php
require_once 'pdf_print_handler_course.php';

$obj=new pdf_print_handler();

if (isset($_POST['pdf_ses']))
{
$ses_txt=$_POST['pdf_ses_tx'];
$tea_txt=$_POST['pdf_tea_tx'];
$cls_txt=$_POST['pdf_cla_tx'];
$cou_txt=$_POST['pdf_cou_tx'];

$ses=$_POST['pdf_ses'];
$tec=$_POST['pdf_tea'];
$cls=$_POST['pdf_cls'];
$cou=$_POST['pdf_cou'];

$com=$_POST['pdf_com'];

settype($ses,"integer");
settype($tec,"integer");
settype($cls,"integer");
settype($cou,"integer");

$report_input_param = array($tec,$ses,$cou,$cls);
$data=$obj->course_evaluation_report($report_input_param);

$question=$obj->course_evaluation_question();

$get_total=$obj->get_total($tec,$ses,$cou,$cls);
$comments=$obj->course_evaluation_comments($tec,$ses,$cou,$cls);

$send_data[0]=$question;
$send_data[1]=$data;
$send_data[2]=$comments;

// $send_data[3]=$get_total;

// print_r($send_data);

//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * @Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public function Header($a=25,$b=6,$c=20) {

        $this->SetFont('helvetica', 'I', 20);
        // Title
        // $this->Cell(0, 0, 'GIMS Teacher Evaluation Report', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    // Page footer
    public function Footer() {
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 10, 35);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

for ($j=0; $j <3 ; $j++) {

  $pdf->AddPage();

  //*****************Summary***************//
  // set some text to print
  // $tot=$send_data[3][0];
  $pdf->SetFont('times', 'B', 16);

  // print a block of text using Write()
  $pdf->Write(0, $txt_head_line_1, '', 0, 'C', true, 0, false, false, 0);
  $pdf->SetFont('times', 'B', 20);
  // print a block of text using Write()
  $pdf->Write(0, $txt_head_line_2, '', 0, 'C', true, 0, false, false, 0);
  $pdf->SetFont('times', 'B', 14);
  // print a block of text using Write()
  $pdf->Write(0, $txt_head_line_3, '', 0, 'C', true, 0, false, false, 0);
  $pdf->SetFont('times', 'B', 12);
  // print a block of text using Write()
  $pdf->Write(0, $txt_head_line_4, '', 0, 'C', true, 0, false, false, 0);
  $pdf->SetFont('times', 'B', 11);
  // print a block of text using Write()
  $pdf->Write(0, $txt_head_line_5, '', 0, 'L', true, 0, false, false, 0);
  //*****************End***************//
  //*****************Report Table***************//
  $pdf->SetFont('times', '', 12);
  $counter=0;
  $tbl='';
  $tbl.='<table border="1" >';
  $tbl.='<tr>
      <th style="width:60%" align=""><b> Description</b></th>
      <th style="width:8%" align="center"><b>S.A</b></th>
      <th style="width:8%" align="center"><b>A</b></th>
      <th style="width:8%" align="center"><b>UC</b></th>
      <th style="width:8%" align="center"><b>D</b></th>
      <th style="width:8%" align="center"><b>S.D</b></th>
    </tr>
  ';
  for ($i=0; $i < 34; $i++) {
    $counter=$i+1;
    $tbl.='<tr>';
    $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
    $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
    $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
    $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][2],0).'%'.'</td>';
    $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][3],0).'%'.'</td>';
    $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][4],0).'%'.'</td>';
    $tbl.='</tr>';
    $counter=0;
  }
  $tbl.='</table>';
  $pdf->writeHTML($tbl, true, false, true, false, '');
  $com_data1=count($send_data[2][0]);
  $com_data2=count($send_data[2][1]);
  $pdf->SetMargins(25, 10, 15, true);

  // print a block of text using Write()
  $pdf->SetFont('times', '', 11);
  $pdf->Write(0, $txt_notice_line_6, '', 0, '', true, 0, false, false, 0);
  // @@@@@@@@@@@@@@@Comments@@@@@@@@@@@@@
  $pdf->AddPage();
  $pdf->SetMargins(25, 10, 15, true);

  // print a block of text using Write()
  $pdf->SetFont('times', 'B', 14);
  $pdf->Write(0, $txt_head_line_3, '', 0, 'C', true, 0, false, false, 0);
  // print a block of text using Write()
  $pdf->SetFont('times', 'B', 12);
  $pdf->Write(0, $txt_head_line_4, '', 0, 'C', true, 0, false, false, 0);
  // print a block of text using Write()
  $pdf->SetFont('times', 'B', 11);
  $pdf->Write(0, $txt_head_line_5, '', 0, 'L', true, 0, false, false, 0);

  //@@@@@@@@@@@@@@@@@@@@@@@@@@

  if ($com==1) {

    $pdf->SetFont('times', '', 11);
    $pdf->SetMargins(2, 3, 3);
    $pdf->SetMargins(25, 2, 15, true);

    $pdf->SetFont('times', '', 11);
    $tbl='';
    $tbl.='<table border="1">';
    $tbl.='<tr>
          <th  align="center" style="margin-left:10"><b>Comments About Instructer</b></th>
        </tr>';

      for ($i=0; $i <$com_data1; $i++) {
        $tbl.='<tr>';
        $tbl.='<td>'.$send_data[2][0][$i].'</td>';
        $tbl.='</tr>';
      }
      $tbl.='</table>';
      $pdf->writeHTML($tbl, true, false, true, false, '');
  $pdf->SetMargins(25, 2, 15, true);

    $tbl='';
    $tbl.='<table border="1">';
    $tbl.='<tr>
          <th  align="center"><b>Comments About Course</b></th>
        </tr>';

      for ($i=0; $i <$com_data2; $i++) {
        $tbl.='<tr>';
        $tbl.='<td>'." ".$send_data[2][1][$i].'</td>';
        $tbl.='</tr>';
      }
      $tbl.='</table>';
      $pdf->writeHTML($tbl, true, false, true, false, '');
  }

}
//Close and output PDF document
$pdf->Output($tea_txt.$cou_txt.'.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
  }
