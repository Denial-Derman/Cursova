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
   <link rel="stylesheet" type="text/css" href="css/style_admin.css">
   <link rel="stylesheet" type="text/css" href="css/style_trainers-admin.css">
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
            <div class="timetable__flex">
               <h2 class="timetable__title title">Активні вакансії</h2>
               <div class="div-block">
                  <div class="div">
                     <a href="admin_trainers-add.php">Додати вакансію</a>
                     <?
                     echo "<ul class='admin__activ-list'>";
                     while ($resVac = mysqli_fetch_assoc($Vac)) {
                        echo "<li>{$resVac['id']} {$resVac['name']} 
                  <form action='admin_trainerss.php' method='post'>
                     <input type='hidden' name='trainers_id' value='{$resVac['id']}'>
                     <button type='submit' name='del'>Видалити</button>
                  </form>
                  <form action='update_trainers.php' method='post'>
                     <input type='hidden' name='trainers_id' value='{$resVac['id']}'>
                     <button type='submit' name='up'>Оновити</button>
                  </form>
                  </li>";
                     }
                     echo "</ul>"; ?>
                  </div>
                  <?
                  $table = mysqli_query($connect_bd, "SELECT `trainers`.`id`as'Номер',`trainers`.`image`as'Фото',`trainers`.`name`as'ІП',`trainers_types`.`name_vacancies`as'Направлення',`trainers`.`information`as'Інформація',`trainers`.`certificate`as'Сертифікат' FROM `trainers`,`trainers_types` WHERE `trainers`.`id_trainers_type`=`trainers_types`.`id_trainers_type`");
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
                           foreach ($myrow as $ind => $buf) {
                              if ($ind == 'Сертифікат') {
                                 if ($buf == 1) {
                                    $buf = 'Наявний';
                                 } elseif ($buf == 0 || $buf == null) {
                                    $buf = 'На разі відсутній';
                                 }
                              }
                              $path_info = pathinfo($buf);
                              if (isset($path_info['extension']) && in_array(strtolower($path_info['extension']), array('png', 'jpg'))) {
                                 echo "<td class='content-table'><img src='img/trainers/{$buf}' alt='фонове зображення'><br>назва файлу: $buf</td>";
                              } else {
                                 $paragraphs = explode("\n", $buf);
                                 echo "<td class='content-table'><ul>";
                                 foreach ($paragraphs as $paragraph) {
                                    echo "<li>{$paragraph}</li>";
                                 }
                                 echo "</ul></td>";
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
                  if (isset($_POST['trainers_id'])) {
                     $vacancy_id = $_POST['trainers_id'];
                     $delete_query = "DELETE FROM `trainers` WHERE `id` = '$vacancy_id'";
                     $result = mysqli_query($connect_bd, $delete_query);
                     if ($result) {
                        echo "Запись успішно видалено";
                        echo "<script>window.location = 'admin_trainers.php';</script>";
                        exit;
                     } else {
                        echo "Ошибка при видалені запису: " . mysqli_error($connect_bd);
                     }
                  } else {
                     echo "ID вакансії не був передан для видалення.";
                     echo "<script>window.location = 'admin_trainers.php';</script>";
                     exit;
                  }
               }
               ?>
            </div>
         </div>
      </main>
   </div>
</body>

</html>