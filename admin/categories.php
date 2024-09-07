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
            Add Category
        </button>

        <!-- Modal -->
        <form action="lib/actions.php?query=addCategory" method="post">
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
                        <h4 class="card-title">Categories</h4>
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
                                    $db->select(CATEGORY_TABLE, '*', null, null, 'cid desc');
                                    $categories = $db->showResult();
                                    foreach ($categories  as $sno => $category) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $sno + 1 ?>
                                            </td>
                                            <td>
                                                <?= $category['name'] ?>
                                            </td>
                                            <td>
                                                <?= $category['created_at'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodel<?= $category['cid'] ?>">Edit</button>
                                            </td>
                                            <td>
                                                <a href="lib/actions.php?query=deleteCategory&id=<?= $category['cid'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <form action="lib/actions.php?query=updateCategory" method="post">
                                            <div class="modal fade" id="editmodel<?= $category['cid'] ?>" tabindex="-1" role="dialog" aria-labelledby="editmodel" aria-hidden="true">
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
                                                            <input type="hidden" name="cid" value="<?= $category['cid'] ?>">
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