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
$t = mysqli_query($connect_bd, "SELECT* FROM `timetable`");
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
                  <form action="admin_timetable-add.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Розклад</h2>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Фото:</label>
                        <label for="image" class="form__file-block" id="fileBtn" required>Вибрати файл</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form__file" onchange="updateFileName(this)">
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="image" class="form__text">Назва зображення:</label>
                        <input type="text" name="imageName" id="imageName" class="form__input-text" readonly>
                     </div>
                     <div class="form__block form__block-grid"><label for="title" class="form__text">Назва:</label><input type="text" name="title" placeholder="Назва" class="form__input-text" required></div>
                     <div class="form__list">
                        <label for="type" class="form__text">Час та опис:</label>
                        <div class="form__list list" id="listTime1">
                           <select name="type[0]" id="DayVar1" class="form__sel" onchange="handleDayVar1Change()" required>
                              <option value="Пн-Вс">Пн-Вс</option>
                              <option value="Пн-Сб">Пн-Сб</option>
                              <option value="Пн-Пт">Пн-Пт</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields1">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[0][]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[0][]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="form__list list" id="listTime2">
                           <select name="type[1]" id="DayVar2" class="form__sel" onchange="handleDayVar2Change()">
                              <option value="Вс-Cб">Вс-Cб</option>
                              <option value="Сб">Сб</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields2">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[1][]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[1][]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="form__list list" id="listTime3">
                           <select name="type[2]" id="DayVar3" class="form__sel" onchange="handleDayVar3Change()">
                              <option value="Вс">Вс</option>
                           </select>
                           <div class="form__list-block form__list" id="dynamicFields3">
                              <div class="form__block">
                                 <button type="button" class="form__btn-time" onclick="addFields(this)">+</button><label for="" class="form__text">Додати пункт</label>
                                 <button type="button" class="form__btn-time" onclick="removeField(this)">-</button><label for="" class="form__text">Видалити останній пункт</label>
                              </div>
                              <div class="form__block form__block-grid">
                                 <input type="time" name="times[2][]" id="" class="form__input-text form__input-time">
                                 <input type="text" name="times_text[2][]" id="" class="form__input-text" placeholder="Примітка">
                              </div>
                           </div>
                        </div>
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
   $image = $_FILES['image']['name'];
   if (!empty($image = $_FILES['image']['name'])) {
      $image = $_FILES['image']['name'];
      $uploaddir = 'img/timetable/';
      $uploadfile = $uploaddir . basename($image);
      if (copy($_FILES['image']['tmp_name'], $uploadfile)) {
         echo "<p>Файл завантажений на сервер</p>";
      } else {
         echo "<p>Помилка!</p>";
         exit;
      }
   } else {
      $image = 'noimage.png';
   }
   $title = $_POST["title"];
   $times = $_POST['times'];
   $type = $_POST['type'];
   $times_text = $_POST['times_text'];

   $dataArray = array();
   for ($i = 0; $i <= count($type); $i++) {
      $dataArray[] = $type[$i];
      if (isset($times_text[$i]) && is_array($times_text[$i])) {
         foreach ($times_text[$i] as $index => $text) {
            $dataArray[] = $times[$i][$index] . ' - ' . $text;
         }
      }
   }
   $time = implode("\r\n", $dataArray);

   function incrementId($id)
   {
      // Збільшити порядкове число на 1
      $new_id = $id + 1;
      return $new_id;
   }
   $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id) FROM `timetable`");
   $max_id_row = mysqli_fetch_assoc($result_max_id);
   $max_id = $max_id_row['MAX(id)'];
   $new_id = incrementId($max_id);

   $sql = "SELECT * FROM `timetable` WHERE `name_time` = '$title' AND`time_list`= '$time'";
   $verification = mysqli_query($connect_bd, $sql);
   if (mysqli_num_rows($verification) > 0) {
      echo "Даний абонемент вже існує";
   } else {
      $query = "INSERT INTO `timetable` (`id`, `id_time_home`, `name_time`, `time_list`, `image`) VALUES ('$new_id','1', '$title','$time','$image')";
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