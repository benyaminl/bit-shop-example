<?php 
include_once __DIR__."/library.php";

?>
<html>
<head>
<title>Shop Catalog</title>
<style>
#catalog-list .row {
    display:flex;
}

#catalog-list .row .item { 
    margin-right: 8px;
}

#cart-section {
    position: relative;
    text-align: right;
    max-width: 630px;
}

#cart-section #cart-list {
    right:0px;
    display:none; /* This is for hidden */
    text-align: left;
    padding: 8px;
    border-radius: 8px;
    position: absolute;
    background-color: lightgoldenrodyellow;
    box-shadow: 0px 0px 5px grey;
}

#cart-list h4, #cart-list h6 {
    margin: 0;
    margin-bottom: 2px;
}
</style>
</head>
<body>
<h1>Shopping Catalog</h1>
<div id="cart-section">
<h3>Cart : <span id="cart">0</span> <button onclick="showCart()">Show Cart</button> </h3>

<form id="searchForm" onsubmit="searchProduct(event)">
    <input type="text" id="txtSearch"> <button>Cari</button> <br>
</form>

<div id="cart-list">
    <div class="item">
        <h4>Barang 1</h4>
        <h6>Harga : Rp. <span class="harga">10</span></h6>
        <input type="number" name="jumlah" value=1> <br/>
        <button onclick="updateCartItem(1)">Update</button>
        <button onclick="removeFromCart(1)">Trash</button>
    </div>
     <div class="item">
        <h4>Barang 2</h4>
        <h6>Harga : Rp. <span class="harga">10</span></h6>
        <input type="number" name="jumlah" value=2> <br/>
        <button onclick="updateCartItem(1)">Update</button>
        <button onclick="removeFromCart(1)">Trash</button>
    </div>
</div>

</div>
<div id="catalog-list">
    <div class="row">
    <div class="item">
        <h4>Barang 1</h4>
        <h6>Harga : Rp. <span class="harga">10</span></h6>
        <input type="number" name="jumlah"> <br/>
        <button onclick="addToCart(1)">Add To Cart</button>
    </div>
    <div class="item">
        <h4>Barang 2</h4>
        <h6>Harga : Rp. <span class="harga">10</span></h6>
        <input type="number" name="jumlah"> <br/>
        <button onclick="addToCart(2)">Add To Cart</button>
    </div>
    <div class="item">
        <h4>Barang 3</h4>
        <h6>Harga : Rp. <span class="harga">10</span></h6>
        <input type="number" name="jumlah"> <br/>
        <button onclick="addToCart(2)">Add To Cart</button>
    </div>
    </div>
    <div class="row">
        <div class="item">
            <h4>Barang 4</h4>
            <h6>Harga : Rp. <span class="harga">10</span></h6>
            <input type="number" name="jumlah"> <br/>
            <button onclick="addToCart(1)">Add To Cart</button>
        </div>
        <div class="item">
            <h4>Barang 5</h4>
            <h6>Harga : Rp. <span class="harga">10</span></h6>
            <input type="number" name="jumlah"> <br/>
            <button onclick="addToCart(2)">Add To Cart</button>
        </div>
        <div class="item">
            <h4>Barang 6</h4>
            <h6>Harga : Rp. <span class="harga">10</span></h6>
            <input type="number" name="jumlah"> <br/>
            <button onclick="addToCart(2)">Add To Cart</button>
        </div>
        </div>
    </div>
    <script src="cart.js"></script>
</body>
</html>
