<?php
include 'parts/header.php';
include 'parts/navbar.php';
$slug = addslashes($_GET['category']);
$db->select(CATEGORY_TABLE, "*", null, "slug='$slug'");
$category = $db->showResult();
$cid = $category[0]['cid'];
?>

<div class="container">
  <hr>
  <p>Home/Categories/<?= $category[0]['name'] ?></p>
  <hr>
  <div class="row mb-5">
    <?php
    $db->select(PRODUCTS, "*", null, "category=$cid");
    $result = $db->showResult();

    if (count($result) <= 0) {
    ?>
      <center>
        <h4>No Products in this category</h4>
      </center>
    <?php
    }

    foreach ($result as $product) {

    ?>
      <div class="col-md-3 pb-3">
        <div class="card m-2" style="width: 16rem; height:420px">
          <img src="./admin/images/<?= $product['Image'] ?>" class="card-img-top" alt="..." style="height:170px; object-fit:cover">
          <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <p class="card-text" style="text-overflow: ellipsis; height:50px"><?= $product['description'] ?></p>
            <br>
            <strong class="">₹<?= $product['price'] ?></strong>
            <br>
            <br> <a href="productBuy.php?productId=<?= $product['pid'] ?>" class="btn btn-primary" style="margin-top:auto">Buy Now</a>

          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<?php
include 'parts/footer.php';
include 'parts/bottompart.php';
?>