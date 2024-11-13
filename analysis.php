
<?php 
                    // $query = $mysqli->query("SELECT wilayat FROM `awareness_programme`");

                    $wilayatCounts = array(); // Create an empty array to store the data

$distinctWilayatsQuery = $mysqli->query("SELECT DISTINCT wilayat FROM awareness_programme");

if ($distinctWilayatsQuery) {
    while ($row = $distinctWilayatsQuery->fetch_assoc()) {
        $wilayat = $row['wilayat'];
        
        // Query for the number of rows with this wilayat
        $countQuery = $mysqli->query("SELECT COUNT(*) AS count FROM awareness_programme WHERE wilayat = '$wilayat' AND YEAR(date) = YEAR(CURRENT_DATE) AND MONTH(date) = MONTH(CURRENT_DATE)");
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
?>

<section id="sec-4" style="display:none;">

<?php
include 'function.php';

selectMY('select_topbar');

?>



<!-- Month Search Form -->
<?php
printinputMY('form_search1','live_search_1','live_search_2');

?>

<!-- _____________________________ -->



<!-- Year Search Form -->


<?php
printinputY('form_search2','live_search_year');

?>
<!-- _____________________________ -->


<div id="searchresultMonth"></div>


<div id="searchresult_year"></div>



  <!-- ================ Add Charts JS ================= -->
  <div class="chartsBx" id="MonthChart">
                    <!-- <div class="chart"> <canvas id="chart-1"></canvas> </div> -->
                    <div class="chart"> <canvas id="chart-2"></canvas> </div>
                </div>



                <div class="chosse-container">
                
                
                
            

                    
                        <input type="radio" name="anlaysisES" id="anl_enterprise" style="margin-left: 5px;" >
                        <label for="anl_enterprise"  style="margin-left: 20px;">
                        تحليل للمؤسسة
                    </label>

                    
                        <input type="radio" name="anlaysisES" id="anl_school" style="margin-left: 5px;">
                        <label for="anl_school"  >
                        تحليل للمدرسة
                    </label>
                
                </div>


<!-- بداية جزء تحليل المؤسسة -->
<div id="divEnterprise" style="display: none; margin-top: 1px;">

<div class="row liveSearch_MY" >
    <div class="row liveSearch" style="margin-left:20px ;">
        <select id="select_enterprise" required name="enterprise">
        
        <option disabled selected value="">أختر أسم المؤسسة</option>
<!-- <option value=""></option> -->
            <?php
$query = "SELECT * FROM enterprise";
$result = $mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
            ?>
                <option ><?php  echo $row['name_enterprise']; ?></option>
            <?php
            }
            
            ?>
    
    
        </select>
    
    </div>


<?php
selectMY('select_MY_E');


?>

</div>

<!-- Month Search Form -->


    <?php
printinputMY('form_searchE1','live_search_E1','live_search_E2');

?>
    <!-- _____________________________ -->
    
    
    
    <!-- Year Search Form -->
    

    
<?php
printinputY('form_searchE2','live_search_year_E');

?>
    
    <!-- _____________________________ -->
    
</div>


<div id="searchresultMonthEnterprise">
</div>


<!-- نهاية جزء تحليل المؤسسة -->

<!-- بداية جزء تحليل المدرسة -->
<div  id="divSchool" style="display: none; margin-top: 1px;">

<div class="row liveSearch_MY" >
    <div class="row liveSearch" style="margin-left:20px ;">

        
<!--  ul with search -->
<div class="boxSearchSch">
<div class="select-btnAnly">
    <span>المدرسة</span>
    <i class="uil uil-angle-down"></i>
</div>

<div class="contentSear">
    <div class="searchSch">
        <i class="uil uil-search"></i>
        <input type="text" placeholder="Search" name=""  >
    </div>
    <ul class="optionsSch">

    </ul>

</div>
</div>
<input type="hidden"  name="school_nameAnly" id="schoolNameAnl">
<div  >

</div>
<!-- end  ul with search -->

        
    
    </div>



    <?php
selectMY('select_MY_S');


?>

</div>

    <!-- Month Search Form -->


    <?php
printinputMY('form_searchS1','live_search_S1','live_search_S2');

?>
    <!-- _____________________________ -->
    
    
    
    <!-- Year Search Form -->
    

    <?php
printinputY('form_searchS2','live_search_year_S');

?>
    
    <!-- _____________________________ -->


</div>

<div id="searchresultMonthYearSchool">
</div>

<!-- جزء تحليل المدرسة نهاية-->

</section>

        <!-- ======= Charts JS ====== -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>
    // Assuming you have an array named $wilayatCounts in your PHP code
    const wilayats = <?php echo json_encode($wilayatCounts); ?>;

    const ctx2 = document.getElementById("chart-2").getContext("2d");
    const myChart2 = new Chart(ctx2, {
        // type: "polarArea",
        type: "bar",

        data: {
            labels: wilayats.map(wilayat => wilayat.name), // Assuming each element in the $wilayatCounts array has a "name" property

            datasets: [{
                label: "البرامج في كل ولاية للشهر الحالي",
                data: wilayats.map(wilayat => wilayat.count), // Assuming each element in the $wilayatCounts array has a "count" property

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



<!--- Live Search For Month Wilayat-->

<script type="text/javascript">
    $(document).ready(function() {

        $("#live_search_1,#live_search_2").keyup(function() {
            var input_1 = $("#live_search_1").val();
            var input_2 = $("#live_search_2").val();
            //alert(input);
            if (input_1 != "" && input_2 != "") {
                $.ajax({
                    url: "livesearch_analysis_month.php",
                    method: "POST",
                    data: {
                        input_1: input_1,
                        input_2: input_2
                    },

                    success: function(data) {
                        $("#searchresultMonth").html(data);
                        $("#searchresultMonth").css("display", "block");
                        $("#MonthChart").css("display", "none");
                        $("#searchresult_year").css("display", "none");

                    }
                });
            } else {
                $("#searchresultMonth").css("display", "none");
                $("#MonthChart").css("display", "block");
                $("#searchresult_year").css("display", "none");


            }

        });
 


// Live Search For Year Wilayat



        $("#live_search_year").keyup(function() {
            var input_year = $("#live_search_year").val();
            //alert(input);
            if (input_year != "") {
                $.ajax({
                    url: "livesearch_analysis_year.php",
                    method: "POST",
                    data: {
                        input_year: input_year,
                    },

                    success: function(data) {
                        $("#searchresult_year").html(data);
                        $("#searchresult_year").css("display", "block");
                        $("#MonthChart").css("display", "none");
                        $("#searchresultMonth").css("display", "none");

                    }
                });
            } else {
                $("#searchresult_year").css("display", "none");
                $("#MonthChart").css("display", "block");
                $("#searchresultMonth").css("display", "none");

            }

        });


// Live Search For Month Enterprise

        $("#select_enterprise,#live_search_E1,#live_search_E2").on('keyup change', function() {
            var input_ent = $("#select_enterprise").val();
            var input_EM = $("#live_search_E2").val();
            var input_EY = $("#live_search_E1").val();
            if (input_ent != "" && input_EM != "" && input_EY != "") {
                $.ajax({
                    url: "livesearch_analysis_month_enterprise.php",
                    method: "POST",
                    data: {
                        input_ent: input_ent,
                        input_EM: input_EM,
                        input_EY: input_EY
                    },

                    success: function(data) {
                        $("#searchresultMonthEnterprise").html(data);
                        $("#searchresultMonthEnterprise").css("display", "block");
                    

                    }
                });
            } else {
                $("#searchresultMonthEnterprise").css("display", "none");
              


            }

        });


        
// Live Search For Years Enterprise

$("#select_enterprise, #live_search_year_E").on('keyup change', function() {
            var input_ent = $("#select_enterprise").val();
            var live_search_year_E = $("#live_search_year_E").val();
      
            if (input_ent != "" && live_search_year_E != "") {
                $.ajax({
                    url: "livesearch_analysis_month_enterprise.php",
                    method: "POST",
                    data: {
                        input_ent: input_ent,
                        live_search_year_E: live_search_year_E
                    },

                    success: function(data) {
                        $("#searchresultMonthEnterprise").html(data);
                        $("#searchresultMonthEnterprise").css("display", "block");
                    

                    }
                });
            } else {
                $("#searchresultMonthEnterprise").css("display", "none");
              


            }

        });



        // Live Search For School Enterprise

        $("#schoolNameAnl,#live_search_S1,#live_search_S2").keyup(function() { 
            var input_sch = $("#schoolNameAnl").val();
            var input_SM = $("#live_search_S2").val();
            var input_SY = $("#live_search_S1").val();
            if (input_sch != "" && input_SM != "" && input_SY != "") {
                $.ajax({
                    url: "livesearch_analysis_monthYear_school.php",
                    method: "POST",
                    data: {
                        input_sch: input_sch,
                        input_SM: input_SM,
                        input_SY: input_SY
                    },

                    success: function(data) {
                        $("#searchresultMonthYearSchool").html(data);
                        $("#searchresultMonthYearSchool").css("display", "block");
                    

                    }
                });
            } else {
                $("#searchresultMonthYearSchool").css("display", "none");
              


            }

        });



        // Live Search For Years School

$("#schoolNameAnl,#live_search_year_S").keyup(function() {
            var input_sch = $("#schoolNameAnl").val();
            var live_search_year_S = $("#live_search_year_S").val();
      
            if (input_sch != "" && live_search_year_S != "") {
                $.ajax({
                    url: "livesearch_analysis_monthYear_school.php",
                    method: "POST",
                    data: {
                        input_sch: input_sch,
                        live_search_year_S: live_search_year_S
                    },

                    success: function(data) {
                        $("#searchresultMonthYearSchool").html(data);
                        $("#searchresultMonthYearSchool").css("display", "block");
                    

                    }
                });
            } else {
                $("#searchresultMonthYearSchool").css("display", "none");
              


            }

        });

    });


    
</script>



<script>
      

       
    // ul with search Analysis School


const boxSearchSch = document.querySelector(".boxSearchSch"),
selectBtnAnly = boxSearchSch.querySelector(".select-btnAnly"),
searchInpAnly = boxSearchSch.querySelector("input"),

optionsSch = boxSearchSch.querySelector(".optionsSch");
// array of same countries




 

  function addSchools(selectedSchools) {
    optionsSch.innerHTML="";
    countries.forEach(country => {
        let isSelected = country == selectedSchools ? "selected" : "";
        // adding each country inside li and inserting all li inside options tag
let li = `<li onclick="updateNameSch(this)" class="${isSelected}">${country}</li>`;
optionsSch.insertAdjacentHTML("beforeend", li);
    });
  }

  addSchools();

  function updateNameSch(selectedLi){
    searchInpAnly.value="";
    addSchools();
    boxSearchSch.classList.remove("active");
    selectBtnAnly.firstElementChild.innerHTML = selectedLi.innerText;

     // Add the selected value to the hidden input
  document.getElementById("schoolNameAnl").value = selectedLi.innerText;

  }

  searchInpAnly.addEventListener("keyup", () => {
    let arr =[]; //creating empty array
let searchedVal = searchInpAnly.value.toLowerCase();
// returing all countries from array which are start with user searched value  
//and mapping returend country with li and joining them
arr = countries.filter(data => {
    return data.toLowerCase().startsWith(searchedVal);

}).map(data =>`<li onclick="updateNameSch(this)">${data}</li>`).join("");

optionsSch.innerHTML =arr ? arr : `<p> Oops! Country not found</p>`;
  });

  selectBtnAnly.addEventListener("click", () => {
    boxSearchSch.classList.toggle("active");

});



//ul with search Analysis School
    </script>



