<?php
include "../includes/connect.php";

$users = array();
$bookmarks = array();
$events = array();
$result = $db->query("SELECT euserID, GROUP_CONCAT(eventID SEPARATOR ', ') events FROM bookmark_event GROUP BY euserID");
$result->execute();
while ($row = $result->fetch()) {
    $bookmarks[] = array('ID' => $row['euserID']);
}
foreach ($bookmarks as $bookmark):
    array_push($users, $bookmark['ID']);
endforeach;
$address = count($users);
foreach ($users as $user):
    $getname = $db->prepare("SELECT Fullname, Email FROM users WHERE userID = :userID");
    $getname->execute(array(':userID' => $user));
    $message = "";
    while ($row = $getname->fetch()) {
        $student = $row['Email'];
        $message .= "Hello " . $row['Fullname'] . ",\r\n\r\n";
    }
    $subject = "You have upcoming events";
    $message .= "Your bookmarked event/s:\r\n";
    $getevents = $db->prepare("SELECT * FROM bookmark_event JOIN event ON bookmark_event.eventID = event.eventID WHERE bookmark_event.euserID = :userID");
    $getevents->execute(array(':userID' => $user));
    while ($row = $getevents->fetch()) {
        $message .=  $row['Title'] . ", (" . $row['Location'] . ") on: " . $row['Date'] . ", between " . $row['Time'] . ".\r\n";
    }
    $message .= "\r\n*These e-mails are automatic, please do not reply.*\r\n";
    $message .= "\r\nNTU Careers Fairs\r\nEmployability Team\r\nemployability@ntu.ac.uk\r\n0115 848 8638\r\n\r\nNottingham Trent University\r\nBurton Street\r\nNottingham\r\nNG1 4BU";
    mail($student, $subject, $message);
endforeach;
header("location: ../admin?action=pushed");
exit();