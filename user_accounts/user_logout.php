<?php
        session_start();
       
        if (isset($_SESSION)) {
            unset($_SESSION['perm']);

            session_destroy();

        }
        redirect("../");

    function redirect($url) { //deffining the redirect function
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
      }
?>