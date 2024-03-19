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
   <link rel="stylesheet" type="text/css" href="css/zero.css">
   <link rel="stylesheet" type="text/css" href="css/style_form-admin.css">
   <link rel="stylesheet" type="text/css" href="css/style_subscription-add-admin.css">
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
$sub = mysqli_query($connect_bd, "SELECT * FROM `subscription`, `duration` WHERE `subscription`.`id_fee_for`=`duration`.`id_duration`");
$resSub = mysqli_fetch_assoc($sub);
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
               <h2 class="admin__title title">Додавання Абонементу</h2>
               <div class="div">
                  <form action="admin_.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Абонемент</h2>
                     <div class="form__block form__block-grid">
                        <label for="name" class="form__text">Назва:</label>
                        <input type="text" name="name" placeholder="Назва" class="form__input-text" required>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="stand" class="form__text">Стандартний пункт:</label>
                        <input type="checkbox" name="stand" placeholder="Назва" class="form__input-text form__input-check" checked required>
                     </div>
                     <div class="form__list">
                        <label for="textarea" class="form__text">Опис:</label>
                        <textarea name="textarea" id="" cols="20" rows="5" class="form__textarea">Додатковий текст...</textarea>
                     </div>
                     <div class="form__list">
                        <div class="form__block form__block-grid"><label for="list" class="form__text">Ціна:</label>
                           <div class="form__block form__block-price">
                              <input type="number" name="name" placeholder="000" class="form__input-text" required>
                              <select name="list" id="" class="form__sel">
                                 <option value="Грн">Грн</option>
                                 <option value="Євро">Євро</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form__block">
                        <button id="timeText" class="form__btn">Попередній перегляд</button>
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <div class="admin__demo-title">Перед показ </div>
                     <div class="subscription__body">
                        <div class="subscription__body-title" id="prnameSub">Назва Абонемента</div>
                        <div class="subscription__body-time" id="durationTimeSub">
                        </div>
                        <ul class="subscription__body-list" id="elment">
                           <li>Оплата за N місяців тренувань</li>
                           <li>Душ</li>
                           <li>Роздягальня</li>
                           <li>Сейф</li>
                        </ul>
                        <div class="subscription__body-price">
                           <div class="subscription__body-caption">Ціна:</div>
                           <div class="subscription__body-price-row">
                              <div class="subscription__body-cost" id="prprice">000</div>
                              <div class="subscription__body-currency" id="prcurrency">Грн</div>
                           </div>
                        </div>
                        <div class="subscription__body-formalize">
                           <a href="#" class="subscription__body-btn">Оформити абонемент</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <script src="js/admin_form.js"></script>
   <script src="js/script_subscription-admin.js"></script>
</body>

</html>