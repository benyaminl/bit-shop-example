<?php 
session_start();
$msg = (isset($_SESSION["msg"])) ? $_SESSION["msg"] : "";
// This is for check if we are already login or not!
if (!isset($_SESSION["user"])) 
{
    // if the user hasn't logged in
    // WE NEED TO KICK THE USER!
    header("Location: index.php");
    exit;
}
if ($msg != "") $msg = "<h3>".$msg."</h3>";
?>
<?= $msg ?> <br>
<?= $_SESSION["user"] ?>
<a href="logout.php">Logout</a>
<?php 
unset($_SESSION["msg"]); // DESTROY THE MESSAGE!
?>