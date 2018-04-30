<?php
include '../includes/session.php';
include '../includes/connect.php';

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /* choose the appropriate page to redirect users */
    die(header('location: ../404'));
}

try {
    if(isset($_POST['eventID']) && !empty($_POST['eventID'])) {
        $stmt = $db->prepare("DELETE FROM event WHERE eventID = :eventID");
        $stmt->execute(array(':eventID' => $_POST['eventID']));
        if ($stmt == false) {
            echo '<script>alert("The event was not deleted.");</script>';
        } else {
            header('location:../events?action=deleted');
        }
    }
    else if(isset($_POST['infoID']) && !empty($_POST['infoID'])) {
        $stmt = $db->prepare("DELETE FROM information WHERE infoID = :infoID");
        $stmt->execute(array(':infoID' => $_POST['infoID']));
        if($stmt == false) {
            echo '<script>alert("The article was not deleted.");</script>';
        }
        else
        {
            header('location:../information?action=deleted');
        }
    }
}
catch(PDOException $e) {
    header('location: ../404');
    exit();
}

exit();