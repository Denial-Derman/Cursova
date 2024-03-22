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
            <div class="block__flex">
               <h2 class="admin__title title">Додавання Абонементу</h2>
               <div class="div">
                  <form action="admin_subscription-add.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Абонемент</h2>
                     <div class="form__block form__block-grid">
                        <label for="title" class="form__text">Назва:</label>
                        <input type="text" name="title" placeholder="Назва" class="form__input-text" required>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="month" class="form__text">Кількість місяців:</label>
                        <select name="month" id="" class="form__sel">
                           <? $bd_month = mysqli_query($connect_bd, "SELECT * FROM `duration`");
                           while ($resMonth = mysqli_fetch_assoc($bd_month)) {
                              echo "<option value='{$resMonth['id_duration']}'>{$resMonth['duration_month']}</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="stand" class="form__text">Стандартний пункт:</label>
                        <input type="checkbox" name="stand" placeholder="Назва" class="form__input-text form__input-check" checked required>
                     </div>
                     <div class="form__list">
                        <label for="textarea" class="form__text">Опис:</label>
                        <textarea name="textarea" id="" cols="20" rows="5" class="form__textarea" placeholder="Додатковий текст..."></textarea>
                     </div>
                     <div class="form__list">
                        <div class="form__block form__block-grid"><label for="price" class="form__text">Ціна:</label>
                           <div class="form__block form__block-price">
                              <input type="number" name="price" placeholder="000" id="price" class="form__input-text" required>
                              <select name="currency" id="" class="form__sel">
                                 <option value="Грн">Грн</option>
                                 <option value="Євро">Євро</option>
                              </select>
                           </div>
                        </div>
                        <div id="error-message">Помилки відсутні</div>
                     </div>
                     <div class="form__block">
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <div class="admin__demo-title">Зразок результату</div>
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
      <?
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $title = mysqli_real_escape_string($connect_bd, $_POST["title"]); //text
         $month = $_POST["month"]; //value
         $check = isset($_POST["stand"]) ? 1 : 0; //checkbox
         $desc = isset($_POST["textarea"]) ? mysqli_real_escape_string($connect_bd, $_POST["textarea"]) : NULL; //textarea
         $price = $_POST["price"]; //number
         $currency = $_POST["currency"]; //value
         function incrementId($id)
         {
            // Збільшити порядкове число на 1
            $new_id = $id + 1;
            return $new_id;
         }
         $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id) FROM `subscription`");
         $max_id_row = mysqli_fetch_assoc($result_max_id);
         $max_id = $max_id_row['MAX(id)'];
         $new_id = incrementId($max_id);

         $sql = "SELECT * FROM `subscription` WHERE `name_sub` = '$title' AND `id_fee_for` = '$month' AND `shower`='$check'AND `cloakroom`='$check'AND `safe`='$check'AND`description`='$desc'";
         $verification = mysqli_query($connect_bd, $sql);
         if (mysqli_num_rows($verification) > 0) {
            echo "Даний абонемент вже існує";
         } else {
            $query = "INSERT INTO `subscription` (`id`, `id_sub-home`, `name_sub`, `id_fee_for`, `shower`, `cloakroom`, `safe`, `description`, `price`, `currency`) VALUES ('$new_id','1', '$title','$month',' $check','$check','$check', '$desc','$price','$currency')";
            $result = mysqli_query($connect_bd, $query);
            if ($result) {
               echo "Дані успішно додано в базу даних.";
            } else {
               echo "Дані не додано в базу даних.";
            }
         }
      }
      ?>
   </div>
   <script src="js/admin_form.js"></script>
   <!-- <script src="js/script_subscription-add-admin.js"></script> -->
</body>


</html>