<?php
        session_start();
        if (isset($_SESSION['user_id'])&&$_SESSION['user_id']!=NULL) {
            $_SESSION['user_id']=NULL;
            session_destroy();
        }
        redirect("../student_login.php");

    function redirect($url) { //deffining the redirect function
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
      }
?>