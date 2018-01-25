<?php
require_once 'pdf_print_handler_course.php';
require '../sourses/all_course_eve_report_helper.php';
$obj=new pdf_print_handler();
$mg_obj=new cou_eve_helper();
if (isset($_POST['pdf_ses']))
{
// Localize the veriable
$ses_txt=$_POST['pdf_ses_tx'];
$tea_txt=$_POST['pdf_tea_tx'];

$ses=$_POST['pdf_ses'];
$tea_id=$_POST['pdf_tea'];

$com=$_POST['pdf_com'];

settype($ses,"integer");
settype($tec,"integer");

// HERE Doc Strings
$txt_head_line_1=<<<EOD
Gujrat Institute of Management Sceince
EOD;
$txt_head_line_2=<<<EOD
PMAS-Arid Agriculture University, RWP
EOD;
$txt_head_line_3=<<<EOD
Proforma 01:Course Evaluation Report
EOD;
$txt_head_line_4=<<<EOD
Session:Fall-2017
EOD;
$txt_head_line_5=<<<EOD
PMAS-Arid Agriculture University, RWP
EOD;
$txt_notice_line_6=<<<EOD

  S.A:(Strongly Agree)  A:(Agree) UC:(Uncentain) D:(Disagree) S.D:(Strongly Disagree)
EOD;
$ses=7;



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
// $all_teacher=$mg_obj->get_teacher_by_session($ses);
// print_r($all_teacher);
// foreach ($all_teacher as $key => $value) {
  // echo "Outer"." ".$key."<br>";

    $class_by_teacher=$mg_obj->get_class_by_teacher_session($ses,$tea_id);

            foreach ($class_by_teacher as $keyy => $valuee) {
              // echo "Inne"." ".$keyy."<br>";
              $cls=$valuee['class_id'];
              $course_by_teacher_class=$mg_obj->get_courses_by_teacher_session($tea_id,$ses,$cls);
                          foreach ($course_by_teacher_class as $keyyy => $valueee) {
                            // echo "Offf"." ".$keyyy."<br>";
                                  // echo $value['teacher_first_name']."  ".$valuee['class_name']."   ".$valueee['course_title'];


                                  $cou=$valueee['course_id'];
                                  $report_input_param = array($tea_id,$ses,$cou,$cls);
                                  // print_r($report_input_param);
                                  // echo "<br>";
                                  $data=$obj->course_evaluation_report($report_input_param);
                                  //
                                  $question=$obj->course_evaluation_question();
                                  //
                                  // $get_total=$obj->get_total($tec,$ses,$cou,$cls);
                                  $comments=$obj->course_evaluation_comments($tea_id,$ses,$cou,$cls);

                                  $send_data[0]=$question;
                                  $send_data[1]=$data;
                                  $send_data[2]=$comments;
                                  // echo "<pre>";
                                  // print_r($comments);
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
$class=$valuee['class_name'];
$course=$valueee['course_code']." ".$valueee['course_title'];
$txt = <<<EOD
Instructer Name: Mr/Ms $ses_txt
Course: $course
Class: $class
EOD;
                                  // print a block of text using Write()
                                  $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
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
                                  for ($i=0; $i < 35; $i++) {
                                    $counter=$i+1;
                                    if ($i<29) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][2],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][3],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][4],0).'%'.'</td>';
                                      $tbl.='</tr>';
                                    }if ($i==29) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Full Time'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Part-Time'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }
                                    if ($i==30) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Yes'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'NO'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }
                                    if ($i==31) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Gujrat'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Other'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }
                                    if ($i==32) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Male'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Female'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }
                                    if ($i==33) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Less than 22'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'22-29'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Over 29'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][1],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][2],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }
                                    if ($i==34) {
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.'Collaborative'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                      $tbl.='<tr>';
                                      $tbl.='<td style="width:60%;padding:10px" ><p style="10">'."  ".$send_data[0][$i].'</p></td>';
                                      $tbl.='<td style="width:8%" align="center">'.round($send_data[1][$i][$counter][0],0).'%'.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='<td style="width:8%" align="center">'.''.'</td>';
                                      $tbl.='</tr>';
                                    }

                                    $counter=0;

                                  }
                                  $tbl.='</table>';
                                  $pdf->writeHTML($tbl, true, false, true, false, '');
                                  // $com_data1=count($send_data[2][0]);
                                  // $com_data2=count($send_data[2][1]);
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
                                  $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

