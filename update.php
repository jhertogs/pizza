<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Fredericka+the+Great&display=swap" rel="stylesheet">
</head>
<body>
    <nav><h2>Pizzaria di preprocessore 🍕</h2><div class="inlog-input"><a href="index.php" class='inloglink'>Home</a><a class="inloglink" href="admin.php">Terug</a></div> </nav>
    <h1>Edited pizza table succesfully!!</h1>
<div class="linkdiv">
    <a href="admin.php" class="inloglink">Admin</a>
    <a href="index.php" class='inloglink'>Home</a>
</div>
<div class="fdiv">
    <footer> 
        <?php $year = date('Y'); echo "<h5 class='footh5'>©JH All rights reserved."."  " .$year."</h5>"; ?>
    </footer>
</div>
    </body>
</html>