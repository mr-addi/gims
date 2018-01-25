
<?php
if (isset($_GET['msg'])) {
    echo "<script> alert('".$_GET['msg']."'); </script>";
} 
    require_once("../sourses/teachers_class.php");
    $teach_obj=new teacher();
    $t_id=$_GET['t_id'];
    $ses_id=$_GET['sess_id'];
    $cls_id=$_GET['class_id'];
    $crs_id=$_GET['course_id'];
    $se=$_GET['sect'];

    $res=$teach_obj->delete_teach_crs($t_id,$ses_id,$cls_id,$crs_id,$se);

    if($res==true){

        header("location: courses_teacher.php?tech_id=$t_id&msg=successfuly deleted");

    }else{
        header("location: courses_teacher.php?tech_id=$t_id&msg=error in deleting");
    }

?>
