
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$FinancialID = $_SESSION['student_awareness'];
if(isset($_POST['save']))
{
    $school_name = $_POST['school_name'];
    $code = $_POST['code'];

    $wilayat = $_POST['wilayat'];

    $enterprise = $_POST['enterprise'];

    $date = $_POST['date'];
    $day = $_POST['day'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $topic = $_POST['topic'];

    $executor = $_POST['executor'];
    $phone_exe = $_POST['phone_exe'];

    $sql_check = "SELECT * FROM  awareness_programme WHERE name_enterprise = '$enterprise' AND wilayat= '$wilayat' AND date= '$date'";
    $result_ch = $mysqli->query($sql_check);

    $sql_check2 = "SELECT * FROM  awareness_programme WHERE school_code = '$code' AND date= '$date'";
    $result_ch2 = $mysqli->query($sql_check2);
  
    //   if ($result_ch->num_rows > 0) {
    //     echo '<script>
    //     Swal.fire({
    //         title: " ' . $enterprise . ' يوجد لديها برنامج في تاريخ '.$date.'   ب ولاية ' . $wilayat . '",
    //         icon: "warning", // You can customize the icon (success, warning, error, info, etc.)
    //         confirmButtonText: "حسنآ"
    //     });
    //     </script>';   
        

    //     } 

     /* else */ if ($result_ch2->num_rows > 0) {
        echo '<script>
        Swal.fire({
            title: "مدرسة ' . $school_name . ' يوجد لديها برنامج في نفس التاريخ ' . $date . '",
            icon: "warning", // You can customize the icon (success, warning, error, info, etc.)
            confirmButtonText: "حسنآ"
        });
        </script>';   

            } 


    // Check if $school_name is not empty
        // Prepare the SQL statement
      else {
         $sql = "INSERT INTO awareness_programme (school_name,school_code,wilayat,name_enterprise ,date, day, time_start, time_end,topic,  executor,phone_exe,insert_employee) VALUES (?,?,?,?, ?, ?, ?,?, ?, ?, ?,?)";

        // Create a prepared statement
        $stmt = $mysqli->prepare($sql);

        // Bind the parameter to the statement
        $stmt->bind_param("ssssssssssss", $school_name, $code,$wilayat,$enterprise, $date, $day, $time_start, $time_end,$topic, $executor, $phone_exe,$FinancialID);

        // Execute the statement
        if ($stmt->execute()) {

        // header("Location:home.php"); 
        echo "<script> window.location.href='home.php'</script>";


        exit();
        
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } 
}


?>

<div class="register-box" id="sec-3" style="display:none;">
    <form action="" method="post">


    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

<!--  ul with search -->

<div class="wrapper">
        <div class="select-btn" >
            <span> المدرسة</span>
            <i class="uil uil-angle-down"></i>

        </div>
        <div class="content">
            <div class="search">
<i class="uil uil-search"></i>
<input type="text" placeholder="Search" name=""  >
            </div>
            <ul class="options">
       
            </ul>
        </div>
    </div>
                <input type="hidden"  name="school_name" id="schoolName">
              
<div  >

</div>
<!-- end  ul with search -->


<div class="user-box">
            <input type="text" name="code" id="codeSchool" readonly  required  placeholder="رمز المدرسة" >


        </div>



<div class="user-box">
            <input type="text" name="wilayat" id="wilaya" readonly  required  placeholder="الولاية">
            <!-- <label>الولاية</label> -->
        </div>







<?php

$schoolNames = array();

$query = "SELECT * FROM enterprise";
$result = $mysqli->query($query);

?>
<div class="user-box">
    <select id="enterprise" required name="enterprise">
        <option value="option1"></option>
    
<?php

while ($row = $result->fetch_assoc()) {
?>
    <option ><?php  echo $row['name_enterprise']; ?></option>
<?php
}

?>
    </select>
    <label for="state">الموسسة</label>

</div>



    <div class="time-box">
  
        <div class="user-box user-boxDate">
            <input type="date" name="date" required="" class="datePicker" onchange="displayDayOfWeek(0)">
            <label class="label_sp">التاريخ</label>
        </div>

        <div class="user-box">
            <input type="text" name="day"  required class="dayOfWeek" >
            <label>اليوم</label>
        </div>
 </div>





 <div id="compareDate"></div>

 <div id="compareDate_2"></div>


        <label>الزمان</label>
<div class="time-box">
        <div class="user-box time-box">
            <input type="time" name="time_start" value="09:00:00"  required>
            <label class="label_sp">من</label>
        </div>

        <div class="user-box">
            <input type="time" name="time_end" value="10:00:00" required>
            <label class="label_sp">الى</label>
        </div>

        </div>

        <div class="user-box">
            <input type="text" name="topic" required>
            <label>اسم الموضوع</label>
        </div>

<div class="user-box">
            <input type="text" name="executor" required>
            <label> المنفذ</label>
        </div>

        <div class="user-box">
            <input type="text" name="phone_exe" required>
            <label> رقم الهاتف</label>
        </div>
        <input type="submit" name="save" value="أرسال">
    </form>

   <div id="viewTableSchoolSelect" style="position: absolute; top:50%; left: 0%;">

 

</div>
</div>


<?php
// Establish a database connection (assuming you already have $mysqli)

// Initialize an empty array to store school names
$schoolNames = array();

$query = "SELECT name FROM schools";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    $schoolNames[] = $row['name'];
}
?>


<script>







        // ul with search 


const wrapper = document.querySelector(".wrapper"),
selectBtn = wrapper.querySelector(".select-btn"),
searchInp = wrapper.querySelector("input"),

options = wrapper.querySelector(".options");
// array of same countries


let countries = <?php echo json_encode($schoolNames); ?>;


 

  function addCountry(selectedCountry) {
    options.innerHTML="";
    countries.forEach(country => {
        let isSelected = country == selectedCountry ? "selected" : "";
        // adding each country inside li and inserting all li inside options tag
let li = `<li onclick="updateName(this)" class="${isSelected}">${country}</li>`;
options.insertAdjacentHTML("beforeend", li);
    });
  }

  addCountry();

  function updateName(selectedLi){
    searchInp.value="";
    addCountry();
    wrapper.classList.remove("active");
    selectBtn.firstElementChild.innerHTML = selectedLi.innerText;

     // Add the selected value to the hidden input
  document.getElementById("schoolName").value = selectedLi.innerText;

  }

  searchInp.addEventListener("keyup", () => {
    let arr =[]; //creating empty array
let searchedVal = searchInp.value.toLowerCase();
// returing all countries from array which are start with user searched value  
//and mapping returend country with li and joining them
arr = countries.filter(data => {
    return data.toLowerCase().startsWith(searchedVal);

}).map(data =>`<li onclick="updateName(this)">${data}</li>`).join("");

options.innerHTML =arr ? arr : `<p> Oops! Country not found</p>`;
  });

selectBtn.addEventListener("click", () => {
    wrapper.classList.toggle("active");

}); 



//end ul with search 
    </script>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
       $(document).ready(function(){

        function handleSchoolSelection() {
    var schoolName = $("#schoolName").val();
    var code = $("#codeSchool").val();

    if (schoolName != "") {
        // أول طلب AJAX لجلب بيانات الولاية ورمز المدرسة
        $.ajax({
            url: "fetch_wilaya.php",
            method: "POST",
            data: { schoolName: schoolName },
            success: function(data) {
                var response = JSON.parse(data);
                $("#wilaya").val(response.wilayat);
                $("#codeSchool").val(response.code);
                $("#wilaya").css("display", "block");

                // بعد تحديث الكود بناءً على البيانات، يمكن استدعاء طلب AJAX الثاني
                performSecondAjax(response.code);
            }
        });
    }
}

function performSecondAjax(code) {
    // ثاني طلب AJAX لجلب بيانات الجدول بناءً على كود المدرسة
    $.ajax({
        url: "ajaxSchoolForm.php",
        method: "POST",
        data: { code: code },
        success: function(data) {
            $("#viewTableSchoolSelect").html(data);
        }
    });
}

// عند الضغط على الخيار
$(".options").on("click", function() {
    handleSchoolSelection();
});

    });

  
 
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
       $(document).ready(function(){
// لتأكيد أن كل مدرسة لا تتكرر أكثر من برنامج في نفس اليوم
$("#datePicker").change(function(){
    var schoolName = $("#schoolName").val();
  var date = $("#datePicker").val();

if(schoolName != "" && date != ""){
    $.ajax ({
        url:"fetch_date_form.php",
        method: "POST",
        data: {schoolName:schoolName, date:date},

        success:function(data){
            $("#compareDate").html(data);
            $("#compareDate").css("display", "block");
        }
    });
} else {
    $("#compareDate").css("display", "none");
}

});


//لتحقق أن كل موسسة حد اقصى برنامج واحد في كل ولاية 

$("#datePicker").change(function(){
    var enterprise = $("#enterprise").val();
    var wilaya = $("#wilaya").val();

    var date = $("#datePicker").val();

if(enterprise != "" && date != "" && wilaya != ""){
    $.ajax ({
        url:"fetch_date_form_2.php",
        method: "POST",
        data: {enterprise:enterprise, date:date,wilaya:wilaya},

        success:function(data){
            $("#compareDate_2").html(data);
            $("#compareDate_2").css("display", "block");
        }
    });
} else {
    $("#compareDate_2").css("display", "none");
}

});


    });

  
 
</script>





