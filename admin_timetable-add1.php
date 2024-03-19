<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>StoneBreakerGym</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_timetable-add-admin.css">
</head>
<?
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   header('Location: admin_login.php');
   exit;
}
$name = $_SESSION['username'];
$password = $_SESSION['password'];
$connect_bd = mysqli_connect("localhost", "$name", "$password", "StoneBreaker");
$t = mysqli_query($connect_bd, "SELECT `timetable`.*,`club_train`.`image` FROM `timetable`, `club_train` WHERE `timetable`.`id_club_train`=`club_train`.`id`AND`timetable`.`id`='Ti1'");
$resT = mysqli_fetch_assoc($t);
?>


<body>
   <div class="wrapper">
      <header class="navigator">
         <div class="conteiner">
            <div class="navigator__row">
               <div class="logo"><img src="img/logo_1.svg" alt="" class="navigator__logo">
                  <p>Адмін сторінка</p>
               </div>
               <div class="navigator__menu menu">
                  <ul class="navigator__punct-menu">
                     <li><a href="admin_index.php">Головна</a></li>
                     <li><a href="admin_subscription.php">Абонементи</a></li>
                     <li><a href="admin_timetable.php">Розклади</a></li>
                     <li><a href="admin_vacancies.php">Вакансії</a></li>
                     <li><a href="admin_trainers.php">Тренери</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </header>
      <main class="content">
         <div class="conteiner">
            <div class="timetable__flex">
               <h2 class="timetable__title title">Додати розклад</h2>
               <div class="div">
                  <form action="admin_timetable.php" method="post" class="admin-form" enctype="multipart/form-data">
                     <h2>Завантаження розкладу на сайт</h2>
                     <label for="image">Завантажити фон:</label>
                     <label for="image" class="custom-file-upload">Вибрати файл</label><input type="file" name="image" id="" accept="image/*" class="image-form" required>
                     <p>Назва розкладу: <input type="text" name="name" id="nameTimeTable" placeholder="Назва" required></p>
                     <div class="time-list">
                        <div class="time-list-title">День та час:</div>
                        <div class="time-list-block">
                           <select name="type[]" id="DayVar1" onchange="handleDayVar1Change()" required>
                              <option value="1">Пн-Вс</option>
                              <option value="2">Пн-Сб</option>
                              <option value="3">Пн-Пт</option>
                           </select>
                           <div id="dynamicFields1" class="dynamicFields">
                              <div class="time-input">
                                 <input type="time" name="times[]" id="" required>
                                 <input type="text" name="times_text[]" id="" placeholder="текст до пункту" required>
                                 <button type="button" onclick="addFields(this)">+</button>
                                 <button type="button" onclick="removeField(this)">-</button>
                              </div>
                           </div>
                        </div>
                        <div class="time-list-block">
                           <select name="type" id="DayVar2" onchange="handleDayVar2Change()">
                              <option value="1">Сб-Вс</option>
                              <option value="2">Сб</option>
                           </select>
                           <div id="dynamicFields2" class="dynamicFields">
                              <div class="time-input">
                                 <input type="time" name="times[]" id="">
                                 <input type="text" name="times_text[]" id="" placeholder="текст до пункту">
                                 <button type="button" onclick="addFields(this)">+</button>
                                 <button type="button" onclick="removeField(this)">-</button>
                              </div>
                           </div>
                        </div>
                        <div class="time-list-block">
                           <select name="type" id="DayVar3" onchange="handleDayVar3Change()">
                              <option value="1">Вс</option>
                           </select>
                           <div id="dynamicFields3" class="dynamicFields">
                              <div class="time-input">
                                 <input type="time" name="times[]" id="">
                                 <input type="text" name="times_text[]" id="" placeholder="текст до пункту">
                                 <button type="button" onclick="addFields(this)">+</button>
                                 <button type="button" onclick="removeField(this)">-</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="timetable__form-btn">
                        <button id="timeText">Додати час та підпис</button>
                        <button type="submit" name="dot">Додати розклад</button>
                     </div>
                  </form>
                  <div class="timetable__block">
                     <div class="timetable__flex-block" style="background:url(img/timetable/noimage.png) center no-repeat; background-size:cover;">
                        <div class="timetable__btn-block">
                           <div class="timetable__btn" id="timeTableBtn">
                           </div>
                        </div>
                        <ul class='timetable__time' id="timetableList">

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <script src="js/timetable-admin.js"></script>
</body>

</html>