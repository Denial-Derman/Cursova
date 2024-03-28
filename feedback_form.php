<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Зворотний зв'язок</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_feedback.css">
   <link rel="stylesheet" type="text/css" href="css/feedback-valid.css">
</head>

<body>
   <div class="wrapper">
      <header class="navigator">
         <div class="conteiner">
            <div class="navigator__row">
               <a href="index.php"><img src="img/logo_1.svg" alt="" class="navigator__logo">
               </a>
               <div class="navigator__connect">
                  <a href="#" class="navigator__con feedbackOpen">Зворотний зв'язок</a>
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
                        <a href="#" class="navigator__connection feedbackOpen">Зворотний зв’язок</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </header>
      <main class="content">
         <div class="conteiner">
            <div class="feedback__flex">
               <h2 class="feedbacks__title title">Обробка запиту на зворотній зв'язок</h2>
               <div class="feedback__row">
                  <div class="feedback__block">
                     <?
                     $connect_bd = mysqli_connect("localhost", "root", "", "StoneBreaker");
                     if (isset($_POST["feedbackName"], $_POST["feedbackNumber"])) {
                        $name = $_POST["feedbackName"];
                        $tel = $_POST["feedbackNumber"];
                        if (!preg_match("/^[А-Яа-яЁёІіЇїЄєҐґA-Za-z\'` ]+$/", $name)) {
                           echo "Ім'я повинно містити лише літери.";
                           exit;
                        }
                        if (!preg_match("/^\+380[0-9]{9}$/", $tel)) {
                           echo "Телефон має бути у форматі +380XXXXXXXXX.";
                           exit;
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                           function incrementId($id)
                           {
                              // Збільшити порядкове число на 1
                              $new_id = $id + 1;
                              return $new_id;
                           }
                           $name = mysqli_real_escape_string($connect_bd, $_POST["feedbackName"]);
                           $tel = mysqli_real_escape_string($connect_bd, $_POST["feedbackNumber"]);
                           $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id_client) FROM `client`");
                           $max_id_row = mysqli_fetch_assoc($result_max_id);
                           $max_id = $max_id_row['MAX(id_client)'];
                           $new_id = incrementId($max_id);
                           $sql = "SELECT * FROM `client` WHERE `name_client` = '$name' AND`tel_client`= '$tel'";
                           $verification = mysqli_query($connect_bd, $sql);
                           if (mysqli_num_rows($verification) > 0) {
                              echo "Ваш запит вже оброблюється. <br>Чекайте на дзвінок)";
                           } else {
                              $query = "INSERT INTO `client` (`id_client`,`name_client`, `tel_client`) VALUES ('$new_id','$name', '$tel')";
                              $result = mysqli_query($connect_bd, $query);
                              if ($result) {
                                 echo "Ваша дані надіслано. <br>Чекайте на дзвінок)";
                              } else {
                                 echo "Ваші дані не дійшли до нас.<br> Вибачте за незручність(";
                              }
                           }
                        }
                     } else {
                        echo "Будь ласка, заповніть всі обов'язкові поля.";
                     }
                     ?>
                     <p>Данна сторінка виводить результати заповнення форми для зворотного зв'язку з нами. <br> Для повернення назад, нажміть стрілку назад, або оберіть потрібний вам розділ в навігації. <br> Дякую, за увагу</p>
                  </div>
                  <div class="feedback__block image">
                     <img src="img/feedback/feedback_phone.avif" alt="телефон">
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
   <script src="js/form-valid.js"></script>
   <script src="js/burger.js"></script>
   <script src="js/feedback.js"></script>
</body>

</html>