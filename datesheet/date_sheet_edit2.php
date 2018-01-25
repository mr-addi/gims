<?php
echo " <br> string <br>";
require_once '../sourses/dat_shets_class.php';
$ds_obj=new dates_sheets();
$ret_resss="";
if (isset($_GET['term'])) {
  $term=$_GET['term'];
  $session=$_GET['session'];
  $class=$_GET['select'];
  $section=$_GET['section'];
  $res_ds=$ds_obj->get_class_date_sheet($term,$session,$class,$section);
}
if (isset($_POST['submit'])) {
  $ret_resss=$ds_obj->delete_date_sheet($term,$session,$class,$section);
  $paper_type="";
  $paper_code="";
  $paper_title="";
  $date="";
  $time_from="";
  $time_to="";
  foreach ($_POST['date_sheet'] as $key => $value) {
    foreach ($value as $ckey => $cvalue) {
      switch ($ckey) {
        case '0':
        $paper_code=$cvalue;
        break;
        case '1':
        $paper_title=$cvalue;
        break;
        case '2':
        $paper_type=$cvalue;
        break;
        case '3':
        $date=$cvalue;
        break;
        case '4':
        $time_from= date("h:i A", strtotime($cvalue));
        break;
        case '5':
        $time_to= date("h:i A", strtotime($cvalue));
        break;
        default:
        echo "<br /> switch done ".$cvalue." <br />";
        break;
      }

    }
// $dt_sht_obj->insert_date_sheet($session,$class,$section,$term,$paper_code,$paper_title,$paper_type,$date,$time_from,$time_to);
    if ($ret_resss=="true") {
      echo "donr";
      $ds_obj->insert_date_sheet($session,$class,$section,$term,$paper_code,$paper_title,$paper_type,$date,$time_from,$time_to,"edit");
    } else {
      echo $ret_resss;
    }
  }


}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Edit DS</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <div class="jumbotron">
    <ul class="nav pull_right">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../date_sheet.php">Create Date Sheet</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="date_sheet_show.php">Print Date Sheet</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Edit Date Sheet</a>
      </li>
    </ul>
  </div>
  <div class="container">
    <div class="col-md-1">

    </div>
    <div class="col-md-10">
      <form class="" action="" method="post">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Paper Code</th>
              <th>Paper Title</th>
              <th>Paper Type</th>
              <th>Date</th>
              <th>Time From</th>
              <th>Time To</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="6">
                <input type="submit" name="submit" value="UPDATE" class="btn btn-success form-control">
              </td>
            </tr>
          </tfoot>
          <tbody>

            <?php
            $i=0;
            while ($date_sheet=mysqli_fetch_assoc($res_ds)) {

              ?>
              <tr>
                <td>
                  <?= $date_sheet['paper_code'] ?>
                  <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $date_sheet['paper_code'] ?>">
                </td>
                <td>
                  <?= $date_sheet['paper_title'] ?>
                  <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $date_sheet['paper_title'] ?>">
                </td>
                <td>

                  <?php
                  if ($date_sheet['paper_type']=1) {
                    ?>
                    Theory
                    <?php
                  }else {
                    ?>
                    Practical
                    <?php
                  }
                  ?>
                  <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $date_sheet['paper_type'] ?>">
                </td>
                <td>
                  <input type="date" name="date_sheet[<?= $i ?>][]" class="form-control" value="<?= $date_sheet['date'] ?>">
                </td>
                <td>
                  <input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" value="<?php echo date("H:i", strtotime($date_sheet['time_from'])); ?>">
                </td>
                <td>
                  <input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" value="<?php echo date("H:i", strtotime($date_sheet['time_to'])); ?>">
                </td>
              </tr>

              <?php ++$i;
            }   ?>
          </tbody>
        </table>

      </form>
    </div>
  </div>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>
