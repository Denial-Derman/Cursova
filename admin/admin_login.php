<!DOCTYPE html>
<html lang="ukr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Вхід на адмін панель</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../css/zero.css">
   <link rel="stylesheet" type="text/css" href="../css/style_index-admin.css">
</head>
<?
session_start();
$log_bd = mysqli_connect("localhost", "root", "", "StoneBreaker");
$logRes = mysqli_query($log_bd, "SELECT `name`, `password` FROM `login_admin` WHERE `id`='1'");
$log = mysqli_fetch_assoc($logRes);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = $_POST['name'];
   $password = $_POST['password'];
   if ($name == $log['name'] && crypt($password, '$1$rasmusle$') == crypt($log['password'], '$1$rasmusle$')) {
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $name;
      $_SESSION['password'] = $password;
      header('Location: admin_index.php');
      exit;
   } else {
      $error = "Пароль або логін введено не вірно!";
   }
}
?>

<body>
   <div class="login">
      <form method="post" action="admin_login.php" enctype="multipart/form-data">
         <h2>Вхід в Адмін панель</h2>
         <p>Логін адміна:<input type="text" name="name" id="" required></p>
         <p>Пароль:<input type="password" name="password" id="" required></p>
         <button type="submit" name="login">Вхід</button>
      </form>
   </div>
</body>

</html>