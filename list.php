
<section class="list-box" id="sec-2" style="display:none;">


    <style>
        .editable{
            display:none;
        }
    </style>

<?php
function getAcademicTerm($inputDate) {
    // تحويل التاريخ المدخل إلى كائن DateTime
    $date = new DateTime($inputDate);
    
    // الحصول على السنة والشهر من التاريخ المدخل
    $year = (int) $date->format('Y');
    $month = (int) $date->format('m');

    // حساب السنة الأكاديمية
    if ($month >= 9 && $month <= 12 || $month == 1) {
        // الفصل الأول
        $academicYearStart = $year;
        $academicYearEnd = $year + 1;
        return "الفصل الدراسي الأول  $academicYearEnd/$academicYearStart";
    } elseif ($month >= 2 && $month <= 6) {
        // الفصل الثاني
        $academicYearStart = $year - 1;
        $academicYearEnd = $year;
        return "الفصل الدراسي الثاني  $academicYearEnd/$academicYearStart";
    } else {
        return "التاريخ المدخل غير تابع لأي فصل دراسي.";
    }
}

?>

<button class="printer printHidden" onclick=PrintPage()><img src="images/printer.png" alt=""></button>

<form method="post" action="" class="printHidden " style="display: flex; justify-content: center; ">
<div class="row liveSearch" style="margin-left: 20px;">
        <input type="text"  id="live_search"  placeholder="بحث..."  class=""/>
         
            </div>

            <div class="row liveSearch">

         <select id="academic-year" name=""  >
            <option value="">البحث بالعام الدراسي</option>
         </select>

    <script>
        const select = document.getElementById('academic-year');
        const startYear = 2023;
        const currentYear = new Date().getFullYear() + 1; // السنة القادمة

        for (let year = startYear; year < currentYear; year++) {
            const option = document.createElement('option');
            option.value = `${year + 1}/${year}`;
            option.textContent = `${year + 1}/${year}`;
            select.appendChild(option);
        }
    </script>
     </div>

</form>


<!-- title in when print  -->
<div  class="logo-print ">
<img class="" src="images/a.png" alt="">
<h2>قسم الأرشاد والتوعية</h2>

    <img class="" src="images/logo-removebg-preview.png" alt="">
    </div>
<!-- ---------------------------- -->

<div id="searchresult">
</div>

    <form action="" id="form-data">
        <input type="hidden" name="id" value="">

<table  id="form-tbl" class="main-table" style="margin-top:20px;">
                    <!-- <colgroup>
                        <col width="20%">
                        <col width="25%">
                        <col width="15%">
                        <col width="25%">
                        <col width="15%">
                    </colgroup> -->
                    <thead >
                        <tr >
                        <th >م</th>
                        <th >اليوم</th>

                            <th > التاريخ</th>

                            <th > العام الدراسي</th>
                            <th >المؤسسة</th>
                            <th >أسم المحاضرة</th>
                            <th >المدرسة</th>
                            <th >الولاية</th>
                            <th >المنفذ</th>
                            <th >رقم الهاتف</th>
                            <th >الزمان</th>


                            <th >موقف التنفيذ
(نفذ – لم ينفذ)
                            <th class="printHidden" >تحديث</th>
                        </tr>
                    </thead>
                    <tbody >

                    <?php 
                    $query = $mysqli->query("SELECT * FROM `awareness_programme` order by no DESC");
                    while($row = $query->fetch_assoc()):

                    ?>




                    <?php  
                    // echo date('l', strtotime($row['date']));
                    ?>
                    <tr data-id='<?php echo $row['no'] ?>' class="hover:bg-cyan-100  cursor-pointer duration-300">
                    <td class="py-3 px-6" name="no"><?php echo $row['no'] ?></td>
                        <td class="" name="day"><?php echo $row['day']; ?></td>
                        <td class="" name="date"><?php echo $row['date']; ?></td>
                        <td class="" name=""><?php echo getAcademicTerm($row['date']);?></td>

                        <td class="" name="name_enterprise"><?php echo $row['name_enterprise'] ?></td>
                        <td class="" name="topic"><?php echo $row['topic'] ?></td>
                        <td class="" name="school_name"><?php echo $row['school_name'];?></td>
                        <td class="" name="wilayat"><?php echo $row['wilayat'];?></td>
                        <td class="" name="executor"><?php echo $row['executor'];?></td>
                        <td class="" name="phone_exe"><?php echo $row['phone_exe'] ?></td>

                        <td class="" name=""><?php 
        // Assuming $row['time_start'] and $row['time_end'] are in the format 'HH:MM:SS'
        $timeStart = date("H:i", strtotime($row['time_start']));
        $timeEnd = date("H:i", strtotime($row['time_end']));

        // Display the formatted time
        echo $timeStart . "&nbsp;-&nbsp;" . $timeEnd;
    ?></td>

                        <td class="" name="statue_Implemented"><?php echo $row['statue_Implemented'];?></td>
                        <td class="printHidden" name="">

                            <button class="btn-edit edit_data noneditable" type="button">
                                <img src="images/edit.png" alt="">
                            </button>

                            <button class="btn-edit delete_data noneditable" type="button"> <img src="images/trash.png" alt=""></button>
                            <button class="btn-edit editable"><img src="images/save-file.png" alt=""></button>
                            <button class="btn-edit editable" onclick="cancel_button($(this))" type="button"><img src="images/close.png" alt=""></button>

                           
                        </td>




                    <?php endwhile; ?>
                    </tbody>
                </table>


</section>


<script type="text/javascript">
    $(document).ready(function(){

        $('#live_search').keyup(function(){
            search_table($(this).val());

        });

        $('#academic-year').change(function(){
            search_table($(this).val());

        });

    
        function search_table(value){
    $('table tbody tr').each(function(){
        let found ='false';
        $(this).each(function(){
            if($(this).text().toLocaleLowerCase().indexOf(value.toLocaleLowerCase())>=0)
            {
                found='true';
            }

        });
        if(found=='true'){
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}

//         $("#live_search").on("input", function() {
//     var input = $(this).val();
// //alert(input);
// if(input != ""){
//     $.ajax ({
//         url:"livesearch_list.php",
//         method: "POST",
//         data: {input:input},

//         success:function(data){
//             $("#searchresult").html(data);
//             $("#searchresult").css("display", "block");
//             $(".main-table").css("display", "none");

//         }
//     });
// }
 
// else {
//     $("#searchresult").css("display", "none");
//     $(".main-table").css("display", "block");


// }

// });


    });

    
    




function PrintPage() {
		window.print();
	}

 
</script>



                <!-- This is the javascript file that contains the actions scripts of the table -->
                <script type="text/javascript" src="./assets/js/script.js?v=<?php echo time(); ?>"></script>
