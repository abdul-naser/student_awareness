<?php
include 'conn.php';
if (isset($_POST['schoolName'])) {
    $schoolName = $_POST['schoolName'];

    $sql_city = "SELECT code, name, wilayat FROM schools WHERE name=?";
    $query_city = $mysqli->prepare($sql_city);
    $query_city->bind_param("s", $schoolName); // Bind the parameter with the actual value

    // Execute the query
    if ($query_city->execute()) {
        // Bind the result to variables
        $query_city->bind_result($code, $name, $wilayat);

        // Fetch and print the results
        while ($query_city->fetch()) {
            echo  json_encode(['wilayat' => $wilayat, 'code' => $code]);
        }
    }
}
?>
