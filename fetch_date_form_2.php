
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['student_awareness'])) {
    header('location: index.php');
    exit;
}




if(isset($_POST['enterprise']) && isset($_POST['date']) && isset($_POST['wilaya'])){
  $enterprise = $_POST['enterprise'];
  $wilaya = $_POST['wilaya'];
    $date = $_POST['date'];


  $sql = "SELECT * FROM  awareness_programme WHERE name_enterprise = '$enterprise' AND wilayat= '$wilaya' AND date= '$date'";
  $result = $mysqli->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo '<script>
        Swal.fire({
            title: " ' . $enterprise . ' يوجد لديها برنامج في تاريخ '.$date.'   ب ولاية ' . $wilaya . '",
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