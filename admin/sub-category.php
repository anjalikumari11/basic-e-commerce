<?php

include 'parts/header.php';
include 'parts/sidebar.php';
?>
<div class="main-panel">
    <?php
    include 'parts/navbar.php';
    ?>
    <!-- End Navbar -->

    <div class="content">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Sub Category
        </button>

        <!-- Modal -->
        <form action="lib/actions.php?query=addSubCategory" method="post">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="category">

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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sub Categories</h4>
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
                                        Category
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
                                    $db = new Database();
                                    $db->select(SUB_CATEGORY, '*', null, null, 'sno desc');
                                    $subcategories = $db->showResult();
                                    foreach ($subcategories  as $sno => $category) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $sno + 1 ?>
                                            </td>
                                            <td>
                                                <?= $category['name'] ?>
                                            </td>
                                            <td>
                                                <?php $cat_id = $category['category'];
                                                $db->select(CATEGORY_TABLE,"*",null,"cid = $cat_id");
                                                $kuch = $db->showResult();
                                                echo $kuch[0]['name'];
                                                ?>
                                            </td>
                                            <td>
                                                <?= $category['created_at'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodel<?= $category['sno'] ?>">Edit</button>
                                            </td>
                                            <td>
                                                <a href="lib/actions.php?query=deleteSubCategory&id=<?= $category['sno'] ?>" class="btn btn-danger">Delete</a>

                                            </td>
                                        </tr>
                                        <form action="lib/actions.php?query=updateSubCategory" method="post">
                                            <div class="modal fade" id="editmodel<?= $category['sno'] ?>" tabindex="-1" role="dialog" aria-labelledby="editmodel" aria-hidden="true">
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
                                                                <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name" value="<?= $category['name'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Category</label>
                                                                <select class="form-control" id="exampleFormControlSelect1" name="category">

                                                                    <?php
                                                                    $db->select(CATEGORY_TABLE, "name,cid", null, null);
                                                                    $cat = $db->showResult();
                                                                    foreach ($cat as $c) {
                                                                    ?>
                                                                        <option value="<?= $c['cid'] ?>" <?= $c['cid']==$category['category']?'selected':""?>><?= $c['name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="sno" value="<?= $category['sno'] ?>">
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