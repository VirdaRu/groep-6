<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
 
} 
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";    
$password = "student";     

$conn = null;
try
{
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, naam, beschrijving, opleiding FROM vacature";
    $stmtSelect = $conn->prepare($sql);
    $stmtSelect->execute();
    $result = $stmtSelect->setFetchMode();
    $rows = $stmtSelect->fetchAll();


} catch (PDOException $ex) {
    echo "Connection failed:  $ex";
    die();

} finally {
    if($conn != null) {
        $conn = null;
    }
} ?>

<html>
<body>
<form action="admingegevens.php">
    <input type="submit" value="Terug" />
</form>
<form action="vacature-add.php">
    <input type="submit" value="Voeg vacature toe" />
</form>
<div class="site-section">
        <div class="container">
          <div class="row mb-5 ">
            <div class="col-md-12 section-title text-center mx-auto">
                
            <?$count = 0; 
            foreach ($rows as $row) { ?>

      <div class="mb-3"> <?= $row["naam"]?> | <?= $row["opleiding"]?>   </div> <br>

      <?=  $beschrijving2 = wordwrap($row["beschrijving"], 20, "\n");
      ?>
       <form method="post" action="admindelete-vacature.php">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <button type="submit">Verwijder</button>
            </form>
      <div>-------------------------------------------------------------------------------------------------</div>
<? } ?>

            
         
          
</body>
</html>