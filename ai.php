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
    <nav><h2>Pizzaria di preprocessore 🍕</h2> </nav>
<?php

// checkt wanneer je op submit drukt.

if (isset($_POST["submit"])) {
    // functie die ongewenste characters verwijderd
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Een multidimensional, associetive array die alle pizza informatie bewaardt
    include 'array.php';

    // variabelen die user input bewaren
    $naam = checkInput($_POST["naam"]);
    $adres = checkInput($_POST["adres"]);
    $postcode = checkInput($_POST["postcode"]);
    $plaats = checkInput($_POST["plaats"]);
    $datum = checkInput($_POST["datum"]);

    
    $bezorgen = 0.00;
    $bezorg_msg = "";
    $korting_msg = "";
    $aantalpiz = 0.00;
    $day = date("l");
    $datecheck = date("Y-m-d\TH:i");

    if ($datum < $datecheck) {
        echo "<h1 class='nopiz';> Invalid date!</h1>";
        echo "<a href='index.php'> Go back </a>";
        exit;
    }

    //als bezorgen word geselecteerd dan word 5 bij de prijs op gedaan en een message ge-echo'd
    if ($_POST["bezorgen"] == "bezorgen") {
        $bezorgen = 5.00;
        $bezorg_msg = "<p>+ $5.00 delivery costs</p>";
    } 
    
    
    
    // bewaard de hoeveelheid bestelde pizzas in de $amount array en in $aantalpiz voor een check.
    foreach ($pizzaDetails as $key => $pizza) {
        $amount[$key] = floatval($_POST[$key]);
        $aantalpiz += $amount[$key];
        
    }
    if ($aantalpiz <= 0.00) {
        echo "<h1 class='nopiz';>Order at least 1 pizza!</h1>";
        echo "<a href='index.php'> Go back </a>";
        exit;
    }

    foreach ($pizzaDetails as $key => $pizza) {
        $piz_prices[$key] = ($day == "Monday") ? 7.50 : $pizza['price']; //als het maandag worden alle prijzen 7.50 anders blijven de prijzen hetzelfde.
        $prices[$key] = $amount[$key] * $piz_prices[$key];
    }

    // alle on afgeprijsde (de originele waarden) in de array worden opgeteld om de totaalprijs te berekenen zonder kortingen.
    $totalprice = array_sum($prices) + $bezorgen;

    // zorg voor korting op maandag en vrijdag
    if ($day == "Monday") {
        $korting_msg = "<p><font color=green> Monday all pizza's 7,50$!</font></p>";
    } elseif ($day == "Friday" && $totalprice > 20) {
        // berekent de korting 
        foreach ($pizzaDetails as $key => $pizza) {
            $discountedPrice = $amount[$key] * $piz_prices[$key] * 0.85;
            $prices[$key] = $discountedPrice;
        }
        $totalprice = array_sum($prices) + $bezorgen;
        $korting_msg = "<p class='kortingmsg'> Friday all pizza's 15% discount (with orders above 20$)</p>";
    }
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PizzaDB";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }  catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    try {
        $sql = "INSERT INTO Customers (name, address, postal_code, city, date) VALUES (:name, :address, :postal_code, :city, :date)"; 
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $naam, PDO::PARAM_STR);
        $stmt->bindParam(':address', $adres, PDO::PARAM_STR);
        $stmt->bindParam(':postal_code', $postcode, PDO::PARAM_STR);
        $stmt->bindParam(':city', $plaats, PDO::PARAM_STR);
        $stmt->bindParam(':date', $datum, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();
        $last_id = $pdo->lastInsertId(); //store id?
        echo "New record created successfully". " id: $last_id";
        
    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    

    

    // de html echo's
    echo"<div class='textdiv1'>";
    echo "<h3>Thanks for your order! (:</h3> <br>";
    if (!empty($korting_msg)) {
        echo $korting_msg . "<br>";
    }
    echo"</div>";

    echo "<div class='textdiv1'>";
    echo"<p>";
    echo "Your name: " . $naam . "<br> <br>";
    echo "Your adress: " . $adres . "<br> <br>";
    echo "Your postal code: " . $postcode . "<br> <br>";
    echo "Your location: " . $plaats . "<br> <br>";
    echo "delivery or pick up: " . checkInput($_POST["bezorgen"]) .   "<br> <br>";
    echo "Your date: " . str_replace("T", " ", $datum) . " " . $day . "<br><br>";
    echo "<h3>Your pizza's: </h3>" . "<br> <br>";
    echo"</p>";
    echo "</div>";

    echo "<div class='textdiv1'>";
    foreach ($pizzaDetails as $key => $pizza) {
        echo "You ordered " . $amount[$key] . " " . $pizza['name'] . "(s) Price: " . number_format($prices[$key], 2, ",", ".") . "<br><br>";
    }
    echo "</div>";

    
    echo "<div class='textdiv2'>";
    echo "Total price: " . number_format($totalprice, 2, ",", ".") . " " . $bezorg_msg;
    echo "</div>";
}
?>
</body>
</html>

