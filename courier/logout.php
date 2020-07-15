<?php
session_start();
if ($_SESSION['courier']) {
    session_unset();
    header("location:index.php");
}
?>