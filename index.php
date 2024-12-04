<?php 
require'db.php';

$query = $pdo->query("SELECT * FROM media ORDER BY skapad DSC");
$media = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/src/style/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film - och serie lista</title>

</head>
<body>
    
</body>
</html>