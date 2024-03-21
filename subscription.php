<!DOCTYPE html>
<html lang="en">

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
   <link rel="stylesheet" type="text/css" href="css/style_subscription.css">
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_feedback.css">
</head>
<?
$connect_bd = mysqli_connect("localhost", "root", "", "StoneBreaker");
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
         <div class="subscription">
            <div class="conteiner">
               <div class="subscription__flex">
                  <h2 class="subscription__title title">Абонементи
                  </h2>
                  <div class="subscription__row">
                     <? $s = mysqli_query($connect_bd, "SELECT `subscription`.`id`,`subscription`.`name_sub`,`duration`.`duration_month`,`subscription`.`shower`,`subscription`.`cloakroom`,`subscription`.`safe`,`subscription`.`description`,`subscription`.`price`,`subscription`.`currency` FROM `subscription`,`duration` WHERE `subscription`.`id_fee_for`=`duration`.`id_duration`");
                     while ($resS = mysqli_fetch_assoc($s)) { ?>
                        <div class="subscription__body">
                           <div class="subscription__body-title"><?= $resS['name_sub']; ?></div>
                           <ul class="subscription__body-list">
                              <li>Оплата за <?= $resS['duration_month']; ?> тренувань</li>
                              <?
                              $features = array(
                                 'shower' => 'Душ',
                                 'cloakroom' => 'Роздягальня',
                                 'safe' => 'Сейф'
                              );
                              foreach ($features as $key => $value) {
                                 if ($resS[$key] == 1) {
                                    echo "<li>$value</li>";
                                 }
                              }
                              $des = $resS['description'];
                              $desc = explode("\n", $des);
                              foreach ($desc as $descr) {
                                 if (!empty(trim($des))) {
                                    echo "<li>{$descr}</li>";
                                 }
                              }
                              ?>
                           </ul>
                           <div class="subscription__body-price">
                              <div class="subscription__body-caption">Ціна:</div>
                              <div class="subscription__body-price-row">
                                 <div class="subscription__body-cost"><? echo (!$resS['price'] == NULL) ? $resS['price'] : "000"; ?></div>
                                 <div class="subscription__body-currency"><? echo $resS['currency']; ?></div>
                              </div>
                           </div>
                           <div class="subscription__body-formalize">
                              <a href="#" class="subscription__body-btn feedbackOpen">Замовити</a>
                           </div>
                        </div>
                     <?
                     }
                     ?>

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
   <script src="js/scriptourclub.js"></script>
   <script src="js/burger.js"></script>
   <script src="js/feedback.js"></script>
</body>

</html>