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
            $prices[$key] = ($amount[$key] * $piz_prices[$key]) - (($amount[$key] * $piz_prices[$key]) / 100) * $discount_percent;
        }
        $totalprice = array_sum($prices) + $bezorgen;
        $korting_msg = "<p><font color=green>Vrijdag alle pizza's 15% korting!</font></p>";
    }

    // Display user information and order details
    echo "<h3>These are your things:</h3> <br>";
    if (!empty($korting_msg)) {
        echo $korting_msg . "<br>";
    }
    echo "Dit is je naam: " . $naam . "<br>";
    echo "Dit is je adres: " . $adres . "<br>";
    echo "Dit is je postcode: " . $postcode . "<br>";
    echo "Dit is je plaats: " . $plaats . "<br>";
    echo "Bezorgen of afhalen: " . checkInput($_POST["bezorgen-afhalen"]) . "<br>";
    echo "Dit is je datum: " . $datum . " " . $day . "<br><br>";
    echo "<h3>These are your pizza's: </h3>" . "<br>";

    foreach ($pizzaDetails as $key => $pizza) {
        echo "You ordered " . number_format($amount[$key], 2, ",", ".") . " " . $pizza['name'] . "(s) Price: " . number_format($prices[$key], 2, ",", ".") . "<br><br>";
    }

    echo "Total price: " . number_format($totalprice, 2, ",", ".") . " " . $bezorg_msg;
}
?>