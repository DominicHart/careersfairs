<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /* choose the appropriate page to redirect users */
    die(header('location: ../404'));
}
include '../includes/session.php';

if (isset($_POST['eventRef'])) {
    $event = filter_var($_POST['eventRef'], FILTER_SANITIZE_STRING);
}
try {
    if (isset($_FILES['Image'])) {
        $file = $_FILES['Image'];

        //file properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        // find out file extension
        $file_extension = explode('.', $file_name);
        $file_extension = strtolower(end($file_extension));

        //set allowed file types array
        $allowed = array('png', 'jpg', 'jpeg', 'gif');

        //check file extension is valid
        if (in_array($file_extension, $allowed)) {
            //check file has no errors
            if ($file_error === 0) {
                //check file size is not too large
                if ($file_size <= 2097152) {
                    //generate unique file name
                    $file_name_new = uniqid('', true) . '.' . $file_extension;
                    //set file storage destination
                    $file_destination = '../images/maps/' . $file_name_new;
                    //move file to new location
                    move_uploaded_file($file_tmp, $file_destination);
                }
            }
        }
    }
    //echo $file_name_new . "<br>" . $event;
    include '../includes/connect.php';
    $stmt = $db->prepare("INSERT INTO event_maps (eventRef, image) VALUES (:eventRef, :image)");
    $stmt->execute(array(':eventRef' => $event, ':image' => $file_name_new));
    if ($stmt == false) {
        echo '<script>alert("The map was not added");</script>';
        exit();
    }
    else {
        header('location:../admin?action=mcreated');
    }
}
catch(PDOException $e) {
    header('location: ../404');
    exit();
}



