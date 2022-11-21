<?php

include_once __DIR__."/library.php";

$query = $_GET["query"] ?? ""; // This is check if the get is blank, then use blank string!

$data = MP_Search($query);

header("content-type: application/json");
echo json_encode($data);