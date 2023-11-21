  <?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

    <form action = "includes/signup.php" method="post" enctype="multipart/form-data">
      <h1>Авторизація</h1>
        <label>ПІП:</label>
        <input type = "text" name = "full_name" placeholder="Введіть ім'я, прізвище та по батькові">
        <label>Логін:</label>
        <input type = "text" name = "login" placeholder="Введіть логін">
        <label>E-mail:</label>
        <input type = "text" name = "email" placeholder="Введіть електронну пошту">
        <label>Завантажте фото профілю:</label>
        <input type = "file" name = "avatar">
        <label>Пароль:</label>
        <input type = "password" name = "password" placeholder="Введіть пароль">
        <label>Повторіть пароль:</label>
        <input type = "password" name = "repeat_password" placeholder="Повторіть пароль">
        <button type = "submit">Зареєструватися</button>
        <p>Вже є акаунт? Тоді <a href="login.php">вперед</a>!</p>
        <?php
        if($_SESSION['message']){
          echo '<p class = "msg"> ' . $_SESSION['message'] . ' </p>';
        }
          unset($_SESSION['message']);
        ?>


    </form>
    <p id="message"></p>
</body>
<script>
function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username in users && users[username] === password) {
        if (username === 'admin') {
            window.location.href = 'admin-success.php';
        } else {
            window.location.href = 'user-cabinet.php';
        }
    } else {
        document.getElementById("message").textContent = "Неправильний логін або пароль";
    }
}
</script>
</html>
