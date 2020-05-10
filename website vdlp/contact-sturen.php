<?php
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";    
$password = "student";  
if(isset($_POST["ACTION"]) && $_POST["ACTION"] === "AddTodo")
{
    
    if(!empty($_POST["naam"])) {
        $naam = filter_var($_POST["naam"],FILTER_SANITIZE_STRING);
        if($naam === false) {
            array_push($errors, "incorrect naam");
            $naam = $_POST["naam"];
        }
    } else {
        array_push($errors, "naam can not be empty");
    }
    if(!empty($_POST["anaam"])) {
        $anaam = filter_var($_POST["anaam"],FILTER_SANITIZE_STRING);
        if($anaam === false) {
            array_push($errors, "incorrect anaam");
            $anaam = $_POST["anaam"];
        }
    } else {
        array_push($errors, "anaam can not be empty");
    }
    if(!empty($_POST["email"])) {
        $email = filter_var($_POST["email"],FILTER_SANITIZE_STRING);
        if($email === false) {
            array_push($errors, "incorrect email");
            $email = $_POST["email"];
        }
    } else {
        array_push($errors, "email can not be empty");
    }
    if(!empty($_POST["bericht"])) {
        $bericht = filter_var($_POST["bericht"],FILTER_SANITIZE_STRING);
        if($bericht === false) {
            array_push($errors, "incorrect bericht");
            $bericht = $_POST["bericht"];
        }
    } else {
        array_push($errors, "bericht can not be empty");
    }


                $conn = null;
    try {
        $conn = new PDO($connectionString, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO contact (v_naam, a_naam, email, reactie) VALUES (:naam, :anaam, :email, :bericht)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue("naam", $naam, PDO::PARAM_STR);
        $stmt->bindValue("anaam", $anaam, PDO::PARAM_STR);
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->bindValue("bericht", $bericht, PDO::PARAM_STR);
        if($stmt->execute()) {
            echo "<script>alert('Bericht Gestuurd');window.location.href = 'index.html';</script>";
        } 
    } catch (PDOException $ex) {
        echo "<script>alert('Bericht sturen mislukt');</script>";
      
    } finally {
        if($conn != null) {
            $conn = null;
        }
    } }
   
    ?>