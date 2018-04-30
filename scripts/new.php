<?php
include '../includes/session.php';
include '../includes/connect.php';

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die(header('location: ../404'));
}
try {
    if(isset($_POST['submit-event']) && (!isset($_POST['submit-info']))) {
        foreach ($_POST as $field) {
            if (isset($field)) {
                $Type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $Title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $Day = filter_var($_POST['day'], FILTER_SANITIZE_STRING);
                if ($Day < 10) {
                    $append = "0";
                    $Day = $append .= $Day;
                }
                $From = filter_var($_POST['timefrom'], FILTER_SANITIZE_STRING);
                $To = filter_var($_POST['timeto'], FILTER_SANITIZE_STRING);
                $Month = filter_var($_POST['month'], FILTER_SANITIZE_STRING);
                $Year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
                $Location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
                $Description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            }
        }
        $Date = $Day . "/" . $Month . "/" . $Year;
        $Time = $From . " - " . $To;

        $stmt = $db->prepare("INSERT INTO event (Type, Title, Date, Time, Location, Description) VALUES (:Type, :Title, :Date, :Time, :Location, :Description)");
        $stmt->execute(array(':Type' => $Type, ':Title' => $Title, ':Date' => $Date, ':Time' => $Time, ':Location' => $Location, ':Description' => $Description));
        if ($stmt == false) {
            echo '<script>alert("Your event was not created");</script>';
            exit();
        } else {
            header('location:../admin?action=ecreated');
        }
    }
    else if(isset($_POST['submit-info']) && (!isset($_POST['submit-event']))) {
        foreach($_POST as $field) {
            if (isset($field)) {
                $Type = filter_var($_POST['type2'], FILTER_SANITIZE_STRING);
                $Title = filter_var($_POST['title2'], FILTER_SANITIZE_STRING);
                $Day = filter_var($_POST['day2'], FILTER_SANITIZE_STRING);
                if ($Day < 10) {
                    $append = "0";
                    $Day = $append .= $Day;
                }
                $From = filter_var($_POST['timefrom2'], FILTER_SANITIZE_STRING);
                $To = filter_var($_POST['timeto2'], FILTER_SANITIZE_STRING);
                $Month = filter_var($_POST['month2'], FILTER_SANITIZE_STRING);
                $Year = filter_var($_POST['year2'], FILTER_SANITIZE_STRING);
                $Location = filter_var($_POST['location2'], FILTER_SANITIZE_STRING);
                $Description = filter_var($_POST['description2'], FILTER_SANITIZE_STRING);
            }
        }
        $Date = $Day . "/" . $Month . "/" . $Year;
        $Time = $From . " - " . $To;
        $stmt = $db->prepare("INSERT INTO information (Type, Title, Date, Time, Location, Description) VALUES (:Type, :Title, :Date, :Time, :Location, :Description)");
        $stmt->execute(array(':Type' => $Type, ':Title' => $Title, ':Date' => $Date, ':Time' => $Time, ':Location' => $Location, ':Description' => $Description));
        if($stmt == false) {
            echo '<script>alert("Your article was not created");</script>';
            exit();
        }
        else
        {
            header('location:../admin?action=icreated');
        }
    }
}
catch(PDOException $e) {
    header("location: ../404");
    exit();
}
exit();