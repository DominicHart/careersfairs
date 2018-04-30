<?php
include '../includes/session.php';
include '../includes/connect.php';

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die(header('location: ../404'));
}
try {
    if(isset($_POST['eventID']) && !empty($_POST['eventID'])) {
        foreach ($_POST as $field) {
            if (isset($field)) {
                $Type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $Title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $Day = filter_var($_POST['day'], FILTER_SANITIZE_STRING);
                $From = filter_var($_POST['timefrom'], FILTER_SANITIZE_STRING);
                $To = filter_var($_POST['timeto'], FILTER_SANITIZE_STRING);
                $Month = filter_var($_POST['month'], FILTER_SANITIZE_STRING);
                $Year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
                $Location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
                $Description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                $eventID = filter_var($_POST['eventID'], FILTER_SANITIZE_STRING);
            }
        }
        $Date = $Day . "/" . $Month . "/" . $Year;
        $Time = $From . " - " . $To;

        $stmt = $db->prepare("UPDATE event SET Type = :Type, Title = :Title, Date = :Date, Time = :Time, Location = :Location, Description = :Description WHERE eventID = :eventID");
        $stmt->execute(array(':Type' => $Type, ':Title' => $Title, ':Date' => $Date, ':Time' => $Time, ':Location' => $Location, ':Description' => $Description, ':eventID' => $eventID));
        if ($stmt == false) {
            echo '<script>alert("Your event was not updated");</script>';
            exit();
        } else {
            header('location:../events?action=updated');
        }
    }
    else if(isset($_POST['infoID']) && !empty($_POST['infoID'])) {
        foreach ($_POST as $field) {
            if (isset($field)) {
                $Type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $Title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $Day = filter_var($_POST['day'], FILTER_SANITIZE_STRING);
                $From = filter_var($_POST['timefrom'], FILTER_SANITIZE_STRING);
                $To = filter_var($_POST['timeto'], FILTER_SANITIZE_STRING);
                $Month = filter_var($_POST['month'], FILTER_SANITIZE_STRING);
                $Year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
                $Location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
                $Description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                $infoID = filter_var($_POST['infoID'], FILTER_SANITIZE_STRING);
            }
        }
        $Date = $Day . "/" . $Month . "/" . $Year;
        $Time = $From . " - " . $To;

        $stmt = $db->prepare("UPDATE information SET Type = :Type, Title = :Title, Date = :Date, Time = :Time, Location = :Location, Description = :Description WHERE infoID = :infoID");
        $stmt->execute(array(':Type' => $Type, ':Title' => $Title, ':Date' => $Date, ':Time' => $Time, ':Location' => $Location, ':Description' => $Description, ':infoID' => $infoID));
        if ($stmt == false) {
            echo '<script>alert("Your article was not updated");</script>';
            exit();
        } else {
            header('location:../information?action=updated');
        }
    }
}
catch(PDOException $e) {
    header('location: ../404');
    exit();
}