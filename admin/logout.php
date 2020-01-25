<?php
session_start();
if (isset($_SESSION['admin'])) {
    if (session_unset()) {
        $_SESSION['logout'] = "<small style='display:block' class=' text-success text-center'>Successfully logged out!</small>";
        header("location:login.php");
    }
}
else {
    header("location:login.php");
}
?>