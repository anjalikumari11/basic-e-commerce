<div class="container">

  <!-- products -->
  <h3>Products</h3>
  <hr>
  <div class="row">
    <?php
    $db->select(PRODUCTS, "*");
    $result = $db->showResult();
    foreach ($result as $product) {

    ?>
      <div class="col-md-3 pb-3">
        <div class="card m-2" style="width: 16rem; height:420px">   
          <img src="./admin/images/<?= $product['Image']?>" class="card-img-top" alt="..." style="height:170px; object-fit:cover">
          <div class="card-body">
            <h5 class="card-title"><?= $product['name']?></h5>
            <p class="card-text" style="text-overflow: ellipsis; height:50px"><?= $product['description']?></p>
            <br>
            <strong class="">₹<?= $product['price']?></strong>
            <br>
            <br>
            <a href="productBuy.php?productId=<?= $product['pid']?>" class="btn btn-primary" style="margin-top:auto">Buy Now</a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>


  </div>
</div>