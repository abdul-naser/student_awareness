<?php
session_start();
unset($_SESSION['student_awareness']);
unset($_SESSION['employee_name']);


header('location:index.php');

exit;


?>