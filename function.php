
<?php

function selectMY($idSelect) 
{
    $selectMY = '
    
<div class="row liveSearch">
<select id="'.$idSelect.'" required name="enterprise">


    <option value="optionMonth">تحليل شهري</option>
    <option value="optionYear">تحليل سنوي</option>


</select>

</div>
    ';
echo $selectMY;

};

function printinputMY($idForm,$input_search1,$input_search2) {
$printinputMY= '
<form method="post" action="" >

<div class="row liveSearch_MY"  id="'.$idForm.'" >
        <input type="text" id="'.$input_search1.'" placeholder="السنة">
    <!-- </div>
    <div class="row liveSearch" id="form_search1" style="display: flex; flex-direction: row;"> -->

        <input type="text" id="'.$input_search2.'" placeholder="الشهر">
</div>

</form>
';
echo $printinputMY;

};



function printinputY($idForm2,$search_year) {
 $printinputY = '
 <form method="post" action=""  >

<div class="row liveSearch"  id="'.$idForm2.'" style="display: none;">
<input type="text" id="'.$search_year.'" placeholder="السنة">
</div>

</form>
 ';

 echo  $printinputY;
}



?>