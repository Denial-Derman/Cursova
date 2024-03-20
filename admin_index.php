<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Адмін панель</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_index-admin.css">
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
$admin = mysqli_query($connect_bd, "SELECT `id_sub`AS'Абонементи',`id_timetable`AS'Розклади',`id_vac`AS'Вакансії',`id_trainers`AS'Тренери' FROM `home`");
$resAdmin = mysqli_fetch_assoc($admin);
?>

<body>
   <div class="wrapper">
      <header class="navigator">
         <div class="conteiner">
            <div class="navigator__row">
               <div class="logo"><a target="_blank" href="index.php"><img src="img/logo_1.svg" alt="" class="navigator__logo">
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
                     Перехід здійснюється через навігацію
                  </div>
               </div>
               <div class="right">

                  <img src="img/admin-image.avif" alt="">
               </div>
            </div>
         </div>
      </main>
   </div>
</body>
<?
?>

</html>