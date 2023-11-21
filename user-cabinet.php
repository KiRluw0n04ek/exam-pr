<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }

        .desc {
            text-align: left;
            margin-left: 20px;
        }

        .name h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .email a {
            text-decoration: none;
            color: #007bff;
        }

        .head {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            background-color: #ffffff;
            border-radius: 50%;
            margin-right: 20px;
            background-image: url('<?= $_SESSION['user']['avatar'] ?>');
            background-size: cover;
            background-position: center;
            display: inline-block;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            margin-left: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap py-3 mb-4 border-bottom">
        <div class="avatar"></div>
        <div class="desc">
            <div class="name">
                <h2><?= $_SESSION['user']['full_name'] ?></h2>
            </div>
            <div class="email">
                <a href="#"><?= $_SESSION['user']['email'] ?></a>
            </div>
        </div>
    </header>
</div>

<div class="head">
    <div class="avatar"></div>
    <a href="user.php">Голосування</a>
</div>

</body>
</html>
