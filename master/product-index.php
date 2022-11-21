<?php
//echo __DIR__."<br/>";
include_once __DIR__."/../library.php";
//echo __DIR__."/../library.php"."<br/>";
//echo realpath(__DIR__."/../library.php")."<br/>";

//echo realpath(__DIR__."/../../")."<br/>";

LoginCheckRedirect();
$msg = ""; // INIT MSG! 
// We Check if there are post!
if (isset($_POST["btnInsertProduct"]))
{
    $result = MP_AddData($_POST);
    if ($result == 1) $msg = "Success add Product";
    else $msg = "Error add Product";
}

if (isset($_POST["btnUpdateProduct"]))
{
    $result = MP_UpdateData($_POST["old_id"], $_POST);
    if ($result == 1) $msg = "Success update Product";
    else $msg = "Error update Product";
}

if (isset($_POST["btnDeleteProduct"]))
{
    $result = MP_DeleteData($_POST["pid"]);
    if ($result == 1) $msg = "Success delete Product";
    else $msg = "Error delete Product";
}
// Loading Data from Array!
$data = MP_GetData();

if (isset($_GET["btnSearch"]))
{
    $data = MP_Search($_GET["q"]);
    $msg = "Search with query : {$_GET['q']} <a href='product-index.php'>Clear</a>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Product</title>
</head>
<body>
    <h1>Master Product</h1>
    
    <?= "<h3>$msg</h3>" ?>
    <form method="POST">
        <label>ID</label>
        <input type="text" name="pid" id="pid"> <br>
        <label>Product Name</label>
        <input type="text" name="pname" id="pname"> <br>
        <label>Price</label>
        <input type="text" name="pprice" id="pprice"> <br>
        <button name="btnInsertProduct" value="1">Insert</button>
    </form> <br><br>
    <h3>Search</h3>
    <form>
    <label>Query</label> : <input type="text" name="q" id="q"> <button type="submit" name="btnSearch" value="1">Search</button>
    </form>
    <br><br>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $d) : ?>
            <tr>
                <td><?= $d->id ?></td>
                <td><?= $d->name ?></td>
                <td><?= $d->price ?></td>
                <td><form method="POST">
                    <!-- Ini untuk toggle edit form -->
                    <a href="?edit_id=<?= $d->id ?>">EDIT</a>
                    <input type="hidden" name="pid" value="<?= $d->id ?>">
                    <button type="submit" name="btnDeleteProduct">Delete</button>
                </form></td>
            </tr>
            <?php if(isset($_GET["edit_id"])) : ?>
                <?php if($_GET["edit_id"] == $d->id) : ?>
            <tr>
                <td colspan="4">
                <form method="POST" action="product-index.php">
                    <label>ID</label>
                    <input type="text" name="pid" id="pid" value="<?= $d->id ?>"> <br>
                    <input type="hidden" name="old_id" value="<?= $d->id ?>"> 
                    <label>Product Name</label>
                    <input type="text" name="pname" id="pname" value="<?= $d->name ?>"> <br>
                    <label>Price</label>
                    <input type="text" name="pprice" id="pprice" value="<?= $d->price ?>"> <br>
                    <button name="btnUpdateProduct" value="1">Update</button>
                </form>
                <a href="product-index.php">Clear</a>
                </td>
            </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
