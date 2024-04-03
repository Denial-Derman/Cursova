<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Оновлення тренера</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../css/zero.css">
   <link rel="stylesheet" type="text/css" href="../css/style_form-admin.css">
   <link rel="stylesheet" type="text/css" href="../css/style_trainers-add-admin.css">
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
$trUpId = $_SESSION['trainId'];
$trains = mysqli_query($connect_bd, "SELECT * FROM `trainers`, `trainers_types` WHERE `trainers`.`id`='$trUpId'");
$resTr = mysqli_fetch_assoc($trains);
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
            <div class="block__flex">
               <h2 class="admin__title title">Оновити інформацію тренера</h2>
               <?
               if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                  if (!empty($_FILES['image']['name'])) {
                     $image = $_FILES['image']['name'];
                     $uploaddir = '../img/trainers/';
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
                  $name = mysqli_real_escape_string($connect_bd, $_POST["name"]);
                  $direct = $_POST["direction"];
                  $narr = isset($_POST["narr"]) ? mysqli_real_escape_string($connect_bd, $_POST["narr"]) : NULL;
                  $check = isset($_POST["sert"]) ? 1 : 0;

                  $sql = "SELECT * FROM `trainers` WHERE  `id`='$trUpId' AND `name`='$name' AND `trainers_type`='$direct' AND `image`='$image' AND `information`='$narr' AND `certificate`='$check'";
                  $verification = mysqli_query($connect_bd, $sql);
                  if (mysqli_num_rows($verification) > 0) {
                     echo "Даний абонемент вже існує";
                  } else {
                     $query = "UPDATE `trainers` SET `image`='$image', `name`='$name', `trainers_type`='$direct', `information`='$narr', `certificate`='$check' WHERE `id`='$trUpId'";
                     $result = mysqli_query($connect_bd, $query);
                     if ($result) {
                        echo "Додано зміни";
                        echo "<script>window.location = 'admin_trainers-up.php';</script>";
                     } else {
                        echo  mysqli_error($connect_bd);
                        echo "Зміни відсутні";
                        echo "<script>window.location = 'admin_trainers-up.php';</script>";
                     }
                  }
               }
               ?>
               <div class="div">
                  <form action="admin_trainers-up.php" method="post" class="admin__form" enctype="multipart/form-data">
                     <h2 class="form__title">Тренер</h2>
                     <div class="form__block form__block-grid">
                        <label for="imgName1" class="form__text">Назва активного зображення:</label>
                        <input type="text" name="imgName1" class="form__input-text" value="<? echo $resTr['image']; ?>" readonly>
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
                     <div class="form__block form__block-grid">
                        <label for="name" class="form__text">Ім'я та прізвище:</label><input type="text" name="name" placeholder="Назва" class="form__input-text" value="<? echo $resTr['name'] ?>" required>
                     </div>
                     <div class="form__list">
                        <div class="form__block form__block-grid"><label for="list" class="form__text">Направлення:</label>
                           <select name="direction" id="" class="form__sel">
                              <?
                              foreach ($trains as $resTrList) {
                                 $selected = ($resTrList['trainers_type'] == $resTrList['id_trainers_type']) ? 'selected' : '';
                                 echo "<option value='{$resTrList['id_trainers_type']}' $selected >{$resTrList['name_vacancies']}</option>";
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form__list">
                        <label for="narr" class="form__text">Опис:</label>
                        <textarea name="narr" id="" cols="20" rows="5" class="form__textarea" placeholder="Додатковий текст..."><? echo $resTr['information']; ?></textarea>
                     </div>
                     <div class="form__block form__block-grid">
                        <label for="sert" class="form__text">Сертифікат:</label>
                        <?
                        $stanCheck = ($resTr['certificate'] == 1) ? 'checked' : '';
                        ?>
                        <input type="checkbox" name="sert" placeholder="Назва" class="form__input-text form__input-check" <? echo $stanCheck; ?>>
                     </div>
                     <div class="form__block">
                        <button type="submit" name="submit" class="form__btn">Оновити</button>
                     </div>
                  </form>
                  <div class="admin__right">
                     <div class="admin__demo-title">Зразок результату</div>
                     <div class="trainers__carts1">
                        <img src="../img/trainers/noimage.png" alt="photo-trainers" class="trainers__carts1-image">
                        <div class="trainers__carts1-names">Ім'я Прізвище</div>
                     </div>
                     <div class="trainers__carts2">
                        <div class="trainers__block">
                           <div class="trainers__carts2-names">
                              Ім'я Прізвище
                           </div>
                           <div class="trainers__carts2-type">
                              Направлення тренера
                           </div>
                           <div class="trainers__carts2-info">
                              Слова від тренера. Його ставлення до тренування. Мотивація.<br>
                              Tекст текст текст текст текст текст текст текст текст текст текст текст текст
                           </div>
                           <div class="trainers__carts2-certif">
                              Сертифікат
                              наявний/на разі відсутній
                           </div>
                        </div>
                        <img src="../img/trainers/noimage.png" alt="photo-trainers" class="trainers__carts2-image">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>

   </div>
   <script src="../js/admin_form.js"></script>
</body>


</html>