<?php
  session_start();
  require_once 'connect.php';


  $full_name = $_POST['full_name'];
  $login = $_POST['login'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repeat_password = $_POST['repeat_password'];

if ($password === $repeat_password) {

  $path = 'uploads/' . time() . $_FILES['avatar']['name'];
          if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
              $_SESSION['message'] = 'Помилка при завантаженні';
              header('Location: ../register.php');
          }

          $password = md5($password);

          mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`)
          VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

          $_SESSION['message'] = "Реєстрація успішна!";
header('Location: ../login.php');

}
else {
  $_SESSION['message'] = "Паролі не співпадають!";
  header('Location: ../register.php');
}
