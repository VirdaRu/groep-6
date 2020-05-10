<?php


$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";    
$password = "student";  

if(isset($_POST['naam'])){
    $naam = $_POST['naam'];}
 
    if(isset($_POST['anaam'])){
        $anaam = $_POST['anaam'];}

        if(isset($_POST['email'])){
            $email = $_POST['email'];}

            if(isset($_POST['bericht'])){
                $bericht = $_POST['bericht'];}

                if(isset($_POST['functie'])){
                    $functie = $_POST['functie'];}

                $conn = null;
    try {
        $conn = new PDO($connectionString, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO vacature_reactie (v_naam, a_naam, email, reactie, functie) VALUES (:naam, :anaam, :email, :bericht, :functie)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue("naam", $naam, PDO::PARAM_STR);
        $stmt->bindValue("anaam", $anaam, PDO::PARAM_STR);
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->bindValue("bericht", $bericht, PDO::PARAM_STR);
        $stmt->bindValue("functie", $functie, PDO::PARAM_STR);
        if($stmt->execute()) {
            echo "<script>alert('Vacature Gestuurd');window.location.href = 'vacatures.php';</script>";
        } 
    } catch (PDOException $ex) {
        echo "<script>alert('Vacature sturen mislukt');</script>";
      
    } finally {
        if($conn != null) {
            $conn = null;
        }
    }
   
    ?>