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
   <link rel="stylesheet" type="text/css" href="css/style_form-admin.css">
   <link rel="stylesheet" type="text/css" href="css/style_trainers-add-admin.css">
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
$Vac = mysqli_query($connect_bd, "SELECT * FROM `trainers`");
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
               <h2 class="admin__title title">Додати Тренера</h2>
               <div class="div">
                  <form action="admin_.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Тренер</h2>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Фото:</label>
                        <label for="image" class="form__file-block" id="fileBtn">Вибрати файл</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form__file" required>
                     </div>
                     <div class="form__block form__block-grid"><label for="name" class="form__text">Ім'я та прізвище:</label><input type="text" name="name" placeholder="Назва" class="form__input-text" required></div>
                     <div class="form__list">
                        <div class="form__block form__block-grid"><label for="list" class="form__text">Направлення:</label>
                           <select name="list" id="" class="form__sel">
                              <option value="1">1</option>
                              <option value="2">2</option>
                           </select>
                        </div>
                     </div>
                     <div class="form__list">
                        <label for="textarea" class="form__text">Опис:</label>
                        <textarea name="textarea" id="" cols="20" rows="5" class="form__textarea">Додатковий текст...</textarea>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="stand" class="form__text">Стандартний пункт:</label>
                        <input type="checkbox" name="stand" placeholder="Назва" class="form__input-text form__input-check" required>
                     </div>
                     <div class="form__block">
                        <button id="timeText" class="form__btn">Попередній перегляд</button>
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <!-- <div class="timetable__block">
                     <div class="timetable__flex-block" style="background:url(img/timetable/noimage.png) center no-repeat; background-size:cover;">
                        <div class="timetable__btn-block">
                           <div class="timetable__btn" id="timeTableBtn">
                           </div>
                        </div>
                        <ul class='timetable__time' id="timetableList">

                        </ul>
                     </div>
                  </div> -->
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <script src="js/timetable-admin.js"></script>
</body>

</html>