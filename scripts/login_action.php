<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die(header('location: ../404'));
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $thisuser = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $thispass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}
include '../includes/connect.php';

if (!isset($_SESSION)) {
session_start();
}

try {
    $sql = "SELECT * FROM users WHERE Username = :username";
    $result = $db->prepare($sql);
    $result->bindParam(":username", $thisuser);
    $result->execute();
    $num = $result->fetch(PDO::FETCH_ASSOC);
    $hash = $num['Password'];
    if (password_verify($thispass, $hash)) {
        if ($num > 1) {
            $_SESSION['userID'] = $num['userID'];
            $_SESSION['Username'] = $thisuser;
            $_SESSION['Email'] = $num['Email'];
            $_SESSION['Fullname'] = $num['Fullname'];
            $_SESSION['aLevel'] = $num['level'];
        }
        if ($num['level'] == '1') {
            header("location:../admin");
        }
        else {
            header("location:../index");
        }
    }
    else {
        header("location:../login?login_error=1");
        exit();
    }
}
catch (PDOException $e) {
    header("location: ../404");
exit();
}
