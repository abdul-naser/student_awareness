
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['student_awareness'])) {
    header('location: index.php');
    exit;
}




if(isset($_POST['schoolName']) && isset($_POST['date'])){
  $schoolName = $_POST['schoolName'];
    $date = $_POST['date'];


  $sql = "SELECT * FROM  awareness_programme WHERE school_name = '$schoolName' AND date= '$date'";
  $result = $mysqli->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo '<script>
        Swal.fire({
            title: "مدرسة ' . $schoolName . ' يوجد لديها برنامج في نفس التاريخ ' . $date . '",
            icon: "warning", // You can customize the icon (success, warning, error, info, etc.)
            confirmButtonText: "حسنآ"
        });
        </script>';    } 
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();

}

?>