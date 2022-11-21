<?php 
include_once __DIR__."/library.php";

header("content-type: application/json");
try {
    if(!is_numeric($_POST["pprice"])) 
        throw new Exception("Price bukan angka!", 1);
    
    if($_POST["pid"] == "" or $_POST["pid"] == null)
        throw new Exception("ID BARANG TIDAK BOLEH NULL!", 2);

    $result = MP_AddData($_POST);
    
    if ($result > 0) 
    {
        echo json_encode(["message" => "Berhasil insert data!"]);
    }
    else 
    {
        echo json_encode(["message" => "Gagal insert data!"]);
    }
}
catch (Exception $e)
{
    http_response_code(400);
    echo json_encode(["message" => "Gagal insert data : {$e->getMessage()}!"]);
}