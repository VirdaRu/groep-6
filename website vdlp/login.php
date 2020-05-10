<?php  
session_start();
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";     //root is default in most cases
$password = "student";     //root is default in most cases

$errors = [];
$naam = "";
$ww = "";


if(!empty($_POST["naam"])) {
    $naam = filter_var($_POST["naam"],FILTER_SANITIZE_STRING);
    if($naam === false) {
        array_push($errors, "incorrect naam");
        $naam = $_POST["naam"];
    }
} else {
    array_push($errors, "naam can not be empty");
}
if(!empty($_POST["ww"])) {
    $ww = filter_var($_POST["ww"],FILTER_SANITIZE_STRING);
    if($ww === false) {
        array_push($errors, "incorrect wachtwoord");
        $ww = $_POST["ww"];
    }
} else {
    array_push($errors, "wachtwoord can not be empty");
}

    if($naam === "admin" && $ww === "wachtwoord") {
        session_start();
        $_SESSION["user_id"] = uniqid();
        header('Location: admingegevens.php');
    }
?>

<form method="post">
    <input type="text" name="naam">
    <input type="password" name="ww">
    <button type="submit">Login</button>
</form>
