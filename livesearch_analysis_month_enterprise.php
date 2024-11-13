<?php


include 'conn.php';

session_start();
if (!isset($_SESSION['student_awareness'])) {
    header('location: index.php');
    exit;
}



      $wilayatCounts  = array(); // Create an empty array to store the data

      $distinctWilayatsQuery = $mysqli->query("SELECT DISTINCT wilayat FROM awareness_programme");
if($distinctWilayatsQuery) {
    while ($row = $distinctWilayatsQuery->fetch_assoc()) {
        $wilayat = $row['wilayat'];

        if(isset($_POST['input_ent']) && isset($_POST['input_EM']) && isset($_POST['input_EY'])){
            $input_ent = $_POST['input_ent'];
              $input_EM = $_POST['input_EM'];
              $input_EY = $_POST['input_EY'];
        
        $countQuery = $mysqli->query("SELECT COUNT(*) AS count FROM awareness_programme WHERE wilayat = '$wilayat' AND YEAR(date) = '$input_EY' AND MONTH(date) = '$input_EM' AND name_enterprise = '$input_ent'");
    }

    //Fetech anlaysis for Year
if(!empty($_POST["live_search_year_E"])) {
    $live_search_year_E = $_POST['live_search_year_E'];
    $input_ent = $_POST['input_ent'];


    $countQuery = $mysqli->query("SELECT COUNT(*) AS count FROM awareness_programme WHERE wilayat = '$wilayat' AND YEAR(date) = '$live_search_year_E'  AND name_enterprise = '$input_ent'");
}
       
        if ($countQuery) {
            $result = $countQuery->fetch_assoc();
            $count = $result['count'];
            
            // Add the data to the array
            $wilayatCounts[] = array(
                'name' => $wilayat,
                'count' => $count
            );
        }

    }

?>
 
<?php
} ?>


 <!-- ================ Add Charts JS ================= -->
 <div class="chartsBx">
                    <!-- <div class="chart"> <canvas id="chart-1Search"></canvas> </div> -->
                    <div class="chart"> <canvas id="chart-2-Search"></canvas> </div>
                </div>


<script>
    // Assuming you have an array named $wilayatCounts in your PHP code
     wilayats_s = <?php echo json_encode($wilayatCounts); ?>;

     ctx2S = document.getElementById("chart-2-Search").getContext("2d");
     myChart2S = new Chart(ctx2S, {
        // type: "polarArea",
        type: "polarArea",

        data: {
            labels: wilayats_s.map(wilayat => wilayat.name), // Assuming each element in the $wilayatCounts array has a "name" property

            datasets: [{
                // label: "البرامج في كل ولاية للشهر الحالي",

                <?php         if(isset($_POST['input_ent']) && isset($_POST['input_EM']) && isset($_POST['input_EY'])){
?>
                label: "برامج <?php echo $input_ent ?> في كل ولاية لشهر <?php echo $input_EM; ?>  لعام <?php  echo $input_EY ?>",
<?php } ?>
                data: wilayats_s.map(wilayat => wilayat.count), // Assuming each element in the $wilayatCounts array has a "count" property

                backgroundColor: [

                    "#06d6a0",

                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",

                    "rgba(255, 99, 132, 1)",
                    "#c1121f",
                    "#e36414",


                ],
            }, ],
        },
        options: {
            responsive: true,
        },
    });


    /*--------------------------------------------*/


</script>



