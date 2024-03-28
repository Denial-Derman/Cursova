<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Адмін панель-головна</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../css/zero.css">
   <link rel="stylesheet" type="text/css" href="../css/style_index-admin.css">
</head>
<?
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   header('Location: admin_login.php');
   exit;
}
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$connect_bd = mysqli_connect("localhost", "$username", "$password", "StoneBreaker");
$admin = mysqli_query($connect_bd, "SELECT `id_sub`AS'Абонементи',`id_timetable`AS'Розклади',`id_vac`AS'Вакансії',`id_trainers`AS'Тренери' FROM `home`");
$resAdmin = mysqli_fetch_assoc($admin);
?>

<body>
   <div class="wrapper">
      <header class="navigator">
         <div class="conteiner">
            <div class="navigator__row">
               <div class="logo"><a target="_blank" href="../index.php"><img src="../img/logo_1.svg" alt="" class="navigator__logo">
                  </a>
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
            <div class="div">
               <div class="left">
                  <h2>Вітаємо на адмін сторінці!</h2>
                  <div class="admin__list">
                     Список активних адмін сторінок:
                     <?
                     echo "<ul class='admin__activ-list'>";
                     foreach ($resAdmin as $columnName => $columnValue) {
                        echo "<li>$columnName</li>";
                     }
                     echo "</ul>";
                     ?>
                     <h3>Інструкція/попередження для адміністрації сайту:</h3>
                     <br>
                     <ul>
                        <li>Перехід здійснюється через навігацію</li>
                        <li>Повернення на головну сторінку основного сайту відбувається через натискання на логотип</li>
                        <li>Данна версія адміністративної сторінки не адаптована під мобільні пристрої!</li>
                        <li>Видалення відбувається відразу, обережно з цією кнопкою!!!</li>
                        <li>В розділі оновлення розкладів, додаткоий відступ між рядками не враховується у виводі</li>
                        <li>В розділі розкладів, якщо зображення занадто яскраве, та важко читається графік, краще затемнити його на 20% або 40%. Як приклад це можливо зробити в Figma або AdobePhotoshop</li>
                        <li>Під час закриття адміністративної сторінки, при повторному відкритті відбувається повторний вхід</li>
                        <li>Привинекнині проблем пов'язаних з базами даних зв'язуватися за номером тел.: +380(63)-664-45-05</li>
                     </ul>
                  </div>
               </div>
               <div class="right">
                  <img src="../img/admin-image.avif" alt="">
               </div>
            </div>
         </div>
      </main>
   </div>
</body>
<?
?>

</html>