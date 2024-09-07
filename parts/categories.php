<div class="container">
  <hr>
  <h3>Categories</h3>
  <hr>
  <div class="row mb-5">
    <?php
    $db->select(CATEGORY_TABLE, "*");
    $res = $db->showResult();
    foreach ($res as $category) {
    ?>
      <div class="col-md-4 mb-3">
        <div class="card p-3 shadow text-decoration-none text-center">
          <a href="./product_item.php?category=<?= $category['slug']?>" class="text-decoration-none h-100 w-100 ">
           <?= $category['name']?>
          </a>
        </div>
        </a>
      </div>
    <?php
    }
    ?>


  </div>
</div>

