<?php
  // print_r($_POST);
  $email = $_POST['email'];
  $message = $_POST['message'];

  $err = '';
  if(trim($email) == '')
    $error = "Введіть ваш E-mail";
  else if (trim($message) == '')
    $error = "Введіть повідомлення";
  else if (strlen($message) < 10)
    $error = "Повідомлення занадто коротке!(10 символів мінімум)";

  if($error != ''){
    echo $error;
    exit;
  }

  $subject = "=?utf-8?B?".base64_encode("Тестове повідомлення")."?=";
  $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html;charset=utf-8\r\n";

  mail('kyryl.next@gmail.com', $subject, $message, $headers);

  header('Location: /about.php');
 ?>