//*********************************************Comments Block*************************************************
                                              if ($com==1) {  //If comments Allowed

                                                $pdf->SetFont('times', '', 11);
                                                $pdf->SetMargins(2, 3, 3);
                                                $pdf->SetMargins(25, 2, 15, true);
                                                $pdf->SetFont('times', '', 11);
                                                // <<<<<<<<<Comment Box 1 >>>>>>>>>>>>
                                                $tbl='';
                                                $tbl.='<table border="1">';
                                                $tbl.='<tr>
                                                          <th  align="" style="margin-left:10"><b>Course Content and Organization </b></th>
                                                        </tr>';
                                                  //Dynamic Data
                                                  for ($i=0; $i < count($send_data[2][0]); $i++) {
                                                    $tbl.='<tr>';
                                                    $tbl.='<td>'.$send_data[2][0][$i].'</td>';
                                                    $tbl.='</tr>';
                                                  }
                                                  $tbl.='</table>';
                                                  //print data in pdf file
                                                  $pdf->writeHTML($tbl, true, false, true, false, '');
                                                  $pdf->SetMargins(25, 2, 15, true);
                                              // <<<<<<<<<Comment Box 2 >>>>>>>>>>>>
                                                $tbl='';
                                                $tbl.='<table border="1">';
                                                $tbl.='<tr>
                                                        <th align=""><b>Student Contribution </b></th>
                                                      </tr>';
                                                  //Dynamic Data
                                                  for ($i=0; $i <count($send_data[2][1]); $i++) {
                                                    $tbl.='<tr>';
                                                    $tbl.='<td>'." ".$send_data[2][1][$i].'</td>';
                                                    $tbl.='</tr>';
                                                  }
                                                  $tbl.='</table>';
                                                  // print Data
                                                  $pdf->writeHTML($tbl, true, false, true, false, '');
                                              }
                                              // <<<<<<<<<Comment Box 3 >>>>>>>>>>>>
                                              $tbl='';
                                              $tbl.='<table border="1">';
                                              $tbl.='<tr>
                                                        <th  align="" style="margin-left:10"><b>Learning Environment and Teaching Methods </b></th>
                                                      </tr>';
                                                //Dynamic Data
                                                for ($i=0; $i <count($send_data[2][2]); $i++) {
                                                  $tbl.='<tr>';
                                                  $tbl.='<td>'.$send_data[2][2][$i].'</td>';
                                                  $tbl.='</tr>';
                                                }
                                                $tbl.='</table>';
                                                //print data in pdf file
                                                $pdf->writeHTML($tbl, true, false, true, false, '');
                                                $pdf->SetMargins(25, 2, 15, true);
                                                  // <<<<<<<<<Comment Box 4 >>>>>>>>>>>>
                                                $tbl='';
                                                $tbl.='<table border="1">';
                                                $tbl.='<tr>
                                                          <th  align="" style="margin-left:10"><b>Learning Resources</b></th>
                                                        </tr>';
                                                  //Dynamic Data
                                                  for ($i=0; $i <count($send_data[2][3]); $i++) {
                                                    $tbl.='<tr>';
                                                    $tbl.='<td>'.$send_data[2][3][$i].'</td>';
                                                    $tbl.='</tr>';
                                                  }
                                                  $tbl.='</table>';
                                                  //print data in pdf file
                                                  $pdf->writeHTML($tbl, true, false, true, false, '');
                                                  $pdf->SetMargins(25, 2, 15, true);
                                                      // <<<<<<<<<Comment Box 5 >>>>>>>>>>>>
                                                      $tbl='';
                                                      $tbl.='<table border="1">';
                                                      $tbl.='<tr>
                                                                <th  align="" style="margin-left:10"><b>Quality of Delivery</b></th>
                                                              </tr>';
                                                        //Dynamic Data
                                                        for ($i=0; $i <count($send_data[2][4]); $i++) {
                                                          $tbl.='<tr>';
                                                          $tbl.='<td>'.$send_data[2][4][$i].'</td>';
                                                          $tbl.='</tr>';
                                                        }
                                                        $tbl.='</table>';
                                                        //print data in pdf file
                                                        $pdf->writeHTML($tbl, true, false, true, false, '');
                                                        $pdf->SetMargins(25, 2, 15, true);
                                                        // <<<<<<<<<Comment Box 6 >>>>>>>>>>>>
                                                        $tbl='';
                                                        $tbl.='<table border="1">';
                                                        $tbl.='<tr>
                                                                  <th  align="" style="margin-left:10"><b>Assessment </b></th>
                                                                </tr>';
                                                          //Dynamic Data
                                                          for ($i=0; $i <count($send_data[2][5]); $i++) {
                                                            $tbl.='<tr>';
                                                            $tbl.='<td>'.$send_data[2][5][$i].'</td>';
                                                            $tbl.='</tr>';
                                                          }
                                                          $tbl.='</table>';
                                                          //print data in pdf file
                                                          $pdf->writeHTML($tbl, true, false, true, false, '');
                                                          $pdf->SetMargins(25, 2, 15, true);
                                                      // <<<<<<<<<Comment Box 7 >>>>>>>>>>>>
                                                      $tbl='';
                                                      $tbl.='<table border="1">';
                                                      $tbl.='<tr>
                                                                <th  align="" style="margin-left:10"><b>The best features of the Course were</b></th>
                                                              </tr>';
                                                        //Dynamic Data
                                                        for ($i=0; $i <count($send_data[2][6]); $i++) {
                                                          $tbl.='<tr>';
                                                          $tbl.='<td>'.$send_data[2][6][$i].'</td>';
                                                          $tbl.='</tr>';
                                                        }
                                                        $tbl.='</table>';
                                                        //print data in pdf file
                                                        $pdf->writeHTML($tbl, true, false, true, false, '');
                                                        $pdf->SetMargins(25, 2, 15, true);
                                                        // <<<<<<<<<Comment Box 8 >>>>>>>>>>>>
                                                        $tbl='';
                                                        $tbl.='<table border="1">';
                                                        $tbl.='<tr>
                                                                  <th  align="" style="margin-left:10"><b>The Course could have been improved by</b></th>
                                                                </tr>';
                                                          //Dynamic Data
                                                          for ($i=0; $i <count($send_data[2][7]); $i++) {
                                                            $tbl.='<tr>';
                                                            $tbl.='<td>'.$send_data[2][7][$i].'</td>';
                                                            $tbl.='</tr>';
                                                          }
                                                          $tbl.='</table>';
                                                          //print data in pdf file
                                                          $pdf->writeHTML($tbl, true, false, true, false, '');
                                                          $pdf->SetMargins(25, 2, 15, true);
                          }
            }
}




$pdf->Output($ses_txt.'.pdf', 'I');

//Close and output PDF document

//============================================================+
// END OF FILE
//============================================================+
// }
