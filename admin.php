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
    <nav><h2>Pizzaria di preprocessore 🍕</h2><div class="inlog-uitlog"> <a href="index.php" class='inloglink'>Home</a> <a href="logout.php" class='inloglink'>uitloggen</a></div> </nav>
    <h1> Admin page</h1>
    <div class="epicpiz"><img src='./imagess/piz.gif'></div>
    <h2 class="adminh2">The holy table of pizza's</h2>
    <?php
    session_start();
    include 'array.php';
    include 'connection.php';
    
    echo "<div class='admintable'>";
    echo "<table>";
    echo "<tr class='table'>";

     
    echo "<th class='table'>code</th>";
    echo "<th class='table'>name</th>";
    echo "<th class='table'>price</th>";
    echo "</tr>";
     
    foreach ($pizzaDetails as $key => $pizza ){
    echo "<tr class='table'>";
    echo "<td>".$key."</td>";
    echo "<td>".$pizza['name']."</td>";
    echo "<td>".$pizza['price']."$"."</td>";
    
    echo "</tr>";
}
    echo "</table>";
    echo "</div>";

    //echo var_dump($pizzaDetails);
    ?>
    


</body>
    
</html>
