<?php
include 'conn.php';

session_start();

if (isset($_SESSION['student_awareness'])) {
    header('location: home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FinancialID = $_POST['FinancialID_txt'];
    $sql = "SELECT * FROM login WHERE FinancialID=?";
    // Use Object-Oriented MySQLi
    // Create a MySQLi connection
    // $mysqli = new mysqli($conn);
    
    // Check for errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    // Prepare the SQL statement
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("s", $FinancialID);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
             // Fetch the row from the result set
             $row = $result->fetch_assoc();

            $_SESSION['student_awareness'] = $FinancialID;
            $_SESSION['employee_name'] = $row['employee_name'];

            
            header('location: home.php');
            exit;
        }
        
        $stmt->close();
    }
    
    $mysqli->close();
}



?>




<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/teaching.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">


    <title>تسجيل الدخول</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">

        <div class="login-box">
            <div class="image-logo">
                <img src="images/a.png" alt="">
                <!-- <img src="images/oman_vision.jpg" alt=""> -->

                <img src="images/logo.jpg" alt="">
            </div>

<h3>دائرة التوجية المهني والارشاد الطلابي - قسم الأرشاد والتوعية</h3>
<!-- <h3>قسم الأرشاد والتوعية</h3> -->
            <h3>البرنامج التوعوي "التوعية الطلابية مسؤلوية الجميع"</h3>

            <div class="row">
                <input type="text" name="FinancialID_txt"   placeholder="ضع الرقم الوظيفي">
                <!-- <input type="password"   placeholder="ضع الرمز السري"> -->
            </div>
            <button class="submit-btn">دخول</button>
        </form>
        </div>
    </div>

   <script src="script.js"></script>

</body>
</html>