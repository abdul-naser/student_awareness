
<section id="sec-1">
<section class="main-box"  >

<?php

// first (last insert)
$query = "SELECT awareness_programme.*, login.employee_name
FROM awareness_programme
INNER JOIN login ON awareness_programme.insert_employee = login.FinancialID

 ORDER BY time_insert DESC LIMIT 1";
$result = $mysqli->query($query);

// second (last next program)

$query2 = "SELECT awareness_programme.*, login.employee_name
FROM awareness_programme
INNER JOIN login ON awareness_programme.insert_employee = login.FinancialID
WHERE awareness_programme.date >= NOW()
ORDER BY ABS(DATEDIFF(NOW(), awareness_programme.date))
LIMIT 1";

$result2 = $mysqli->query($query2);

while ($row = $result->fetch_assoc()) {

    ?>
<div class="main-1">

    <div class="tiltle">
<ion-icon name="person-circle-outline"></ion-icon>
<span> أضاف موخرا   </span>
<h4>&nbsp;   <?php echo $row['employee_name']; ?></h4>
<span class="element">&nbsp;   <?php echo $row['time_insert']; ?></span>

</div>
<?php
function logoEnterprise($row){
    if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'إدارة التراث والسياحة') {
        echo "images/وزارة_التراث_والسياحة_سلطنة_عُمان.png";
    }

   else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'قيادة شرطة شمال الباطنة') {
        echo "images/LogoPolice.png";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'هيئة البيئة') {
        echo "images/download.jpg";
    }

    
    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'هيئة حماية المستهلك') {
        echo "images/حماية المستهلك.jpg";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'المديرية العامة للتنمية الاجتماعية') {
        echo "images/التنمية الاجتماعية.png";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'مختبر الجودة الدولي') {
        echo "images/مختبر الجودة.png";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'المديرية العامة للثقافة والرياضة والشباب') {
        echo "images/الرياضة.svg";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'المديرية العامة للتجارة والصناعة وترويج الاستثمار') {
        echo "images/tejarah.png";
    }
    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'المديرية العامة للثروة الزراعية والسمكية وموارد المياة') {
        echo "images/logo-light.png";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'شركة نماء لتوزيع الكهرباء') {
        echo "images/NG-logos.svg";
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'كلية الطب والعلوم الصحية بالجامعة الوطنية للعلوم والتكنولوجيا') {
        echo "images/nu_new_logo.png";
    }
    else{
        echo "images/company.png";

    }
}


function logoEnterStyle($row){
    if(isset($row['name_enterprise']) && $row['name_enterprise'] == '') {
        echo "";

    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'المديرية العامة للثروة الزراعية والسمكية وموارد المياة') {
        echo "background: #219ebc;width: 180px;";   
    
    }

    else if(isset($row['name_enterprise']) && $row['name_enterprise'] == 'قيادة شرطة شمال الباطنة') {
        echo "background: #03045e;width: 180px;";   
    }


    else{
        echo "width: 180px;";

    }
}


?>


<div class="details">
    <div class="entr">
    <img src="<?php logoEnterprise($row) ?>" style="<?php logoEnterStyle($row) ?>" alt="" >
    <!-- <span><?php echo $row['name_enterprise']; ?></span> -->
</div>
    <br>

    <div class="details-all">
        <a href="">
        <table>
            <tr>
                <th></th>

          
         
                <td>
                <?php echo $row['school_name']; ?>
            </td>
        </tr>

        <tr>
    <th><ion-icon name="reader-outline"></ion-icon></th>



    <td>
    <?php echo $row['topic']; ?>
</td>
</tr>

        <tr>
            <th><ion-icon name="calendar-outline"></ion-icon></th>


     
            <td>
            <?php echo $row['date']; ?>
        </td>
    </tr>

    <tr>
        <th><ion-icon name="time-outline"></ion-icon></th>

  
 
        <td>
        <?php echo $row['time_start']."&nbsp;-&nbsp;". $row['time_end'];?>
    </td>
</tr>



        </table>
        </a>
    </div>

</div>

</div>

    <?php }?>


    <!-- نهاية المربع الاول  -->

    <?php

while ($row2 = $result2->fetch_assoc()) {


?>

<div class="main-1">

    <div class="tiltle">
<ion-icon name="time-outline"></ion-icon>
<span> موعد البرنامج التالي :</span>
<span>&nbsp;   <?php echo  $row2['day']."&nbsp;&nbsp;". $row2['date']; ?></span>
<span class="element">&nbsp;           <?php echo $row2['time_start']."&nbsp;-&nbsp;". $row2['time_end'];?>
</span>

</div>

<div class="details">
    <div class="entr">
    <img src="<?php logoEnterprise($row2) ?>" style="<?php logoEnterStyle($row2) ?>" alt="" >
    <!-- <span><?php echo $row2['name_enterprise']; ?></span> -->
</div>
    <br>

    <div class="details-all">
        <a href="">
        <table>
            <tr>
                <th></th>

          
         
                <td>
                <?php echo $row2['school_name']; ?>
            </td>
        </tr>

        <tr>
    <th><ion-icon name="reader-outline"></ion-icon></th>



    <td>
    <?php echo $row2['topic']; ?>
</td>
</tr>

    
        </table>
        </a>
    </div>

</div>

</div>

<?php
}?>



</section> 

