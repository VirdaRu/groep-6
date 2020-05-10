<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
 
} 
//database logingegevens
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";     
$password = "student";     

//variabelen
$errors = [];
$naam = "";
$beschrijving = "";
$opleiding = "";




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
    if(!empty($_POST["beschrijving"])) {
        $beschrijving = filter_var($_POST["beschrijving"],FILTER_SANITIZE_STRING);
        if($beschrijving === false) {
            array_push($errors, "incorrect beschrijving");
            $beschrijving = $_POST["beschrijving"];
        }
    } else {
        array_push($errors, "beschrijving can not be empty");
    }
    if(!empty($_POST["opleiding"])) {
        $opleiding = filter_var($_POST["opleiding"],FILTER_SANITIZE_STRING);
        if($opleiding === false) {
            array_push($errors, "incorrect opleiding");
            $opleiding = $_POST["opleiding"];
        }
    } else {
        array_push($errors, "opleiding can not be empty");
    }
    


    if(count($errors) == 0) {
        try {
            $conn = new PDO($connectionString, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlInsert = "INSERT INTO vacature (naam,  beschrijving, opleiding) VALUES (:naam,  :beschrijving, :opleiding)";

            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bindValue(":naam", $naam, PDO::PARAM_STR);
            $stmtInsert->bindValue(":beschrijving", $beschrijving, PDO::PARAM_STR);
            $stmtInsert->bindValue(":opleiding", $opleiding, PDO::PARAM_STR);
            $stmtInsert->execute();
           
        } catch (PDOException $exception) {
            echo "PDOException: $exception";
        } finally {
            if($conn != null) {
                $conn = null;
            }
        }
    } else {
        echo "<h1>Errors:</h1>";
        foreach ($errors as $error) {
            echo $error . "</br>";
        }
    }
}
?>
    

<div class="container">
<form method="post">
    <input type="hidden" name="ACTION" value="AddTodo">

    <input name="naam" placeholder="naam"type="text" value="<?= $naam ?>">
    <input name="beschrijving" placeholder="beschrijving"type="text" value="<?= $beschrijving ?>">
    <input name="opleiding" placeholder="opleiding"type="text" value="<?= $opleiding ?>">
    
    <button type="submit">Toevoegen</button>
</div>
</form>
</hr>
<form action="admingegevens-vacature.php">
            <input type="submit" value="Terug" />
            </div>
    </form>