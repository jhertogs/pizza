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
    $pizzaDetails = [
        'marg' => ['name' => 'Pizza Margherita', 'price' => 12.50],
        'fung' => ['name' => 'Pizza Funghi', 'price' => 12.50],
        'mari' => ['name' => 'Pizza Marina', 'price' => 13.95],
        'hawi' => ['name' => 'Pizza Hawaii', 'price' => 11.50],
        'quat' => ['name' => 'Pizza Quattro Formaggi', 'price' => 14.50],
        
    ];

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

    //als bezorgen word geselecteerd dan word 5 bij de prijs op gedaan en een message ge-echo'd
    if ($_POST["bezorgen"] == "bezorgen") {
        $bezorgen = 5.00;
        $bezorg_msg = "<p>+ $5.00 bezorg kosten</p>";
    } 
    
    
    
    // bewaard de hoeveelheid bestelde pizzas in de $amount array en in $aantalpiz voor een check.
    foreach ($pizzaDetails as $key => $pizza) {
        $amount[$key] = floatval($_POST[$key]);
        $aantalpiz += $amount[$key];
        
    }
    // checked of je meer dan 1 pizza hebt besteld.
    if ($aantalpiz <= 0.00) {
        echo "<h1 class='nopiz';>Bestel tenminste 1 pizza!</h1>";
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
        $korting_msg = "<p><font color=green>Maandag alle pizza's 7,50$!</font></p>";
    } elseif ($day == "Friday" && $totalprice > 20) {
        // berekent de korting 
        foreach ($pizzaDetails as $key => $pizza) {
            $discountedPrice = $amount[$key] * $piz_prices[$key] * 0.85;
            $prices[$key] = $discountedPrice;
        }
        $totalprice = array_sum($prices) + $bezorgen;
        $korting_msg = "<p class='kortingmsg'>Vrijdag alle pizza's 15% korting bij bestelling boven 20$!</p>";
    }
    

    // de html echo's
    echo"<div class='textdiv1'>";
    echo "<h3>Thanks for your order! (:</h3> <br>";
    if (!empty($korting_msg)) {
        echo $korting_msg . "<br>";
    }
    echo"</div>";

    echo "<div class='textdiv1'>";
    echo"<p>";
    echo "Dit is je naam: " . $naam . "<br> <br>";
    echo "Dit is je adres: " . $adres . "<br> <br>";
    echo "Dit is je postcode: " . $postcode . "<br> <br>";
    echo "Dit is je plaats: " . $plaats . "<br> <br>";
    echo "Bezorgen of afhalen: " . checkInput($_POST["bezorgen"]) .   "<br> <br>";
    echo "Dit is je datum: " . str_replace("T", " ", $datum) . " " . $day . "<br><br>";
    echo "<h3>These are your pizza's: </h3>" . "<br> <br>";
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
    echo $_POST["bezorgen"];
}
?>
</body>
</html>

