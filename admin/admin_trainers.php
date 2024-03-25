<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Список тренерів</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../css/zero.css">
   <link rel="stylesheet" type="text/css" href="../css/style_admin.css">
   <link rel="stylesheet" type="text/css" href="../css/style_trainers-admin.css">
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
$train = mysqli_query($connect_bd, "SELECT * FROM `trainers`");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['up'])) {
   if (isset($_POST['trainers_id'])) {
      $trUpId = $_POST['trainers_id'];
      $_SESSION['trainId'] = $trUpId;
      header('Location: admin_trainers-up.php');
      exit;
   } else {
      echo "ID абонементу не був переданий для оновлення.";
      echo "<script>window.location = 'admin_trainers.php';</script>";
      exit;
   }
}
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
            <div class="timetable__flex">
               <h2 class="timetable__title title">Активні вакансії</h2>
               <div class="div-block">
                  <div class="div">
                     <a href="admin_trainers-add.php">Додати тренера</a>
                     <?
                     echo "<ul class='admin__activ-list'>";
                     while ($restrain = mysqli_fetch_assoc($train)) {
                        echo "<li>{$restrain['id']} {$restrain['name']} 
                  <form action='admin_trainers.php' method='post'>
                     <input type='hidden' name='trainers_id' value='{$restrain['id']}'>
                     <button type='submit' name='del'>Видалити</button>
                  </form>
                  <form action='admin_trainers.php' method='post'>
                     <input type='hidden' name='trainers_id' value='{$restrain['id']}'>
                     <button type='submit' name='up'>Оновити</button>
                  </form>
                  </li>";
                     }
                     echo "</ul>"; ?>
                  </div>
                  <?
                  $table = mysqli_query($connect_bd, "SELECT `trainers`.`id`as'Номер',`trainers`.`image`as'Фото',`trainers`.`name`as'ІП',`trainers_types`.`name_vacancies`as'Направлення',`trainers`.`information`as'Інформація',`trainers`.`certificate`as'Сертифікат' FROM `trainers`,`trainers_types` WHERE `trainers`.`trainers_type`=`trainers_types`.`id_trainers_type`");
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
                                 echo "<td class='content-table'><img src='../img/trainers/{$buf}' alt='фонове зображення'><br>назва файлу: $buf</td>";
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
                     $trainers_id = $_POST['trainers_id'];
                     $delete_query = "DELETE FROM `trainers` WHERE `id` = '$trainers_id'";
                     $result = mysqli_query($connect_bd, $delete_query);
                     if ($result) {
                        echo "Запис успішно видалено";
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