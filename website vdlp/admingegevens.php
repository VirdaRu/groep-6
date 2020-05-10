<?php
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
    $sql = "SELECT v_naam, a_naam, reactie, email, functie FROM vacature_reactie";
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
<div class="site-section">
        <div class="container">
          <div class="row mb-5 ">
            <div class="col-md-12 section-title text-center mx-auto">
                
            <?$count = 0; 
            foreach ($rows as $row) { ?>

      <div class="mb-3"> <?= $row["v_naam"]?>  <?= $row["a_naam"]?> | <?= $row["email"]?> | <?= $row["functie"]?>   </div> <br>

      <?=  $beschrijving2 = wordwrap($row["reactie"], 20, "\n");
      ?>
      <div>-------------------------------------------------------------------------------------------------</div>
<? } ?>

            
         
          
</body>
</html>