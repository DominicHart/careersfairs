<?php

include '../includes/session.php';

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /* choose the appropriate page to redirect users */
    die(header('location: ../404'));
}

if(isset($_POST['1']) && isset($_POST['2']) && isset($_POST['3'])  && isset($_POST['eventref'])) {
    $whatdidyouthink  = filter_var($_POST['1'], FILTER_SANITIZE_STRING);
    $whichemployers  = filter_var($_POST['2'], FILTER_SANITIZE_STRING);
    $whowould  = filter_var($_POST['3'], FILTER_SANITIZE_STRING);
    $eventref = filter_var($_POST['eventref'], FILTER_SANITIZE_STRING);
}

include '../includes/connect.php';

try {
    $sql = "INSERT INTO feedback(userID, eventID, whatdidyouthink, whichemployers, whowould) VALUES (:userID, :eventID, :whatdidyouthink, :whichemployers, :whowould)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userID', $thisuser, PDO::PARAM_STR);
    $stmt->bindParam(':eventID', $eventref, PDO::PARAM_STR);
    $stmt->bindParam(':whatdidyouthink', $whatdidyouthink, PDO::PARAM_STR);
    $stmt->bindParam(':whichemployers', $whichemployers, PDO::PARAM_STR);
    $stmt->bindParam(':whowould', $whowould, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt == false) {
        echo '<a href="../feedback.php">Please try again.</a>';
    }
    else
    {
        header('location:../index');
    }
}
catch(PDOException $e) {
    //header("location: ../404");
    echo "Error !: " . $e->getMessage() . "<br>";
    exit();
}

exit();
