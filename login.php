<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

    <form action = "includes/signin.php" method="post">
      <h1>Авторизація</h1>
        <label>Логін</label>
        <input type = "text" name = "login" placeholder="Введіть логін">
        <label>Пароль</label>
        <input type = "password" name = "password" placeholder="Введіть пароль">
        <button type = "submit">Ввійти</button>
        <p>У Вас нема акаунта? Тоді <a href="register.php">зареєструйтеся</a>!</p>
        <?php if($_SESSION['message']){
          echo '<p class = "msg"> ' . $_SESSION['message'] . ' </p>';
        }
          unset($_SESSION['message']); ?>

    </form>
    <p id="message"></p>
</body>
<script>
function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Перевірка логіна та паролю
    if (username in users && users[username] === password) {
        if (username === 'admin') {
            window.location.href = 'admin-success.php'; // Адмін авторизований
        } else {
            window.location.href = 'user-cabinet.php'; // Звичайний користувач авторизований
        }
    } else {
        document.getElementById("message").textContent = "Неправильний логін або пароль";
    }
}
</script>
</html>
