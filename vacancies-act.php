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
   <link rel="stylesheet" type="text/css" href="css/style_vacancies-act.css">
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_feedback.css">
</head>
<?
$connect_bd = mysqli_connect("localhost", "root", "", "StoneBreaker");
$vacancies_id = null;
if (isset($_GET['id'])) {
   $vacancies_id = $_GET['id'];
   $v = mysqli_query($connect_bd, "SELECT `vacancies`.*, `trainers_types`.* FROM `vacancies`, `trainers_types` WHERE `vacancies`.`id_trainers_type`=`trainers_types`.`id_trainers_type` AND`vacancies`.`id`='$vacancies_id';");
   $resV = mysqli_fetch_assoc($v);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $vacancies_id = $_GET['id'];
   echo "";
   function incrementId($id)
   {
      preg_match('/([A-Za-z]+)(\d+)/', $id, $matches);
      $prefix = $matches[1];
      $number = $matches[2];
      // Збільшити порядкове число на 1
      $new_number = $number + 1;
      // Сформувати нове id
      $new_id = $prefix . $new_number;
      return $new_id;
   }
   $name = $_POST["name"];
   $tel = $_POST["tel"];
   $email = $_POST["email"];
   $message = $_POST["message"];
   $type_vacans = mysqli_query($connect_bd, "SELECT `vacancies`.`id_trainers_type` FROM `vacancies`,`trainers_types` WHERE `vacancies`.`id_trainers_type`=`trainers_types`.`id_trainers_type` AND `vacancies`.`id`='$vacancies_id';");
   $type_vacans_row = mysqli_fetch_assoc($type_vacans);
   $type_vacans_value = $type_vacans_row['id_trainers_type'];
   $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id) FROM `vacancies_resum`");
   $max_id_row = mysqli_fetch_assoc($result_max_id);
   $max_id = $max_id_row['MAX(id)'];
   // Збільшити id на 1
   $new_id = incrementId($max_id);
   $query = "INSERT INTO `vacancies_resum` (`id`,`name`, `tel`, `email`, `message`,`id_vacancies`) VALUES ('$new_id','$name', '$tel', '$email', '$message','$type_vacans_value')";
   $result = mysqli_query($connect_bd, $query);
   if (!$result) {
      die("Помилка при виконанні запросу: " . mysqli_error($connect_bd));
   }
   $result = mysqli_query($connect_bd, $query);
   if ($result) {
      $last_id = mysqli_insert_id($connect_bd);
      echo "";
   } else {
      echo "";
   }
} else {
   echo "";
}
?>

