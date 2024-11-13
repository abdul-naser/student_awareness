<?php

include 'conn.php';

?>

<form action="" id="form-data">
        <input type="hidden" name="id" value="">

<table  id="form-tbl" style="margin-top:20px;">
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

                        <th >اليوم والتاريخ</th>
                            <th >المؤسسة</th>
                            <th >أسم المحاضرة</th>
                            <th >المدرسة</th>
                            <th >الولاية</th>
                            <th >المنفذ</th>
                            <th >رقم الهاتف</th>
                            <th >الزمان</th>


                            <th >موقف التنفيذ
(نفذ – لم ينفذ)
                            <th class="printHidden">تحديث</th>
                        </tr>
                    </thead>
                    <tbody >

                    <?php 
if(isset($_POST['input'])){
    $input = $_POST['input'];
                    $query = $mysqli->query("SELECT * FROM `awareness_programme` WHERE school_name LIKE '%$input%' OR name_enterprise LIKE '%$input%' OR wilayat LIKE '%$input%'
                     order by no asc");
                    while($row = $query->fetch_assoc()):
                    ?>
                  <tr data-id='<?php echo $row['no'] ?>' class="hover:bg-cyan-100  cursor-pointer duration-300">
                    <td class="py-3 px-6" name="no"><?php echo $row['no'] ?></td>

                        <td class="" name="day"><?php echo $row['day'] ." " .$row['date'] ?></td>
                        <td class="" name="name_enterprise"><?php echo $row['name_enterprise'] ?></td>

                        <td class="" name="topic"><?php echo $row['topic'] ?></td>
                        <td class="" name="school_name"><?php echo $row['school_name'];?></td>
                        <td class="" name="wilayat"><?php echo $row['wilayat'];?></td>
                        <td class="" name="executor"><?php echo $row['executor'];?></td>
                        <td class="" name="phone_exe"><?php echo $row['phone_exe'] ?></td>

                        <td class="" name=""><?php echo $row['time_start']."&nbsp;-&nbsp;". $row['time_end'];?></td>

                        <td class="" name="statue_Implemented"><?php echo $row['statue_Implemented'];?></td>
                        <td class="printHidden" name="">

                            <button class="btn-edit edit_data noneditable" type="button">
                                <img src="images/edit.png" alt="">
                            </button>

                            <button class="btn-edit delete_data noneditable" type="button"> <img src="images/trash.png" alt=""></button>
                            <button class="btn-edit editable"><img src="images/save-file.png" alt=""></button>
                            <button class="btn-edit editable" onclick="cancel_button($(this))" type="button"><img src="images/close.png" alt=""></button>

                           
                        </td>




                    <?php endwhile; 
                    }?>
                    </tbody>
                </table>

                
                <!-- This is the javascript file that contains the actions scripts of the table -->
                <script type="text/javascript" src="./assets/js/script.js?v=<?php echo time(); ?>"></script>

