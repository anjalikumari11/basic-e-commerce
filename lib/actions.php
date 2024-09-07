<?php
require 'Database.php';
// require 'constants.php';
$db = new Database();

if (isset($_GET['query'])) {
    $request = addslashes($_GET['query']);

    //user- registration
    if ($request == 'submit') {
        $data = array(
            "name" => addslashes($_POST['name']),
            // "slug" => $db->slugMaker(addslashes($_POST['name'])),
            "email" => addslashes($_POST['email']),
            "contact" => addslashes($_POST['contact']),
            "address" => addslashes($_POST['address']),
            "password" => addslashes($_POST['password'])
        );
        $res = $db->insert(USER_TABLE, $data);
        if ($res) {
            header("location: ../user_login.php");
        } else {
            header("location: ../user_register.php?message=user add failed!&status=0&route=user_register.php");
        }
    }


    if ($request == 'loginUser') {
        session_start();
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);

        $res = $db->select(USER_TABLE, "*", null, "email = '$email' AND password = '$password'");
        $res = $db->showResult();
        // print_r($res);
        if ($res[0]['email'] == $email) {
            $_SESSION['email'] = $res[0]['email'];
            $_SESSION['name'] = $res[0]['name'];
            $_SESSION['user_id'] = $res[0]['user_id'];
            header('Location:../index.php');
        } else {
            header("location:../user_login.php?message=failed!&status=0&route=user_login.php");
        }
    }


    //logout
    if ($request == 'logoutUser') {
        session_start();
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        session_destroy();
        header('Location:../user_login.php');
    }

    if ($request == 'createOrder') {
        $data = array(
            "product_id" => addslashes($_POST['product_id']),
            "orderNote" => addslashes($_POST['orderNote']),
            "price" => addslashes($_POST['price']),
            "status" => 1,
        );
        $res = $db->insert(ORDERS, $data);
        if ($res) {
            header("location: ../thank-you.php");
        } else {
            header("location: ../index.php");
        }
    }
}