<section class="option-main">

    <div class="option active" onclick="toggleTable('tableOption1')" >
        <span>ستنفذ قريبا</span>
        <span><ion-icon name="time-outline"></ion-icon></span>
    </div>

    <div class="option" onclick="toggleTable('tableOption2')" >
        <span>المضافة موخرآ</span>
        <span><ion-icon name="add-circle-outline"></ion-icon></span>
    </div>

    <div class="option" onclick="toggleTable('tableOption3')" >
        <span>المنفذة موخرآ</span>
        <span><ion-icon name="checkmark-done-outline"></ion-icon></span>
    </div>
  
</section>


<!-- retrive data  -->
<section class="elementOption">


<!-- أظهار البرامج التي ستقام خلال الخمس ايام القادمة -->
<div class="tableOption" id="tableOption1">

<table>

    <?php
$query3 = "SELECT * FROM awareness_programme WHERE date >= NOW() AND date <= DATE_ADD(NOW(), INTERVAL 5 DAY) ORDER by date";
$result3 = $mysqli->query($query3);


if (!$result3) {
    die("Query failed: " . $mysqli->error);
}
if ($result3->num_rows == 0) {

    ?>
<img src="images/Questions-bro.svg" alt="" style="height: 300px; ">
    <?php
}
while ($row = $result3->fetch_assoc()) {
?>

    <tr>
        <td class="py-3 px-6" name="qualification"><?php echo $row['no'] ?></td>
        <td class="" name="date"><?php echo $row['day'] ." " .$row['date'] ?></td>
        <td class="" name="topic"><?php echo $row['name_enterprise'] ?></td>

        <td class="" name="topic"><?php echo $row['topic'] ?></td>
        <td class="" name="school_name"><?php echo $row['school_name'];?></td>
        <td class="" name="school_name"><?php echo $row['wilayat'];?></td>

        <td class="" name="time_start"><?php echo $row['time_start']."&nbsp;-&nbsp;". $row['time_end'];?></td>
        <td class="" name="implement"></td>
        <td class="" name="implement"></td>

    </tr>
    
    <?php
}

?>
</table>

</div>

<!--************************ النهاية ************************-->



<!-- أظهار البرامج المضافة أخيرا خلال الخمس ايام الماضية -->

<div class="tableOption" id="tableOption2" style="display:none;">

<table>

    <?php
$query3 = "SELECT * FROM awareness_programme
WHERE time_insert >= DATE_SUB(NOW(), INTERVAL 5 DAY)";
$result3 = $mysqli->query($query3);


if (!$result3) {
    die("Query failed: " . $mysqli->error);
}
if ($result3->num_rows == 0) {

    ?>
<img src="images/Questions-cuate.svg" alt="" style="height: 300px; ">
    <?php
}
while ($row = $result3->fetch_assoc()) {
?>

    <tr>
        <td class="py-3 px-6" name="qualification"><?php echo $row['no'] ?></td>
        <td class="" name="date"><?php echo $row['day'] ." " .$row['date'] ?></td>
        <td class="" name="topic"><?php echo $row['name_enterprise'] ?></td>

        <td class="" name="topic"><?php echo $row['topic'] ?></td>
        <td class="" name="school_name"><?php echo $row['school_name'];?></td>
        <td class="" name="school_name"><?php echo $row['wilayat'];?></td>

        <td class="" name="time_start"><?php echo $row['time_start']."&nbsp;-&nbsp;". $row['time_end'];?></td>
        <td class="" name="implement"></td>
        <td class="" name="implement"></td>

    </tr>
    
    <?php
}

?>
</table>

</div>
<!--************************ النهاية ************************-->
<!-- أظهار البرامج التي نفذت متاخرا  -->
<div class="tableOption" id="tableOption3" style="display:none;">

<table>

    <?php
$query4 = "SELECT * FROM awareness_programme
WHERE date >= DATE_SUB(NOW(), INTERVAL 5 DAY) ORDER BY date DESC";
$result4 = $mysqli->query($query4);


if (!$result4) {
    die("Query failed: " . $mysqli->error);
}
if ($result4->num_rows == 0) {

    ?>
<img src="images/Questions-pana.svg" alt="" style="height: 300px; ">
    <?php
}

while ($row = $result4->fetch_assoc()) {
?>

    <tr>
        <td class="py-3 px-6" name="qualification"><?php echo $row['no'] ?></td>
        <td class="" name="date"><?php echo $row['day'] ." " .$row['date'] ?></td>
        <td class="" name="topic"><?php echo $row['name_enterprise'] ?></td>

        <td class="" name="topic"><?php echo $row['topic'] ?></td>
        <td class="" name="school_name"><?php echo $row['school_name'];?></td>
        <td class="" name="school_name"><?php echo $row['wilayat'];?></td>

        <td class="" name="time_start"><?php echo $row['time_start']."&nbsp;-&nbsp;". $row['time_end'];?></td>
        <td class="" name="implement"></td>
        <td class="" name="implement"></td>

    </tr>
    
    <?php
}

?>
</table>
</div>

</section>




</section>

<script>
    function toggleTable(tableToShow) {
        const tablesShow= ["tableOption1","tableOption2","tableOption3"]; 

        for (const table of tablesShow){
            document.getElementById(table).style.display = table ===tableToShow ? "block" : "none";
        }
    }
</script>

<script>
    const option= document.querySelectorAll('.option');
    function activeOption()
    {
        option.forEach((item) => 
           item.classList.remove('active'));
            this.classList.add('active');
        }

        option.forEach((item) =>
       item.addEventListener('click',activeOption))

</script>


