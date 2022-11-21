<?php 

include realpath(__DIR__."/../library.php");

if (session_id() == "") // If it's blank, start the session
    session_start();

if (!isset($_SESSION["cart"]))
    $_SESSION["cart"] = Cart::singleton();

/**
 * @var Cart $cart
 */
$cart = $_SESSION["cart"];

foreach ($cart->GetAllItem() as $key => $value) {
    echo $value->Render();
}

if (count($cart->GetAllItem()) <= 0)
{
    echo "<h4>Cart is empty!</h4>";
}