<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbconnect
 *
 * @author alex
 */
class dbconnect {

    private $conn;

    public function __construct() {
        //$this->conn = new mysqli("127.0.0.1", "c10wave7_root", "q12w23e3", "c10wave7_lomda");
        $this->conn = new mysqli("127.0.0.1", "root", "", "lomda");
        $this->conn->set_charset("utf8");
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __destruct() {
        
    }

    public function InsertCity($idcity, $city_name, $english_name, $semel_napa, $shem_napa, $semel_lishkat_mana, $lishka, $semel_moatza_ezorit, $shem_moaatza) {

        $city_name = mysqli_real_escape_string($this->conn, $city_name);
        $english_name = mysqli_real_escape_string($this->conn, $english_name);
        $lishka = mysqli_real_escape_string($this->conn, $lishka);
        $shem_moaatza = mysqli_real_escape_string($this->conn, $shem_moaatza);
        if ($this->conn->query("INSERT INTO `cities` (`idcity`, `city_name`, `english_name`, `semel_napa`, `shem_napa`, `semel_lishkat_mana`, `lishka`, `semel_moatza_ezorit`, `shem_moaatza`) VALUES ('$idcity', '$city_name', '$english_name', '$semel_napa', '$shem_napa', '$semel_lishkat_mana', '$lishka', '$semel_moatza_ezorit', '$shem_moaatza')")) {
            return TRUE;
        }
        return FALSE;
    }

    public function IsUserExist($email) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $result = $this->conn->query("SELECT * FROM users where email like '%$email%'");
        if ($result->num_rows > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function CheckLogin($email, $password) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);
        $result = $this->conn->query("SELECT * FROM users where email like '%$email%' and password like '%$password%'");
        if ($result->num_rows > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function ForgetPaaword($email, $date) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $result = $this->conn->query("SELECT * FROM users where email like '%$email%' and birthdate='$date'");
        if ($result->num_rows > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function GetUserDetails($email) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $result = $this->conn->query("SELECT * FROM users where email like '%$email%'");
        return $result->fetch_assoc();
    }

    public function InsertUser($email, $password, $firstname, $lastname, $idcity, $phone, $birthdate, $iduserType) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);
        $firstname = mysqli_real_escape_string($this->conn, $firstname);
        $lastname = mysqli_real_escape_string($this->conn, $lastname);
        $this->conn->query("INSERT INTO `users` (`registerdate`, `email`, `password`, `firstname`, `lastname`, `idcity`, `phone`, `birthdate`, `iduserType`) VALUES (date(now()), '$email', '$password', '$firstname', '$lastname', '$idcity', '$phone', '$birthdate', '$iduserType')");
        return $this->conn->insert_id;
    }

    public function InsertUserType($userType) {
        $userType = mysqli_real_escape_string($this->conn, $userType);
        $this->conn->query("INSERT INTO `usertype` (`userType_name`) VALUES ('$userType')");
        return $this->conn->insert_id;
    }

    public function InsertQuestionType($questionType) {
        $userType = mysqli_real_escape_string($this->conn, $questionType);
        $this->conn->query("INSERT INTO `questiontype` (`questionType_name`) VALUES ('$questionType')");
        return $this->conn->insert_id;
    }

    public function InsertApproveType($approve_name) {
        $userType = mysqli_real_escape_string($this->conn, $approve_name);
        $this->conn->query("INSERT INTO `approvetype` (`approve_name`) VALUES ('$approve_name');");
        return $this->conn->insert_id;
    }

    public function InsertSubjectQuestions($Subject_name) {
        $userType = mysqli_real_escape_string($this->conn, $Subject_name);
        $this->conn->query("INSERT INTO `subjectquestions` (`Subject_name`) VALUES ('$Subject_name')");
        return $this->conn->insert_id;
    }

