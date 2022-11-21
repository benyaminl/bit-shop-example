<?php 
// This file will contain all our function
// example we will put LoginCheckRedirect()

include_once __DIR__."/dto.php";
include_once __DIR__."/conn.php"; // The Connection!

function LoginCheckRedirect() : void
{
    if (session_id() == "") // If it's blank, start the session
        session_start();
    
    // This is for check if we are already login or not!
    if (!isset($_SESSION["user"])) 
    {
        // if the user hasn't logged in
        // WE NEED TO KICK THE USER!
        header("Location: /index.php");
        exit;
    }
}

function MP_GetData() : array 
{
    /** @var \PDO $db */
    global $db; // This declare the $db in conn.php to be used here
    // Because we already call it on line 6 using include_once!
    $data = []; // Init the data!
    
    // Prepare query 
    $query = "SELECT * FROM product";
    $temp = $db->query($query);
    
    foreach ($temp as $k => $d) {
        $data[] = new Product($d["id"], $d["name"], $d["price"]);
    }

    return $data;
}

function MP_AddData($payload) : int 
{
    /** @var \PDO $db */
    global $db; // This declare the $db in conn.php to be used here
    // Because we already call it on line 6 using include_once!
    $success = 0;

    // If not we can proceed 
    // $d = new Product($payload["pid"], $payload["pname"], $payload["pprice"]);
    // Line 51 and 52 are the same
    // $query = "INSERT INTO product(id, name, price) VALUES(:pid, :pname, :pprice)";
    $query = "INSERT INTO product VALUES(:pid, :pname, :pprice)";
    $stmt = $db->prepare($query);
    // var_dump($payload); // Check the payload content!
    // you can unset the index
    unset($payload["btnInsertProduct"]);
    // OR YOU CAN CREATE A NEW ARRAY BASED ON THE PAYLOAD!
    // $success = $stmt->execute([
    //     "pid" => $payload["pid"],
    //     "pname" => $payload["pname"],
    //     "pprice" => $payload["pprice"]
    // ]);

    $success = $stmt->execute($payload); // Change to one when it's succesful!
    
    return $success;
}

function MP_DeleteData($pid)
{
    /** @var \PDO $db */
    global $db; // This declare the $db in conn.php to be used here
    // Because we already call it on line 6 using include_once!
    $status = 0;
    $query = "DELETE FROM product WHERE id = :id";
    $stmt = $db->prepare($query);

    $status = $stmt->execute([
        "id" => $pid
    ]);

    return $status;
}

function MP_UpdateData($pid, $payload)
{
    /** @var \PDO $db */
    global $db; // This declare the $db in conn.php to be used here
    // Because we already call it on line 6 using include_once!
    $status = 0;
    $query = "UPDATE product SET id = :newID, name = :name, price = :price
                WHERE id = :oldID";
    $stmt = $db->prepare($query);

    $status = $stmt->execute([
        "oldID" => $pid,
        "newID" => $payload["pid"],
        "name" => $payload["pname"],
        "price" => $payload["pprice"]
    ]);

    return $status;
}

function array_indexOf($array, $callback)
{
    $found =-1;
    foreach ($array as $key => $val) {
        if ($callback($val) == true)
        {
            $found = $key;
        }
    }
    return $found;
}

function MP_Search($q) : array 
{
    /** @var \PDO $db */
    global $db; // This declare the $db in conn.php to be used here
    // Because we already call it on line 6 using include_once!
    $data = []; // Init the data!
    
    // Prepare query 
    $query = "SELECT * FROM product WHERE name LIKE :name OR id LIKE :id";
    $stmt = $db->prepare($query);
    
    $stmt->execute([
        "id" => "%$q%",
        "name" => "%$q%"
    ]);

    $temp = $stmt->fetchAll();
    
    foreach ($temp as $k => $d) {
        $data[] = new Product($d["id"], $d["name"], $d["price"]);
    }
    
    return $data;
}

/**
 * Get Item by ID
 * @param string $id 
 * @return Product|null 
 * @throws PDOException 
 */
function MP_GetItemById(string $id)
{
    $data = MP_Search($id);
    
    if(count($data) <= 0)
        return null;
    
    return $data[0];
}