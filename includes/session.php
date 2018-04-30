<?php
session_start();

//define variables
if (isset($_SESSION['userID']))
{
    $username = $_SESSION['Email'];
    $thisuser = $_SESSION['userID'];
    $fullname = $_SESSION['Fullname'];
    $aLevel = $_SESSION['aLevel'];
}
