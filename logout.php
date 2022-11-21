<?php 

session_start();
$_SESSION["user"] = null;
unset($_SESSION["user"]);
session_destroy();
$msg = "Anda berhasil keluar";
$msg = urlencode($msg);
setcookie("remember", null, 0);
header("Location: index.php?msg=".$msg);
exit;