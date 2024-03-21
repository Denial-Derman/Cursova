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
   <link rel="stylesheet" type="text/css" href="css/style_vacancies-add-admin.css">
   <link rel="stylesheet" type="text/css" href="css/style_form-admin.css">
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
// $t = mysqli_query($connect_bd, "SELECT `vacancies`.*,`club_train`.`image` FROM `vacancies`, `club_train` WHERE `vacancies`.`id_club_train`=`club_train`.`id`AND`vacancies`.`id`='Ti1'");
// $resT = mysqli_fetch_assoc($t);
?>

<body>
   <div class="wrapper">
      <svg xmlns="http://www.w3.org/2000/svg">
         <filter id="outlineBlack">
            <feMorphology in="SourceAlpha" result="Dilated" operator="dilate" radius="1.5" />
            <feMerge>
               <feMergeNode in="Outline" />
               <feMergeNode in="SourceGraphic" />
            </feMerge>
         </filter>
         <filter id="outlineBlack1">
            <feMorphology in="SourceAlpha" result="Dilated" operator="dilate" radius="1" />
            <feMerge>
               <feMergeNode in="Outline" />
               <feMergeNode in="SourceGraphic" />
            </feMerge>
         </filter>
      </svg>
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
               <h2 class="admin__title title">Додати вакансію</h2>
               <div class="div">
                  <form action="admin_vacancies-add.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Вакансія</h2>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Фонове зображення:</label>
                        <label for="image" class="form__file-block" id="fileBtn">Вибрати файл</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form__file" onchange="updateFileName(this)" required>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Назва зображення:</label>
                        <input type="text" name="imageName" id="imageName" class="form__input-text" readonly>
                     </div>
                     <div class="form__block form__block-grid"><label for="name" class="form__text">Назва:</label><input type="text" name="title" placeholder="Назва" class="form__input-text" required></div>
                     <div class="form__list">
                        <label for="req" class="form__text">Вимоги:</label>
                        <textarea name="req" id="" cols="20" rows="5" class="form__textarea" placeholder="Вимоги..."></textarea>
                     </div>
                     <div class="form__list">
                        <label for="duties" class="form__text">Обов'язоки:</label>
                        <textarea name="duties" id="" cols="20" rows="5" class="form__textarea" placeholder="Обов'язки..."></textarea>
                     </div>
                     <div class="form__block">
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <div class="admin__demo-title">Зразок результату</div>
                     <div class="vacancies__cart1" style="background: url(img/vacancies/noimage.png)  left no-repeat; background-size: cover;">
                        <div class="vacancies__cart1-title">
                           Назва вакансії
                        </div>
                        <a href="vacancies-act.php?id=V1" class="vacancies__cart1-btn">
                           <p class="vacancies__cart1-btn-text">
                              Перейти
                           </p>
                        </a>
                     </div>
                     <div class="vacancies__cart">
                        <div class="vacancies__cart-image" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(img/vacancies/noimage.png) center no-repeat; background-size: cover;">
                           <div class="vacancies__cart-btn">
                              <p class="vacancies__cart-btn-text">Подати заявку</p>
                           </div>
                        </div>
                        <div class="vacancies__mob-title">
                           <div class="vacancies__mob-conditions vacancies__mob-el act-title" id="tab1">Умови</div>
                           <div class="vacancies__mob-application vacancies__mob-el" id="tab2">Заявки</div>
                        </div>
                        <div class="vacancies__cart-block-el">
                           <div class="vacancies__cart-description act-block">
                              <div class="vacancies__cart-requirements">
                                 <h3>Вимоги</h3>
                                 <ul>
                                    <li>Вимога1</li>
                                    <li>Вимога2</li>
                                    <li>Вимога3</li>
                                 </ul>
                              </div>
                              <div class="vacancies__cart-duties">
                                 <h3>Обов'язки</h3>
                                 <ul>
                                    <li>Обов'язок1</li>
                                    <li>Обов'язок2</li>
                                    <li>Обов'язок3</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <script src="js/admin_form.js"></script>
   <script src="js/timetable-admin.js"></script>
</body>
<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $image = $_FILES['image']['name'];
   $uploaddir = 'img/vacancies/';
   $uploadfile = $uploaddir . basename($image);
   if (copy($_FILES['image']['tmp_name'], $uploadfile)) {
      echo "<p>Файл завантажений на сервер</p>";
   } else {
      echo "<p>Помилка!</p>";
      exit;
   }
   $title = $_POST["title"];
   $req = isset($_POST["req"]) ? $_POST["req"] : NULL;
   $duties = isset($_POST["duties"]) ? $_POST["duties"] : NULL;
   function incrementId($id)
   {
      // Збільшити порядкове число на 1
      $new_id = $id + 1;
      return $new_id;
   }
   $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id) FROM `vacancies`");
   $max_id_row = mysqli_fetch_assoc($result_max_id);
   $max_id = $max_id_row['MAX(id)'];
   $new_id = incrementId($max_id);

   $sql = "SELECT * FROM `vacancies` WHERE `name_vacancies`='$title'";
   $verification = mysqli_query($connect_bd, $sql);
   if (mysqli_num_rows($verification) > 0) {
      echo "Даний абонемент вже існує";
   } else {
      $query = "INSERT INTO `vacancies` (`id`, `id_vac_home`, `name_vacancies`, `fons`, `requirements`, `duties`) VALUES ('$new_id','1','$title','$image','$req','$duties')";
      $result = mysqli_query($connect_bd, $query);
      if ($result) {
         echo "Дані успішно додано в базу даних.";
      } else {
         echo "Дані не додано в базу даних.";
      }
   }
}
?>

</html>