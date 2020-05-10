<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
 
} 
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";     //root is default in most cases
$password = "student";     //root is default in most cases



$id = $_POST["id"] ??
            $_GET["id"] ?? false;

if($id === false) {
    echo "Incorrect 1 input";
    die();
}

$id = filter_var($id, FILTER_VALIDATE_INT);
if($id === false) {
    echo "Incorrect 2 input";
    die();
}

try {
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $deleteStmt = $conn->prepare("DELETE FROM contact WHERE id = :id");
    $deleteStmt->bindValue(":id", $id);

    $deleteStmt->execute();

    //redirect to index.php
    header("Location: admingegevens-contact.php");
} catch (PDOException $ex) {
    echo "PDOException $ex";
} finally {
    if($conn != null) {
        $conn = null;
    }
}