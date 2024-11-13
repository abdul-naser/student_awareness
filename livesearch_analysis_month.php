
<?php 
include 'conn.php';

if(isset($_POST['input_1']) && isset($_POST['input_2'])){
    $input_1 = $_POST['input_1'];
      $input_2 = $_POST['input_2'];

  

                    $wilayatCounts = array(); // Create an empty array to store the data

$distinctWilayatsQuery = $mysqli->query("SELECT DISTINCT wilayat FROM awareness_programme");

if ($distinctWilayatsQuery) {
    while ($row = $distinctWilayatsQuery->fetch_assoc()) {
        $wilayat = $row['wilayat'];
        
        // Query for the number of rows with this wilayat
        $countQuery = $mysqli->query("SELECT COUNT(*) AS count FROM awareness_programme WHERE wilayat = '$wilayat' AND YEAR(date) = '$input_1' AND MONTH(date) = '$input_2'");
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
}

}
?>


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
        type: "bar",

        data: {
            labels: wilayats_s.map(wilayat => wilayat.name), // Assuming each element in the $wilayatCounts array has a "name" property

            datasets: [{
                // label: "البرامج في كل ولاية للشهر الحالي",
                label: "البرامج في كل ولاية لشهر <?php echo $input_2; ?>  لعام <?php  echo $input_1 ?>",

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



