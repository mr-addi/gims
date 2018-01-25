<?php
/*
** this page recievs the ajax request
** recieve the teacher id and session id
** return the class course and section 
*/
check_is_ajax( __FILE__ ); //function to check if the request is ajax
function check_is_ajax( $script = '' ) { //defination of function to check ajax call
  $is_ajax = isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
  strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';
  if( !$is_ajax ) {
    trigger_error( 'Access denied - not an AJAX request...' . ' (' . $script . ')', E_USER_ERROR );
  }
}
require_once('dbconnection.php'); //including the database connection   
require_once('teachers_class.php');//teacher Class
$teach_id  = $_POST['param1']; //recieving teacher id as parameter 1
$sess_id   = $_POST['param2']; //recieving session id as parameter 2
$teach_obj = new teacher();
$result=$teach_obj->get_cls_crs_etc($teach_id,$sess_id);

?>
<table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Course code</th>
                    <th>course title</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        while ($data_res=mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                            <td><?= $data_res['class_name'] ?></td>
                            <td><?= $data_res['class_section'] ?></td>
                            <td><?= $data_res['course_code'] ?></td>
                            <td><?= $data_res['course_title'] ?></td>
                            <td><a href="../teacher/delete_teach_crss.php?t_id=<?= $teach_id ?>&sess_id=<?= $sess_id ?>&class_id=<?= $data_res['class_id'] ?>&course_id=<?= $data_res['course_id'] ?>&sect=<?= $data_res['class_section'] ?>" class="btn btn-danger">DELETE</a></td>
                            </tr>
                        <?php 
                        }
                        ?>
                </tbody>
</table>
<?php
exit;
?>
