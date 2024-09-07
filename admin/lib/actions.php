<?php
require 'Database.php';
$db = new Database();
if (isset($_GET['query'])) {
    $request = addslashes($_GET['query']);
    //add category
    if ($request == 'addCategory') {
        $data = array(
            "name" => addslashes($_POST['name']),
            "slug" => $db->slugMaker(addslashes($_POST['name']))
        );
        $res = $db->insert(CATEGORY_TABLE, $data);
        if ($res) {
            header("location: ../categories.php?message=Category added successfully!&status=1&route=categories.php");
        } else {
            header("location: ../categories.php?message=Category add failed!&status=0&route=categories.php");
        }
    }
    //update category
    if ($request == 'updateCategory') {
        $data = array(
            "name" => addslashes($_POST['name']),
            "slug" => $db->slugMaker(addslashes($_POST['name']))
        );
        $cid = addslashes($_POST['cid']);
        $res = $db->update(CATEGORY_TABLE, $data, "cid = $cid");
        if ($res) {
            header("location: ../categories.php?message=Category updated successfully!&status=1&route=categories.php");
        } else {
            header("location: ../categories.php?message=Category Update failed!&status=0&route=categories.php");
        }
    }
    //deleteCategory
    if ($request == 'deleteCategory') {
        $cid = addslashes($_GET['id']);
        $res = $db->delete(CATEGORY_TABLE, "cid = $cid");
        if ($res) {
            header("location: ../categories.php?message=Category deleted successfully!&status=1&route=categories.php");
        } else {
            header("location: ../categories.php?message=Category delete failed!&status=0&route=categories.php");
        }
    }

    //Add sub-category
    if ($request == 'addSubCategory') {
        $data = array(
            "name" => addslashes($_POST['name']),
            "slug" => $db->slugMaker(addslashes($_POST['name'])),
            "category" => addslashes($_POST['category'])
        );
        $res = $db->insert(SUB_CATEGORY, $data);
        if ($res) {
            header("location: ../sub-category.php?message=Sub Category added successfully!&status=1&route=sub-category.php");
        } else {
            header("location: ../sub-category.php?message=Sub Category add failed!&status=0&route=sub-category.php");
        }
    }

    if ($request == 'deleteSubCategory') {
        $sno = addslashes($_GET['id']);
        $res = $db->delete(SUB_CATEGORY, "sno = $sno");
        if ($res) {
            header("location: ../sub-category.php?message=sub Category deleted successfully!&status=1&route=sub-category.php");
        } else {
            header("location: ../sub-category.php?message=sub Category delete failed!&status=0&route=sub-category.php");
        }
    }

    if ($request == 'updateSubCategory') {
        $data = array(
            "name" => addslashes($_POST['name']),
            "slug" => $db->slugMaker(addslashes($_POST['name'])),
            "category" => addslashes($_POST['category']),

        );
        $sno = addslashes($_POST['sno']);
        $res = $db->update(SUB_CATEGORY, $data, "sno = $sno");
        if ($res) {
            header("location: ../sub-category.php?message=Sub Category updated successfully!&status=1&route=sub-category.php");
        } else {
            header("location: ../sub-category.php?message=Sub Category Update failed!&status=0&route=sub-category.php");
        }
    }


    //Add products
    if ($request == 'addproducts') {
        $file_name = time() . $_FILES['image']['name'];
        $uploadpath = "../images/" . $file_name;
        $data = array(
            "name" => addslashes($_POST['name']),
            "price" => addslashes($_POST['price']),
            "slug" => $db->slugMaker(addslashes($_POST['name'])),
            "description" => addslashes($_POST['description']),
            "image" => $file_name,
            "category" => addslashes($_POST['category']),
            "subcategory" => addslashes($_POST['subcategory'])

        );
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath)) {
            $res = $db->insert(PRODUCTS, $data);
            if ($res) {
                header("location: ../products.php?message=product added successfully!&status=1&route=products.php");
            } else {
                header("location: ../products.php?message=product add failed!&status=0&route=products.php");
            }
        } else {
            header("location: ../products.php?message=product add failed!&status=0&route=products.php");
        }
    }

    //update products
    if ($request == 'updateProduct') {
        $file_name = time() . $_FILES['image']['name'];
        $uploadpath = "../images/" . $file_name;
        $data = array(
            "name" => addslashes($_POST['name']),
            "price" => addslashes($_POST['price']),
            "image" => $file_name,
            "category" => addslashes($_POST['category']),
            "subcategory" => addslashes($_POST['subcategory'])
        );

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath)) {
            $pid = addslashes($_POST['pid']);
            $res = $db->update(PRODUCTS, $data, "pid = $pid");
            if ($res) {
                header("location: ../products.php?message=product update successfully!&status=1&route=products.php");
            } else {
                header("location: ../products.php?message=product update failed!&status=0&route=products.php");
            }
        } else {
            header("location: ../products.php?message=product add failed!&status=0&route=products.php");
        }
    }

    //delete product
    if ($request == 'deleteproducts') {
        $pid = addslashes($_GET['id']);
        $res = $db->delete(PRODUCTS, "pid = $pid");
        if ($res) {
            header("location: ../products.php?message=product delete successfully!&status=1&route=products.php");
        } else {
            header("location: ../products.php?message=product delete failed!&status=0&route=products.php");
        }
    }

    //delete order
    if ($request == 'deleteOrder') {
        $order_id = addslashes($_GET['id']);
        $res = $db->delete(ORDERS, "o_id = $order_id");
        if ($res) {
            header("location: ../orders.php?message=Order delete successfully!&status=1&route=orders.php");
        } else {
            header("location: ../orders.php?message=Order delete failed!&status=0&route=orders.php");
        }
    }

    //change status from selection status in order
    if (isset($_GET['o_id']) && isset($_GET['status'])) {
        $o_id = $_GET['o_id'];
        $data = array(
            "status" => addslashes($_GET['status']),
        );
        $res = $db->update(ORDERS, $data, "o_id = $o_id");
        if ($res) {
            header("location: ../orders.php?message=Order Status Updated!&status=1&route=orders.php");
        } else {
            header("location: ../orders.php?message=Order update failed!&status=0&route=orders.php");
        }
    }

    // if ($request == 'submit') {
    //     session_start();
    //     $data = array(
    //         "email" => addslashes($_POST['email']),
    //         "password" => addslashes($_POST['password']),

    //     );
    //     $res = $db->select(REGISTER, $data,);
    //     if ($res) {
    //         $_SESSION['email']=$user->email;
    //         $_SESSION['password']=$user->password;


    //         header('Location:index.php');
    //         header("location: ../index.php?message=Category added successfully!&status=1&route=categories.php");
    //     } else {
    //         header("location: ../categories.php?message=Category add failed!&status=0&route=categories.php");
    //     }
    // }

    //Admin login
    if (isset($_POST['loginbtn'])) {
        session_start();
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);

        $res = $db->select(REGISTER,"*",null,"email = '$email' AND password = '$password'");
        $res =$db->showResult();
        // print_r($res);

        if($res[0]['email']==$email)
         {
            $_SESSION['email'] =$res[0]['email'];
            $_SESSION['sno'] =$res[0]['sno'];

            header('Location:../index.php');
        } else {
            header("location: ../login.php?message=failed!&status=0&route=login.php");
        }
    }

    //logout
    if(isset($_GET['logoutbtn'])){
        session_start();
        unset($_SESSION['email']);
        unset($_SESSION['sno']);
        session_destroy();
        header('Location:../login.php');
    }


}
