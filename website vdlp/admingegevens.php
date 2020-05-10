<?php 
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
 
} 
if(isset($_POST["logout"])) {
    if(isset($_SESSION["user_id"])) {
        unset($_SESSION["user_id"]);
        echo '<script>alert("Uitgelogd")</script>';
        header('Location: login.php');
    } }?>

<html>
<form action="admingegevens-reactie.php">
    <input type="submit" value="Ga naar de reacties op de vacatures" />
</form>
<form action="admingegevens-vacature.php">
    <input type="submit" value="Ga naar vacatures" />
</form>
<form method="post">
    <button name="logout" type="submit">Logout</button>
</form>
</html>