    public function InsertQuestion($idQuestionType, $idSubjectQuestion, $Question, $QuestionImage, $Answer1, $AnswerImage1, $Answer2, $AnswerImage2, $Answer3, $AnswerImage3, $Answer4, $AnswerImage4, $CorrectAnswer, $explanation, $startdate, $enddate) {
        $Question = mysqli_real_escape_string($this->conn, $Question);
        $Answer1 = mysqli_real_escape_string($this->conn, $Answer1);
        $Answer2 = mysqli_real_escape_string($this->conn, $Answer2);
        $Answer3 = mysqli_real_escape_string($this->conn, $Answer3);
        $Answer4 = mysqli_real_escape_string($this->conn, $Answer4);
        $explanation = mysqli_real_escape_string($this->conn, $explanation);
        $this->conn->query("INSERT INTO `Questions` (`idQuestionType`, `idSubjectQuestion`, `Question`, `QuestionImage`, `Answer1`, `AnswerImage1`, `Answer2`, `AnswerImage2`, `Answer3`, `AnswerImage3`, `Answer4`, `AnswerImage4`, `CorrectAnswer`, `explanation`, `startdate`, `enddate`) VALUES ('$idQuestionType', '$idSubjectQuestion', '$Question', '$QuestionImage', '$Answer1', '$AnswerImage1', '$Answer2', '$AnswerImage2', '$Answer3', '$AnswerImage3', '$Answer4', '$AnswerImage4', '$CorrectAnswer', '$explanation', '$startdate', '$enddate')");
        return $this->conn->insert_id;
    }

