<?php
include 'parts/header.php';
include 'parts/sidebar.php';
?>
<div class="main-panel">
    <?php
    include 'parts/navbar.php';
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="lib/actions.php?query=addproducts" method="post">

                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" required class="form-control" name="name" id="productName" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" required class="form-control" id="description">Write Description here!</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" accept="image/png, image/jpeg" required class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputprice">Price</label>
                                <input type="text" class="form-control" id="exampleInputprice" name="price" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control" id="exampleFormControlSelect1" required name="category">

                                    <?php
                                    $db->select(CATEGORY_TABLE, "name,cid", null, null);
                                    $cat = $db->showResult();
                                    foreach ($cat as $c) {
                                    ?>
                                        <option value="<?= $c['cid'] ?>"><?= $c['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory">Sub Category</label>
                                <select class="form-control" id="subcategory" required name="subcategory">

                                    <?php
                                    $db->select(SUB_CATEGORY, "name,sno", null, null);
                                    $cat = $db->showResult();
                                    foreach ($cat as $c) {
                                    ?>
                                        <option value="<?= $c['sno'] ?>"><?= $c['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'parts/footer.php';
?>
</div>

<?php
include 'parts/scripts.php';
?>