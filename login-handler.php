<?php

// session_start();
// session_destroy();
include_once './DB/dbconnect.php';
$db = new dbconnect();
//handle random user
if (isset($_GET['iduser']) && $_GET['iduser'] == 0) {
session_start();
$_SESSION['iduser'] = 0;
$_SESSION['idcity'] = 0;
$_SESSION['iduserType'] = 3;// 2 its RANDOM USER
$db->Redirect("subjects.php");
}


$userName = $_POST['email-login'];
$password = $_POST['password-login'];
if ($db->CheckLogin($userName, $password)) {

    $result = $db->GetUserDetails($userName);
    session_start();
    $_SESSION['iduser'] = $result['iduser'];
    $_SESSION['fullname'] = $result['firstname'] . " " . $result['lastname'];
    $_SESSION['iduserType'] = $result['iduserType'];
    $_SESSION['idcity'] = $result['idcity'];
    $_SESSION['email'] = $result['email'];

    //$_SESSION['idAdvertisement']= $result['idAdvertisement'];
    switch ($result['iduserType']) {
        case 1:
            echo 'admin';
            break;
        case 2://casual user login
            echo 'user';
            break;
            case 4://advertiser login
            echo 'advertiser';
            break;
        default:
            break;
    }
} else {
    echo "שם משתמש או סיסמא אינם תקינים";
    }
?>