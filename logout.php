<?php
  session_start();

  if($_GET['type'] == 0) {
    unset($_SESSION['use']);
  }
  else if($_GET['type'] == 1) {
    unset($_SESSION['cruse']);
  }
  else if($_GET['type'] == 2) {
    unset($_SESSION['muse']);
  } 
  else if($_GET['type'] == 3) {
    unset($_SESSION['ause']);
  }   

  header("Location: index.html");
?>
