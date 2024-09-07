<?php
include_once 'parts/header.php';
include_once 'parts/sidebar.php';
?>
<div class="main-panel">
    <?php
    include 'parts/navbar.php';
    ?>

    <div class="content">
        <a href="add-product.php" class="btn btn-primary">Add Product</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Sno.
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Sub Category
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>
                                        Edit
                                    </th>
                                    <th>
                                        Delete
                                    </th>
                                </thead>
                                <tbody>
                                    <?php
                                    $db->select(PRODUCTS, '*', null, null, 'pid desc');
                                    $productlist = $db->showResult();
                                    foreach ($productlist  as $sno => $singleproduct) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $sno + 1 ?>
                                            </td>
                                            <td>
                                                <?= $singleproduct['name'] ?>
                                            </td>
                                            <td>
                                                <img src="images/<?= $singleproduct['Image'] ?>" alt="<?= $singleproduct['name'] ?>" height="100" width="100" style="box-fit:cover;">
                                            </td>
                                            <td>
                                                <?php $cat_id = $singleproduct['category'];
                                                if ($cat_id != null) {
                                                    $db->select(CATEGORY_TABLE, "*", null, "cid = $cat_id");
                                                    $kuch = $db->showResult();
                                                    echo $kuch[0]['name'];
                                                }

                                                ?>
                                            </td>
                                            <td>

                                                <?php $subcat_id = $singleproduct['subcategory'];
                                                if ($subcat_id != null) {
                                                    try {
                                                        $db->select(SUB_CATEGORY, "*", null, "sno = $subcat_id");
                                                        $kuch = $db->showResult();
                                                        echo $kuch[0]['name'];
                                                    } catch (Exception $e) {
                                                    }
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                $<?= $singleproduct['price'] ?>
                                            </td>
                                            <td>
                                               <?= $singleproduct['created_at'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodel<?= $singleproduct['pid'] ?>">Edit</button>
                                            </td>
                                            <td>
                                                <a href="lib/actions.php?query=deleteproducts&id=<?= $singleproduct['pid'] ?>" class="btn btn-danger">Delete</a>

                                            </td>
                                        </tr>
                                        <form action="lib/actions.php?query=updateProduct" method="post" enctype="multipart/form-data">
                                            <div class="modal fade" id="editmodel<?= $singleproduct['pid'] ?>" tabindex="-1" role="dialog" aria-labelledby="editmodel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editmodel">Update</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputName">Name</label>
                                                                <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name" value="<?= $singleproduct['name'] ?>">
                                                            </div>
                                                            <input type="hidden" name="pid" value="<?= $singleproduct['pid'] ?>">
                                                            <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <div class="custom-file">
                                                                    <input type="file" accept="image/png, image/jpeg" required class="custom-file-input" name="image" id="image">
                                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label for="exampleInputprice">Price</label>
                                                                    <input type="text" class="form-control" id="exampleInputprice" name="price" placeholder="Enter price" value="<?= $singleproduct['price'] ?>">
                                                                </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Category</label>
                                                                <select class="form-control" id="exampleFormControlSelect1" name="category">

                                                                    <?php
                                                                    $db->select(CATEGORY_TABLE, "name,cid", null, null);
                                                                    $cat = $db->showResult();
                                                                    foreach ($cat as $c) {
                                                                    ?>
                                                                        <option value="<?= $c['cid'] ?>" <?= $c['cid'] == $singleproduct['category'] ? 'selected' : "" ?>><?= $c['name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Sub Category</label>
                                                                <select class="form-control" id="exampleFormControlSelect1" name="subcategory">

                                                                    <?php
                                                                    $db->select(SUB_CATEGORY, "name,sno", null, null);
                                                                    $cat = $db->showResult();
                                                                    foreach ($cat as $c) {
                                                                    ?>
                                                                        <option value="<?= $c['sno'] ?>" <?= $c['sno'] == $singleproduct['subcategory'] ? 'selected' : "" ?>><?= $c['name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
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