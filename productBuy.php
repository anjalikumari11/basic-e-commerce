<?php
include 'parts/header.php';
include 'parts/navbar.php';
$product_id = addslashes($_GET['productId']);
$db->select(PRODUCTS, "*", null, "pid=$product_id");
$product = $db->showResult();
$product = $product[0];

?>

<div class="container">
    <!-- products -->
    <hr>
    <p>Home/Products/<?= $product['name'] ?></p>
    <hr>
    <div class="container">
        <img src="./admin/images/<?= $product['Image'] ?>" class="image" style="width:100%; height:300px; object-fit:contain">
    </div>
    <div>
        <h3 class="text-center mt-2"><?= $product['name'] ?></h3>
        <h4 class="text-center mt-2">₹<?= $product['price'] ?></h4>
        <p class="text-center mt-2"><?= $product['description'] ?></p>
        <br>
    </div>
    <div>
        <form action="./lib/actions.php?query=createOrder" class="d-flex justify-content-center align-items-center flex-column" method="POST">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <input type="hidden" name="price" value="<?= $product['price'] ?>">
            <input type="text" class="form-control mb-3" name="orderNote" id="note" placeholder="Enter some delivery note..." style="width: 220px;">
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top:auto; display:flex; justify-content:center;">Checkout</button>

            <!-- iss form ko submit karao or orders wali table me save karan ha data??????? rukoo kr rhi hu 
        </form>
    </div>

</div>
<?php
include 'parts/footer.php';
include 'parts/bottompart.php';
?>