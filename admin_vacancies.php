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
   <!-- <link rel="stylesheet" type="text/css" href="css/style_vacancies-admin.css"> -->
   <link rel="stylesheet" type="text/css" href="css/style_admin.css">
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
$Vac = mysqli_query($connect_bd, "SELECT * FROM `vacancies`");
// $resVac = mysqli_fetch_assoc($Vac);
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
               <h2 class="timetable__title title">Активні вакансії</h2>
               <div class="div-block">
                  <div class="div">
                     <a href="admin_vacancies-add.php">Додати вакансію</a>
                     <?
                     echo "<ul class='admin__activ-list'>";
                     while ($resVac = mysqli_fetch_assoc($Vac)) {
                        echo "<li>{$resVac['id']} {$resVac['name_vacancies']} 
                  <form action='admin_vacancies.php' method='post'>
                     <input type='hidden' name='vacancy_id' value='{$resVac['id']}'>
                     <button type='submit' name='del'>Видалити</button>
                  </form>
                  <form action='update_vacancy.php' method='post'>
                     <input type='hidden' name='vacancy_id' value='{$resVac['id']}'>
                     <button type='submit' name='up'>Оновити</button>
                  </form>
                  </li>";
                     }
                     echo "</ul>"; ?>
                  </div>
                  <?
                  $table = mysqli_query($connect_bd, "SELECT `id`as'Номер',`name_vacancies`as'Назва вакансії',`fons`as'Фонове зображення',`requirements`as'Вимоги',`duties`as'Обов*язки' FROM `vacancies`");
                  if ($table) {
                     echo "";
                  } else {
                     echo "Помилка в базі даних";
                  }
                  ?>
                  <div class="res-table">
                     <h3>Таблиця наявних даних</h3>
                     <table class="res">
                        <?
                        $p = 1;
                        while ($myrow = mysqli_fetch_array($table, MYSQLI_ASSOC)) {
                           if ($p == 1) {
                              echo "<tr>";
                              foreach ($myrow as $ind => $buf) {
                                 echo
                                 "<td class='title-table'>$ind</td>";
                              }
                              echo "</tr>";
                              $p = 2;
                           }
                           echo "<tr>";
                           foreach ($myrow as $buf) {
                              $path_info = pathinfo($buf);
                              if (isset($path_info['extension']) && in_array(strtolower($path_info['extension']), array('png', 'jpg'))) {
                                 echo "<td class='content-table'><img src='img/vacancies/{$buf}' alt='фонове зображення'><br>назва файлу: $buf</td>";
                              } else {
                                 echo "<td class='content-table'>{$buf}</td>";
                              }
                           }
                           echo "</tr>";
                        }
                        ?>
                     </table>
                  </div>
               </div>
               <?
               if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
                  if (isset($_POST['vacancy_id'])) {
                     $vacancy_id = $_POST['vacancy_id'];
                     $delete_query = "DELETE FROM `vacancies` WHERE `id` = '$vacancy_id'";
                     $result = mysqli_query($connect_bd, $delete_query);
                     if ($result) {
                        echo "Запись успішно видалено";
                        echo "<script>window.location = 'admin_vacancies.php';</script>";
                        exit;
                     } else {
                        echo "Ошибка при видалені запису: " . mysqli_error($connect_bd);
                     }
                  } else {
                     echo "ID вакансії не був передан для видалення.";
                     echo "<script>window.location = 'admin_vacancies.php';</script>";
                     exit;
                  }
               }
               ?>
            </div>
         </div>
      </main>
   </div>
   <script src="js/timetable-admin.js"></script>
</body>

</html>