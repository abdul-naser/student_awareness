
const hireBox = document.querySelector("#hireBox"),
bodySection = document.querySelector(".body-section"),
closeBtn = document.querySelectorAll("#close"),
popupOuter = document.querySelector(".popup-outer");


hireBox.addEventListener("click", () =>{
    popupOuter.classList.add("show");
    bodySection.style.display = "none";
});

closeBtn.forEach(cBtn => {
    cBtn.addEventListener("click" , ()=>{
        popupOuter.classList.remove("show");
        bodySection.style.display = "block";

    });
  });

/* analysis.php   */

  select_topbar = document.getElementById("select_topbar");
  form_search1 = document.getElementById("form_search1");
form_search2 = document.getElementById("form_search2");


select_topbar.addEventListener("change", function() {
if (select_topbar.value === "optionYear") {
  form_search2.style.display = "flex";
  form_search1.style.display = "none";
 
}

else if
   (select_topbar.value === "optionMonth") {
  form_search1.style.display = "flex";
  form_search2.style.display = "none";


}
});

/* analysis.php div Enterprise & School   */

$('#anl_enterprise').on('click', function(){
  $('#divSchool').css("display", "none");
  $('#divEnterprise').css("display", "block");
  $('#searchresultMonthYearSchool').css("display", "none");


});

$('#anl_school').on('click', function(){
  $('#divSchool').css("display", "block");
  $('#divEnterprise').css("display", "none");
  $('#searchresultMonthEnterprise').css("display", "none");
});

/* أظهار الجزء الخاص بتحليل المؤسسة  */

$('#select_MY_E').on('change', function() {
  var selectedValue = $(this).val();

  if (selectedValue === 'optionMonth') {
      $('#form_searchE2').css("display", "none");
  $('#form_searchE1').css("display", "flex");
  } else if (selectedValue === 'optionYear') {
    $('#form_searchE1').css("display", "none");
    $('#form_searchE2').css("display", "flex");
  }
});

/* أظهار الجزء الخاص بتحليل المدارس  */

$('#select_MY_S').on('change', function() {
  var selectedValue = $(this).val();

  if (selectedValue === 'optionMonth') {
      $('#form_searchS2').css("display", "none");
  $('#form_searchS1').css("display", "flex");
  } else if (selectedValue === 'optionYear') {
    $('#form_searchS1').css("display", "none");
    $('#form_searchS2').css("display", "flex");
  }
});


// Display day name when select date

function displayDayOfWeek(index) {
  const datePicker = document.getElementsByClassName("datePicker")[index];
  const selectedDate = new Date(datePicker.value);
  
  // Use Arabic locale for the day of the week
  const options = { weekday: "long" };
  const dayOfWeek = selectedDate.toLocaleDateString("ar-SA", options);
  
  const dayOfWeekElement = document.getElementsByClassName("dayOfWeek")[index];
  dayOfWeekElement.value = ` ${dayOfWeek}`;
}
