<?
$connect_bd = mysqli_connect("localhost", "root", "", "StoneBreaker");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $vacancies_id = $_GET['id'];
   echo "";
   function incrementId($id)
   {
      // Збільшити порядкове число на 1
      $new_id = $id + 1;
      return $new_id;
   }
   $name = $_POST["feedbackName"];
   $tel = $_POST["feedbackNumber"];
   $result_max_id = mysqli_query($connect_bd, "SELECT MAX(id_client) FROM `client`");
   $max_id_row = mysqli_fetch_assoc($result_max_id);
   $max_id = $max_id_row['MAX(id_client)'];
   $new_id = incrementId($max_id);
   $query = "INSERT INTO `client` (`id_client`,`name_client`, `tel_client`) VALUES ('$new_id','$name', '$tel')";
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
}
$lok = $_SERVER['HTTP_REFERER'];
header("Location:$lok");
