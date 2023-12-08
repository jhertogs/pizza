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
// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Function to sanitize and validate input
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Array for pizza details
    $pizzaDetails = [
        'marg' => ['name' => 'Pizza Margherita', 'price' => 12.50],
        'fung' => ['name' => 'Pizza Funghi', 'price' => 12.50],
        'mari' => ['name' => 'Pizza Marina', 'price' => 13.95],
        'hawi' => ['name' => 'Pizza Hawaii', 'price' => 11.50],
        'quat' => ['name' => 'Pizza Quattro Formaggi', 'price' => 14.50],
        
    ];

    // Retrieve user input
    $naam = checkInput($_POST["naam"]);
    $adres = checkInput($_POST["adres"]);
    $postcode = checkInput($_POST["postcode"]);
    $plaats = checkInput($_POST["plaats"]);
    $datum = checkInput($_POST["datum"]);

    // Default values for delivery and discount messages
    $bezorgen = 0.00;
    $bezorg_msg = "";
    $korting_msg = "";

    // Retrieve pizza quantities
    foreach ($pizzaDetails as $key => $pizza) {
        $amount[$key] = floatval($_POST[$key]);
    }

    // Calculate pizza prices based on the day
    $day = date("l");
    $discount_percent = 15; // Discount percentage for Friday

    foreach ($pizzaDetails as $key => $pizza) {
        $piz_prices[$key] = ($day == "Monday") ? 7.50 : $pizza['price'];
        $prices[$key] = $amount[$key] * $piz_prices[$key];
    }

    // Calculate total price without discounts
    $totalprice = array_sum($prices) + $bezorgen;

    // Check for discounts based on the day and total price
    if ($day == "Monday") {
        $korting_msg = "<p><font color=green>Maandag alle pizza's 7,50$!</font></p>";
    } elseif ($day == "Friday" && $totalprice > 20) {
        // Apply discount on Friday for orders over $20
        foreach ($pizzaDetails as $key => $pizza) {
            $discountedPrice = $amount[$key] * $piz_prices[$key] * 0.85;
            $prices[$key] = $discountedPrice;
        }
        $totalprice = array_sum($prices) + $bezorgen;
        $korting_msg = "<p class='kortingmsg'>Vrijdag alle pizza's 15% korting</p>";
    }

    // Display user information and order details
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
    echo "Bezorgen of afhalen: " . checkInput($_POST["bezorgen-afhalen"]) . "<br> <br>";
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
}
?>
</body>
</html>