    public function InsertAdvertisement($iduser, $idcity, $idSubjectQuestion, $phone, $website, $image, $slogen, $businessName, $shortSlogen, $startdate, $enddate, $approveType) {
        $slogen = mysqli_real_escape_string($this->conn, $slogen);
        $businessName = mysqli_real_escape_string($this->conn, $businessName);
        $shortSlogen = mysqli_real_escape_string($this->conn, $shortSlogen);
        echo "INSERT INTO `advertisements` (`iduser`, `idcity`, `idSubjectQuestion`, `phone`, `website`, `image`, `slogen`, `businessName`, `shortSlogen`, `startdate`, `enddate`, `idapproveType`) VALUES ('$iduser', '$idcity', '$idSubjectQuestion', '$phone', '$website', '$image', '$slogen', '$businessName', '$shortSlogen', '$startdate', '$enddate', '$approveType')";
        exit;
        $this->conn->query("INSERT INTO `advertisements` (`iduser`, `idcity`, `idSubjectQuestion`, `phone`, `website`, `image`, `slogen`, `businessName`, `shortSlogen`, `startdate`, `enddate`, `idapproveType`) VALUES ('$iduser', '$idcity', '$idSubjectQuestion', '$phone', '$website', '$image', '$slogen', '$businessName', '$shortSlogen', '$startdate', '$enddate', '$approveType')");
        return $this->conn->insert_id;
    }
    public function InsertAdvertismentInfo($iduser,$businessName, $firstName, $lastName, $website, $phone,$businessEmail,$QuestionImage) {
        $businessName = mysqli_real_escape_string($this->conn, $businessName);
        $firstName = mysqli_real_escape_string($this->conn, $firstName);
        $lastName = mysqli_real_escape_string($this->conn, $lastName);
        $website = mysqli_real_escape_string($this->conn, $website);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $businessEmail = mysqli_real_escape_string($this->conn, $businessEmail);
        //$uploaded_on = new Datetime();
        $sql = "INSERT INTO advertisements (iduser,businessName, firstName, lastName, website, phone, businessEmail,file_name) VALUES ('$iduser', '$businessName', '$firstName', '$lastName', '$website', '$phone', '$businessEmail','$QuestionImage')";
        //echo $sql;
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }
    public function updateAdvertismentInfo($idAdvertisement,$businessName, $firstName, $lastName, $website, $phone,$businessEmail,$QuestionImage) {
        $businessName = mysqli_real_escape_string($this->conn, $businessName);
        $firstName = mysqli_real_escape_string($this->conn, $firstName);
        $lastName = mysqli_real_escape_string($this->conn, $lastName);
        $website = mysqli_real_escape_string($this->conn, $website);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $businessEmail = mysqli_real_escape_string($this->conn, $businessEmail);
        $sql = "UPDATE `advertisements` SET  `firstName` = '$firstName', `lastName` = '$lastName', `phone` = '$phone', `website` = '$website', `businessName` = '$businessName', `file_name` = '$QuestionImage' WHERE `advertisements`.`idAdvertisement` = $idAdvertisement";
        //update return true/false
        return $this->conn->query($sql);
    }
    public function isAdExixt($iduser){
        $sql = "SELECT * FROM advertisements where `iduser` = $iduser";
        //echo $sql;
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return TRUE;
        }
        return FALSE;
    }
    public function getAdExixst($iduser){
        $sql = "SELECT * FROM advertisements where `iduser` = $iduser";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();//return array of the result
    }
    

    public function GetAllusers() {
        return $this->conn->query("SELECT * FROM users,cities,usertype where users.idcity=cities.idcity and users.iduserType=usertype.iduserType");
    }

    public function GetAllusersByIdUserType($id) {
        return $this->conn->query("SELECT * FROM users,cities,usertype where users.idcity=cities.idcity and users.iduserType=usertype.iduserType and usertype.iduserType=$id");
    }

    public function GetAllSubjectQuestions() {
        return $this->conn->query("SELECT * FROM subjectquestions");
    }

    public function GetAllQuestionType() {
        return $this->conn->query("SELECT * FROM questiontype");
    }

    public function GetAllQuestionsBySubjectId($id) {
        return $this->conn->query("SELECT * FROM questiontype,questions where questiontype.idQuestionType=questions.idQuestionType and idSubjectQuestion=$id");
    }

    public function GetAllQuestionsByQuestionTypeId($id) {
        return $this->conn->query("SELECT * FROM questiontype,questions where questiontype.idQuestionType=questions.idQuestionType and questiontype.idQuestionType=$id");
    }

    public function GetSubjectQuestionsById($id) {
        $result = $this->conn->query("SELECT * FROM subjectquestions where idSubjectQuestion=$id");
        return $result->fetch_assoc();
    }

    public function GetAlluserTypes() {
        return $this->conn->query("SELECT * FROM usertype");
    }

    public function GetAllapproveTypes() {
        return $this->conn->query("SELECT * FROM approvetype;");
    }

    public function GetAllCities() {
        return $this->conn->query("SELECT * FROM cities order by city_name");
    }
    
    public function GetCityByID($id) {
        $result = $this->conn->query("SELECT * FROM cities where idcity=$id");
        return $result->fetch_assoc();
    }
    
    public function GetAllAdvertisements() {
        return $this->conn->query("SELECT * FROM users,advertisements,approvetype,subjectquestions where users.iduser=advertisements.iduser and subjectquestions.idSubjectQuestion=advertisements.idSubjectQuestion and approvetype.idapproveType=advertisements.idapproveType");
    }

    public function GetAllAdvertisementsByCity($idcity) {
        return $this->conn->query("SELECT * FROM advertisements where (idcity=$idcity or idcity=0) and (idapproveType=2 or idapproveType=3) order by rand() limit 5");
    }
    public function GetAllAdvertisementsLimit($limit) {
        return $this->conn->query("SELECT * FROM advertisements where (idapproveType=2 or idapproveType=3) order by rand() limit $limit");
    }

    public function GetQuestionsBySubjectQuestionsId($id) {
        return $this->conn->query("SELECT * FROM subjectquestions,questions where subjectquestions.idSubjectQuestion=questions.idSubjectQuestion and questions.idSubjectQuestion=$id");
    }

    public function GetQuestionsBySubjectQuestionsIdAndQnty($id, $qty) {
        return $this->conn->query("SELECT * FROM subjectquestions,questions where subjectquestions.idSubjectQuestion=questions.idSubjectQuestion and questions.idSubjectQuestion=$id order by rand() limit $qty");
    }

    public function GetQuestionById($id) {
        $result = $this->conn->query("SELECT * FROM questions where idQuestion=$id");
        return $result->fetch_assoc();
    }

    public function Redirect($url) {
        header("Location: $url");
    }

}
