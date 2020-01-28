<?php
$notShowUserType = array(1, 3);
include_once './DB/dbconnect.php';
$db = new dbconnect();
$error = "";

$userName = $_POST['email-register'];
$password = $_POST['password-register'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone-register'];
$idCity = $_POST['idcity-register'];
$idUserType = $_POST['iduserType'];

    if ($db->IsUserExist($userName)) {
        $error = 'אימייל קיים במערכת';
        echo  "אימייל קיים במערכת";
    }
    $phone = str_replace("-", "", $phone);
    if (!is_numeric($phone)) {
        echo  "מספר טלפון לא חוקי";
    }
    if (empty($error)) {
        $result = $db->InsertUser($userName, $password, $firstName, $lastName,$idCity, $phone, '', $idUserType);
        if ($result < 1) {
            echo "משתמש לא התווסף";
        } else {
            session_start();
            $_SESSION['iduser'] = $result;
            $_SESSION['fullname'] = $firstName . ' ' . $lastName;
            $_SESSION['iduserType'] = $idUserType;
            // echo "<script type='text/javascript'> $(window).load(function(){ $('#system-login').modal('show'); }); </script>";
            // $db->Redirect("/");
            echo "משתמש  התווסף";
        }
    }
?>