<body>
   <div class="wrapper">
      <header class="navigator">
         <div class="conteiner">
            <div class="navigator__row">
               <a href="index.php"><img src="img/logo_1.svg" alt="" class="navigator__logo">
               </a>
               <div class="navigator__connect">
                  <a href="#" class="navigator__con feedbackOpen">Зворотній зв'язок</a>
               </div>
               <div class="navigator__burger">
                  <span></span>
               </div>
               <div class="navigator__menu menu">
                  <ul class="navigator__punct-menu">
                     <li><a href="our-club.php">Наш клуб</a></li>
                     <li><a href="subscription.php">Абонементи</a></li>
                     <li><a href="timetable.php">Розклади</a></li>
                     <li><a href="vacancies.php">Вакансії</a></li>
                     <li><a href="trainers.php">Тренери</a></li>
                  </ul>
                  <ul class="navigator__number">
                     <li class="navigator__num"><a href="tel:+380636645405">+380 63 664 54
                           05</a></li>
                     <li>
                        <a href="#" class="navigator__connection feedbackOpen">Зворотній зв’язок</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </header>
      <main class="content">
         <div class="conteiner">
            <div class="vacancies__flex">
               <h2 class="vacancies__title title"> <a href="vacancies.php"><img src="img/icon/Exit.svg" alt="Назад до вакансій"></a>
                  Вакансія: <? echo  $resV['name_vacancies'];  ?>
               </h2>
               <div class="vacancies__block">
                  <div class="vacancies__cart">
                     <div class="vacancies__cart-image" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(img/vacancies/<? echo  $resV['fons']; ?>) center no-repeat; background-size: cover;">
                        <div class="vacancies__cart-btn">
                           <a href="#" class="vacancies__cart-btn-text">Подати заявку</a>
                        </div>
                     </div>
                     <div class="vacancies__cart-description">
                        <div class="vacancies__cart-requirements">
                           <h3>Вимоги</h3>
                           <?
                           if (!empty($resV['requirements'])) {
                              $listR = $resV['requirements'];
                              $vacans = explode("\n", $listR);
                              echo "<ul>";
                              foreach ($vacans as $vacan) {
                                 echo "<li>{$vacan}</li>";
                              }
                              echo "</ul>";
                           } else {
                              echo "<h2>Список пустий</h2> ";
                           }
                           ?>
                        </div>
                        <div class="vacancies__cart-duties">
                           <h3>Обов'язки</h3>
                           <?
                           if (!empty($resV['duties'])) {
                              $listD = $resV['duties'];
                              $vacans = explode("\n", $listD);
                              echo "<ul>";
                              foreach ($vacans as $vacan) {
                                 echo "<li>{$vacan}</li>";
                              }
                              echo "</ul>";
                           } else {
                              echo "<h2>Список пустий</h2> ";
                           }
                           ?>
                        </div>
                     </div>
                     <form action="vacancies-act.php?id=<?php echo $vacancies_id; ?>" method="post" class="vacancies__cart-form" onsubmit="return actForm()">
                        <div class="vacancies__cart-name form-element">Прізвище ім’я:<input type=text name="name" placeholder="Прізвище ім’я" required pattern="^([А-Яа-яЁёІіЇїЄєҐґA-Za-z']+ [А-Яа-яЁёІіЇїЄєҐґA-Za-z']+)$"></div>
                        <div class="vacancies__cart-tel form-element">Телефон:<input type="tel" name="tel" placeholder="+380(00)-000-00-00" required pattern="^\+380[0-9]{9}$"></div>
                        <div class="vacancies__cart-email form-element">Пошта:<input type="email" name="email" placeholder="name@gmail.com" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"></div>
                        <div class="vacancies__cart-notice form-element">Про себе:<textarea id="message" name="message" rows="2.5" cols="50"></textarea>
                        </div>
                        <button type=submit name="submit" class="vacancies__cart-send form-element">Надіслати</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <footer class="footer">
         <div class="conteiner">
            <div class="footer__row">
               <div class="footer__body">
                  <div class="footer__menu menu">
                     <ul class="footer__punct-menu">
                        <li class="navigator__grid-1 navigator__grid"><a href="index.php">Головна</a></li>
                        <li class="navigator__grid-2 navigator__grid"><a href="our-club.php">Наш клуб</a></li>
                        <li class="navigator__grid-3 navigator__grid"><a href="subscription.php">Абонементи</a></li>
                        <li class="navigator__grid-4 navigator__grid"><a href="timetable.php">Розклад</a></li>
                        <li class="navigator__grid-5 navigator__grid"><a href="vacancies.php">Вакансії</a></li>
                        <li class="navigator__grid-6 navigator__grid"><a href="trainers.php">Тренери</a></li>
                     </ul>
                  </div>
                  <ul class="footer__connection">
                     <h3 class="footer__title">Будь з нами на зв’язку</h3>
                     <div class="footer__num">
                        <li><a href="tel:+380636645405">+380 63 664 54
                              05</a></li>
                     </div>
                     <div class="footer__email">
                        <li><a href="mailto:156student@mksumdu.info" class="footer__email">support@stonebrreaker.ua</a>
                        </li>
                     </div>
                  </ul>
                  <div class="footer__media">
                     <h3 class="footer__title">Живі туси</h3>
                     <div class="footer__icon">
                        <a class="footer__facebook" href="https://www.facebook.com/?locale=uk_UA" target="_blank"><img src="img/icon/icons8-facebook-f.svg" alt="Facebook"></a>
                        <a class="footer__insta" href="https://www.instagram.com/" target="_blank"><img src="img/icon/icons8-instagram.svg" alt="Instagram"></a>
                        <a class="footer__youtube" href="https://www.youtube.com/" target="_blank"><img src="img/icon/Vector.svg" alt="You Tube"></a>
                     </div>
                  </div>
               </div>
               <div class="footer__copirate">
                  <h6 style="text-align: center;">Створенно в начальних цілях <br>©2023 Group of companies StoneBrreaker
                     Gym</h6>
               </div>
            </div>
         </div>
      </footer>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="js/vacancies-act.js"></script>
   <script src="js/burger.js"></script>
   <script src="js/feedback.js"></script>
</body>

</html>