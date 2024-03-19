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
   <link rel="stylesheet" type="text/css" href="css/style_form-admin.css">
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
$t = mysqli_query($connect_bd, "SELECT `timetable`.*,`club_train`.`image` FROM `timetable`, `club_train`");
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
            <div class="block__flex">
               <h2 class="admin__title title">Додати розклад</h2>
               <div class="div">
                  <form action="admin_.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Розклад</h2>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Фонове зображення:</label>
                        <label for="image" class="form__file-block" id="fileBtn">Вибрати файл</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form__file" required>
                     </div>
                     <div class="form__block form__block-grid"><label for="name" class="form__text">Назва:</label><input type="text" name="name" placeholder="Назва" class="form__input-text" required></div>
                     <div class="form__list">
                        <label for="" class="form__text">Час та опис:</label>
                        <div class="form__list list" id="listTime1">
                           <select name="type[]" id="DayVar1" class="form__sel" onchange="handleDayVar1Change()" required>
                              <option value="1">Пн-Вс</option>
                              <option value="2">Пн-Сб</option>
                              <option value="3">Пн-Пт</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields1">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="form__list list" id="listTime2">
                           <select name="type[]" id="DayVar2" class="form__sel" onchange="handleDayVar2Change()">
                              <option value="1">Вс-Cб</option>
                              <option value="2">Вс</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields2">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="form__list list" id="listTime3">
                           <select name="type[]" id="DayVar3" class="form__sel" onchange="handleDayVar3Change()">
                              <option value="1">Вс</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields3">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form__block">
                        <button id="timeText" class="form__btn">Попередній перегляд</button>
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="timetable__block">
                     <div class="timetable__flex-block" style="background:url(img/timetable/noimage.png) center no-repeat; background-size:cover;">
                        <div class="timetable__btn-block">
                           <div class="timetable__btn" id="timeTableBtn">
                              Назва розкладу
                           </div>
                        </div>
                        <ul class='timetable__time' id="timetableList">
                           <li>Пн-Сб</li>
                           <li>09:30 - Початок</li>
                           <li>12:30 - Перерва</li>
                           <li>09:30 - Закриття</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <script src="js/admin_form.js"></script>
   <script src="js/timetable-admin.js"></script>
</body>

</html>