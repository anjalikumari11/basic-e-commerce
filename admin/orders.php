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
                        <h4 class="card-title">Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Sno.
                                    </th>

                                    <th>
                                        Note
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Price
                                    </th>

                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Update Status
                                        <!-- Isma kya karna ha tumko jb bhi koi list ma se kuch bhi select kara 
                                         automatic us order ka status change ho jana chaiya jo value option me ussa ok-->
                                    </th>
                                    <th>
                                        Delete
                                    </th>
                                </thead>
                                <?php
                                $db->select(ORDERS, '*', null, null, 'o_id desc');
                                $orders = $db->showResult();
                                foreach ($orders  as $sno => $order) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $sno + 1 ?>
                                        </td>
                                        <td>
                                            <?= $order['orderNote'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($order['status'] == 1) {
                                                echo "pending";
                                            }
                                            if ($order['status'] == 2) {
                                                echo "delivered";
                                            }
                                            if ($order['status'] == 3) {
                                                echo "Cancelled";
                                            }

                                            // waha mam waha  thankuuuu heheee isko sahi kar do or aab main website banao
                                            // or iss admin panel me login page lagana ha vo bhi lagao thik h fir se likh do kya kya krna h
                                            ?>

                                        </td>
                                        <td>
                                            <?= $order['price'] ?>
                                        </td>
                                        <td>
                                            <?= $order['date'] ?>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <select name="orderstatus" onchange="status_update(this.options[this.selectedIndex].value,'<?= $order['o_id'] ?>')">
                                                    <option value="1" <?= $order['status'] == 1 ?"selected":"" ?> >Pending</option>
                                                    <option value="2" <?= $order['status'] == 2 ?"selected":"" ?>>delivered</option>
                                                    <option value="3" <?= $order['status'] == 3 ?"selected":"" ?>>Cancelled</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="lib/actions.php?query=deleteOrder&id=<?= $order['o_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tbody>
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
<script type="text/javascript">
    function status_update(value, o_id) {
        //   alert(value);
        // dheko yaha per na jasa hi hum select se kuch select karta ha to ya status_update function chel jata 
        // ok hn to aab kya karna ha value change nhi ho rhi haa value change karna ke liya tumko action banana hoga
        //ki thi hanni hua action dikho kha banaya tha
        let url = "http://localhost/DineshMotors/admin/lib/actions.php";
        window.location.href = url + "?o_id=" + o_id + "&status=" + value+"&query=updateOrder";
    }
</script>