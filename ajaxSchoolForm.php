   

<?php
include 'conn.php';
if(isset($_POST['code'])) {

$code = $_POST['code'];

}

?>


<div class="list-box2" style="margin: 0%; width: 0%;">

<table   class="main-table" style="margin-top:20px;">
    <caption>البرامج المسجلة للعام الدراسي 2024/2025 للمدرسة المختارة</caption>

 <thead >
     <tr >
     <th >اليوم</th>

         <th > التاريخ</th>
 
         <th >المؤسسة</th>
         <th >أسم المحاضرة</th>
         

     </tr>


 </thead>

     
<?php
$query = "
SELECT * 
FROM awareness_programme 
WHERE school_code = '$code'
AND (
    (MONTH(date) BETWEEN 9 AND 12 AND YEAR(date) = YEAR(CURDATE()))  -- الفصل الأول (سبتمبر إلى ديسمبر)
    OR (MONTH(date) = 1 AND YEAR(date) = YEAR(CURDATE()) + 1)       -- شهر يناير من السنة التالية
    OR (MONTH(date) BETWEEN 2 AND 6 AND YEAR(date) = YEAR(CURDATE()) + 1)  -- الفصل الثاني (فبراير إلى يونيو)
)
";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
?>
 <tbody >


 <tr  class="hover:bg-cyan-100  cursor-pointer duration-300">
 <td><?php echo $row['day'];  ?></td>

 <td><?php echo $row['date'];  ?></td>

<td><?php echo $row['name_enterprise'];  ?></td>
<td><?php echo $row['topic'];  ?></td>


        
     </td>
     </tr>

     <?php
}

?>


 </tbody>
</table>

</div>
<style>
    .list-box2 table {
    border-collapse: collapse;
    box-shadow: 0 5px 10px #e1e5ee;
    background-color: #fff;
    text-align: right;
    overflow: hidden; 


}

.list-box2 table thead{
    box-shadow: 0 5px 10px #e1e5ee;

}
.list-box2 table thead th {
        padding: 1rem 2rem;
        font-weight: 900;
    }


    .list-box2 table tbody td {
        padding: 1rem 2rem;

    }

    .list-box table tr:nth-child(even){

background-color: var(--menu-color);
    }
</style>
