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
   <link rel="stylesheet" type="text/css" href="css/style_timetable-add-admin.css">
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
$timeUpId = $_SESSION['timeId'];
$t = mysqli_query($connect_bd, "SELECT * FROM `timetable` WHERE `id`='$timeUpId'");
$resT = mysqli_fetch_assoc($t);
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
               <h2 class="admin__title title">Додати розклад</h2>
               <div class="div">
                  <form action="admin_timetable-up.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Розклад</h2>
                     <div class="form__block form__block-grid">
                        <label for="imgName1" class="form__text">Назва активного зображення:</label>
                        <input type="text" name="imgName1" class="form__input-text" value="<? echo $resT['image']; ?>" readonly>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Фонове зображення:</label>
                        <label for="image" class="form__file-block" id="fileBtn">Вибрати файл</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form__file" onchange="updateFileName(this)">
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="imageName" class="form__text">Назва нового зображення:</label>
                        <input type="text" name="imageName" id="imageName" class="form__input-text" readonly>
                     </div>
                     <div class="form__block form__block-grid"><label for="title" class="form__text">Назва:</label><input type="text" name="title" placeholder="Назва" class="form__input-text" value="<? echo $resT['name_time'] ?>" required>
                     </div>
                     <div class="form__list">
                        <label for="time_list" class="form__text">Час та опис:</label>
                        <textarea name="time_list" id="" cols="20" rows="10" class="form__textarea" placeholder="Додатковий текст..."><? echo $resT['time_list']; ?></textarea>
                     </div>
                     <div class="form__block">
                        <button type="submit" name="dot" class="form__btn">Додати</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <div class="admin__demo-title">Зразок результату</div>
                     <div class="timetable__flex-block" style="background:url(img/timetable/noimage.png) center no-repeat; background-size:cover;">
                        <div class="timetable__btn-block">
                           <div class="timetable__btn" id="timeTableBtn">
                              Назва розкладу
                           </div>
                        </div>
                        <ul class='timetable__time' id="timetableList">
                           <li>Пн-Сб</li>
                           <li>09:30 - Початок</li>
                           <li>12:30 - Перерва</li>
                           <li>09:30 - Закриття</li>
                        </ul>
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
   if (!empty($_FILES['image']['name'])) {
      $image = $_FILES['image']['name'];
      $uploaddir = 'img/timetable/';
      $uploadfile = $uploaddir . basename($image);
      if (copy($_FILES['image']['tmp_name'], $uploadfile)) {
         echo "<p>Файл завантажений на сервер</p>";
      } else {
         echo "<p>Помилка при завантаженні файлу!</p>";
         exit;
      }
   } else {
      $image = $_POST['imgName1'];
   }
   $title = mysqli_real_escape_string($connect_bd, $_POST['title']);
   $time = mysqli_real_escape_string($connect_bd, $_POST['time_list']);
   $sql = "SELECT * FROM `timetable` WHERE `id`='$timeUpId' AND `name_time` = '$title' AND`time_list`= '$time' AND `image`='$image'";
   $verification = mysqli_query($connect_bd, $sql);
   if (mysqli_num_rows($verification) > 0) {
      echo "Даний абонемент вже існує";
   } else {
      $query = "UPDATE `timetable` SET `name_time`='$title', `time_list`='$time', `image`='$image' WHERE `id`='$timeUpId'";
      $result = mysqli_query($connect_bd, $query);
      if ($result) {
         echo "Додано зміни";
         echo "<script>window.location = 'admin_timetable-up.php';</script>";
      } else {
         echo "Зміни відсутні";
         echo  mysqli_error($connect_bd);
         echo "<script>window.location = 'admin_timetable-up.php';</script>";
      }
   }
}
?>

</html>