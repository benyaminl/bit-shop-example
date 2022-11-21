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

$product = MP_GetItemById($_POST["id"]);
$cartItem = new CartItem($product, $_POST["jumlah"]);

$cart->AddItem($cartItem);
$return = [
    "code" => "OK",
    "status" => true,
    "message" => "Berhasil tambah Cart"
];

header("content-type: application/json");
echo json_encode($return);