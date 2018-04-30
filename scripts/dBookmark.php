<?php

include "../includes/session.php";
include "../includes/connect.php";

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /* choose the appropriate page to redirect users */
    die(header('location: ../404'));
}

try {
    if(isset($_POST['event']) && !empty($_POST['event'])) {
        $event = filter_var($_POST['event'], FILTER_SANITIZE_STRING);
        $stmt = $db->prepare("DELETE FROM bookmark_event WHERE eventID = :eventID AND euserID = :euserID");
        $stmt->execute(array(':eventID' => $event, ':euserID' => $thisuser));
        if($stmt == false) {
            echo "<script>alert('Bookmark not deleted');window.history.go(-1);</script>";
            exit();
        }
        else
        {
            header('location: ../bookmarks?action=edeleted');
            exit();
        }
    }
    else if(isset($_POST['info']) && !empty($_POST['info'])) {
        $info = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
        $stmt = $db->prepare("DELETE FROM bookmark_information WHERE infoID = :infoID AND userID = :userID");
        $stmt->execute(array(':infoID' => $info, ':userID' => $thisuser));
        if($stmt == false) {
            echo "<script>alert('Bookmark not deleted');window.history.go(-1);</script>";
            exit();
        }
        else
        {
            header('location: ../bookmarks?action=ideleted');
            exit();
        }
    }
}
catch(PDOException $e) {
    echo "Error";
}