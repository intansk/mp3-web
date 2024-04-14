<?php
session_start();

session_unset();
session_destroy();

setcookie(
  'ingat_saya_pelanggan',
  null,
  time() - 3600,
  '/'
);

header('Location: ../index.php');
exit;
?>
