<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

if ($login === 'admin' && $password === '877e6838e6bd5f1f8052d41650170dfe') {
\
    header('Location: ../admin.php');
} else {
    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
            "avatar" => $user['avatar'],
            "email" => $user['email']
        ];


        header('Location: ../user-cabinet.php');
    } else {

        $_SESSION['message'] = "Пароль або логін введені неправильно!";
        header('Location: ../login.php');
    }
}
?>
