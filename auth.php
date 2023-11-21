<?php
  if($_COOKIE['User'] == 'YES')
    setcookie('User', 'YES', time() - 3600, '/' );
  else
    setcookie('User', 'YES', time() + 3600, '/' );

  header('Location: /');
 ?>
