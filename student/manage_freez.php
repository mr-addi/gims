<?php
/*
|This Page allow the admin to Freeze or Un Freeze the Statur od Individual Student
|NO Direct Access To This Page
|
*/
session_start();
$student_id=$_SESSION['student'];

$title="Manage Freez Student";
$home="../index.php";
$active="Manage Freez";
$next_link="admin_student_action.php";
$next_content="Profile";
require '../sourses/header.php';
 ?>
