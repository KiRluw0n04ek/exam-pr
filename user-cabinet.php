<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

  <div class="container">
  <header class="d-flex flex-wrap py-3 mb-4 border-bottom">

      <svg class="bi me-2" width="40" height="32"><img src = "<?= $_SESSION['user']['avatar'] ?>" width = "20%" height = "22%" alt = ""></svg>
      <div class = "desc"><div class = "name"> <h2><?= $_SESSION['user']['full_name'] ?></h2></div>
      <div class = "email"><a href = "#"><?= $_SESSION['user']['email'] ?></a></div></div>



  </header>
</div>



    <div class = "head">
      <div class = "avatar"></div>


    </div>
</body>

</html>
