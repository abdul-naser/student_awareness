<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['student_awareness'])) {
    header('location: index.php');
    exit;
}


?>



<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="icon" href="images/teaching.png" type="image/x-icon">


    <title>الرئيسية</title>
</head>
<body>

    <header>
        <div class="header-type">

<div class="type-rl right" id="hireBox">
    <!-- <ion-icon name="grid-outline"></ion-icon> -->
    <h4>البرنامج التوعوي "التوعية الطلابية مسؤولية الجميع"</h4>
</div>


<div class="type-rl " >
    <h4>قسم الأرشاد والتوعية</h4>
</div>


<div class="type-rl left">
    <h4>
    <?php echo $_SESSION['employee_name'];?>
</h4>

<!-- <a href="logout.php">
    <ion-icon name="log-out-outline"></ion-icon>
</a> -->


</div>


</div>
</header>

<!-- popup box start -->
<div class="popup-outer" >
            <div class="popup-box">
                <i id="close" class="close"><ion-icon name="close-outline"></ion-icon></i>
                <div class="profile-text">
                <img class="" src="images/logo-removebg-preview.png" alt="">

                    <h4>البرنامج التوعوي "التوعية الطلابية مسؤولية الجميع"</h4>
                    <p>يشتمل البرنامج التوعوي الشامل على عدة محاضرات توعوية يقدمها مختصين من مؤسسات القطاع الحكومي والخاص وفق مراسلات خاصة للمؤسسات والمدارس وكشوفات واستمارات معدة والتي تتوافق موضوعاتها مع احتياجات الطلبة وميولهم ورغباتهم وسماتهم الشخصية مستفيدا من إمكانات المجتمع المحلي مع مراعاة البيئة المدرسية , حيث تقوم المدارس باتباع الاجراءات المساندة المرفقة مع البرنامج لتسهل تفعيلة بالطريقة المناسبة وفق المطلوب.</p>
<br>
                    <h4>أهداف البرنامج</h4>
                    <p>تفعيل المشاركة المجتمعية ودورها في مساعدة المدرسة على أداء رسالتها السامية لتنشئة الطلبة تنشئة متكاملة في مختلف مناحي الحياة</p>
                </div>
                <form action="#">
                    <div class="button">
                        <!-- <button id="close" class="cancel">أغلاق</button> -->
                    </div>
                </form>
            </div>
        </div>

        <!-- END popup box start -->


    <section class="navigation">
        <div class="menuToggle menu">
<ul>
            <li class="list active"> 
                <a href="#" onclick="toggleSection('sec-1')">
                    <ion-icon name="home-outline"></ion-icon>
                    <div class="add-form-text"> الرئيسية</div>
                </a>
            </li>
            
            <li class="list">
                <a href="#" onclick="toggleSection('sec-2')">
            
                    <ion-icon name="list-outline"></ion-icon>
                    <div class="add-form-text">القائمة</div>

                </a>
            
            </li>
            
            <li class="list">
                <a href="#" onclick="toggleSection('sec-3')">
            
                    <ion-icon name="add-circle-outline"></ion-icon>
                    <div class="add-form-text">أضافة </div>

                </a>
            
            </li>
            
            <li class="list">
                <a href="#" onclick="toggleSection('sec-4')">
            
                    <ion-icon name="bar-chart-outline"></ion-icon>
                    <div class="add-form-text">أحصائيات</div>

                </a>
            
            </li>


            <li class="">
                <a href="logout.php" >
            
                    <ion-icon class="exitIcon" name="log-out-outline"></ion-icon>
                    <div class="exitText">الخروج</div>

                </a>
            
            </li>


        </ul>

                        </div>
                        
    </section>

<section class="body-section">
    <img class="ļogo printHidden" src="images/a.png" alt="">
    <img class="ļogo printHidden" src="images/logo-removebg-preview.png" alt="">


    <?php  include 'form.php' ?>
    <?php  include 'analysis.php' ?>

<?php  include 'main.php' ?>
<?php  include 'list.php' ?>


</section>
</body>
</html>

<script src="script.js?v=<?php echo time(); ?>"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){ 
        const activeSection = sessionStorage.getItem("activeSection");

        if(activeSection){
            toggleSection(activeSection);
        }
    });



function toggleSection(sectionToShow) {
  const sections = ["sec-1", "sec-2", "sec-3", "sec-4", "sec-5"];

  for (const section of sections) {
    const element = document.getElementById(section);
    if(element){
    document.getElementById(section).style.display = section === sectionToShow ? "block" : "none";
}
  }
sessionStorage.setItem("activeSection" ,sectionToShow);

}
</script>

<script>

//   const list= document.querySelectorAll('.list');
//   function activeLink()
//   {
//     list.forEach((item) => 
//     item.classList.remove('active'));
// this.classList.add('active');
//   }

//   list.forEach((item) => 
//   item.addEventListener('click',activeLink))

const list = document.querySelectorAll('.list');

function activeLink() {
 // Remove 'active' class from all items
 list.forEach((item) => item.classList.remove('active'));

    // Add 'active' class to the clicked item
    this.classList.add('active');

  // Store the active item's index in localStorage
    const activeIndex = Array.from(list).indexOf(this);
  localStorage.setItem('activeIndex', activeIndex.toString());
  }
  list.forEach((item) => item.addEventListener('click', activeLink));

  // Check if there's a stored active index in localStorage
  const storedActiveIndex = localStorage.getItem('activeIndex');

  if (storedActiveIndex !== null) {
    // Remove 'active' class from all items
    list.forEach((item) => item.classList.remove('active'));

    
 // Add 'active' class to the item with the stored index
 list[parseInt(storedActiveIndex)].classList.add('active');
  }
  </script>
