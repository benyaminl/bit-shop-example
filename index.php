<?php
if (isset($_COOKIE["remember"]))
{
    session_start();
    $_SESSION["user"] = $_COOKIE["remember"];
    $_SESSION["msg"] = "Berhasil Login dari Remember!";
    
    setcookie("remember", $_COOKIE["remember"], time() + 24*7*3600);
    
    header("Location: home.php"); exit;
}

$msg = (isset($_GET["msg"])) ? $_GET["msg"] : ""; 
if (isset($_POST["btnLogin"])) {
    session_start(); // to start a session!
    if ($_POST["user"] == "admin" && $_POST["password"] == "admin")
    {    
        $_SESSION["user"] = $_POST["user"];
        $_SESSION["msg"] = "Berhasil Login";
        if (isset($_POST["remember"])) {
            setcookie("remember", $_POST["user"], time() + 24*7*3600);
        }
        header("Location: home.php"); exit;
    } 
    else 
    {
        $msg = "Uh Oh, your user or pass is wrong!";
    }
}
if ($msg != "") $msg = "<h3>".$msg."</h3>";
?>
<form method="post">
    <?= $msg ?>
    <h3>Login</h3>
    <input type="text" name="user">
    <br>
    <input type="password" name="password">
    <br>
    <input type="checkbox" name="remember" value="1"> Remember Me
    <br>
    <button name="btnLogin" value="1" type="submit">Login</button>
</form>