<?php

  $connect = mysqli_connect('localhost', 'root', '', 'Autorization');

  if (!$connect){
    die("Error connect to DataBase");
  }
