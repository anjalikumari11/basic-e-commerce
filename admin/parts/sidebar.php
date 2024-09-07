<?php
$curpage =basename($_SERVER["SCRIPT_FILENAME"], '.php')
?>
<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="./" class="simple-text logo-normal">
            Dinesh Motors
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="<?= $curpage=='index'?'active':''?>">
                <a href="./">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="<?= $curpage=='categories'?'active':''?>">
                <a href="./categories.php">
                    <i class="nc-icon nc-diamond"></i>
                     <p>Categories</p>
                </a>
            </li>
            <li class="<?= $curpage=='sub-category'?'active':''?>">
                <a href="./sub-category.php">
                    <i class="nc-icon nc-bullet-list-67"></i>
                     <p>Sub Category</p>
                </a>
            </li>
            <li class="<?= $curpage=='products'?'active':''?>">
                <a href="./products.php">
                    <i class="nc-icon nc-bullet-list-67"></i>
                     <p>Products</p>
                </a>
            </li>
            <li class="<?= $curpage=='orders'?'active':''?>">
                <a href="./orders.php">
                    <i class="nc-icon nc-bullet-list-67"></i>
                     <p>Orders</p>
                </a>
            </li>
        </ul>
    </div>
</div>