<?php
include '../includes/session.php';
include '../includes/connect.php';

try {
    if(isset($_GET['event']) && !empty($_GET['event'])) {
        $event = filter_var($_GET['event'], FILTER_SANITIZE_STRING);
        $result = $db->prepare("SELECT * FROM bookmark_event WHERE eventID = :eventID AND euserID = :euserID");
        $result->bindParam(':euserID', $thisuser, PDO::PARAM_STR);
        $result->bindParam(':eventID', $event, PDO::PARAM_STR);
        $result->execute();
        $rowCount = $result->fetch(PDO::FETCH_ASSOC);
        if ($rowCount > 1) {
            echo "<script>alert('Bookmark already exists');window.history.go(-1);</script>";
            exit();
        }
        else {
            $event = filter_var($_GET['event'], FILTER_SANITIZE_STRING);
            $stmt = $db->prepare("INSERT INTO bookmark_event(euserID, eventID) VALUES (:euserID, :eventID)");
            $stmt->bindParam(':euserID', $thisuser, PDO::PARAM_STR);
            $stmt->bindParam(':eventID', $event, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt == false) {
                echo '<script>alert("Your bookmark was not created");</script>';
                exit();
            }
            else {
                header('location: ../events?action=created');
            }
        }
    }
    else if(isset($_GET['article']) && !empty($_GET['article'])) {
        $info = filter_var($_GET['article'], FILTER_SANITIZE_STRING);
        $result = $db->prepare("SELECT * FROM bookmark_information WHERE infoID = :infoID AND userID = :userID");
        $result->bindParam(':userID', $thisuser, PDO::PARAM_STR);
        $result->bindParam(':infoID', $info, PDO::PARAM_STR);
        $result->execute();
        $rowCount = $result->fetch(PDO::FETCH_ASSOC);
        if ($rowCount > 1) {
            echo "<script>alert('Bookmark already exists');window.history.go(-1);</script>";
            exit();
        }
        else {
            $info = filter_var($_GET['article'], FILTER_SANITIZE_STRING);
            $stmt = $db->prepare("INSERT INTO bookmark_information(userID, infoID) VALUES (:userID, :infoID)");
            $stmt->bindParam(':userID', $thisuser, PDO::PARAM_STR);
            $stmt->bindParam(':infoID', $info, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt == false) {
                echo '<script>alert("Your bookmark was not created");</script>';
                exit();
            }
            else {
                header('location: ../information?action=created');
            }
        }
    }
}
catch(PDOException $e) {
    header('location: ../404');
    exit();
}
exit();