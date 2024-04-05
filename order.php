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
    <nav><h2>Pizzaria di preprocessore 🍕</h2> <a href="index.php" class='inloglink'>Terug</a> </nav>
<?php
session_start();
include 'array.php';

$now = time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        echo "<h1>SESSION EXPIRED!</h1>";
        exit;
    }
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
if (isset($_POST["submit"], $_SESSION['name']) ) { 
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
        $korting_msg = "<p class='kortingmsg'> Monday all pizza's 7,50$!</p>";
    } elseif ($day == "Friday" && $totalprice > 20) {
        // berekent de korting 
        foreach ($pizzaDetails as $key => $pizza) {
            $discountedPrice = $amount[$key] * $piz_prices[$key] * 0.85;
            $prices[$key] = $discountedPrice;
        }
        $totalprice = array_sum($prices) + $bezorgen;
        $korting_msg = "<p class='kortingmsg'> Friday all pizza's 15% discount (with orders above 20$)</p>";
    }
    include 'connection.php';
    
    $customer_id = $_SESSION['customer_id'];
    try{
        $sql = "INSERT INTO orders (customer_id, total_cost, datum) VALUES (:customer_id, :total_cost, :datum)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        $stmt->bindParam(':total_cost', $totalprice, PDO::PARAM_STR);
        $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
        $stmt->execute();

        $last_id2 = $pdo->lastInsertId();
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $orderDetails = [];
        //make new assoc array storing the pizza names and amounts ordered (does not store underorder pizzas)
    foreach ($_POST as $key => $value) {
        // Check if the key exists in $pizzaDetails
        if (array_key_exists($key, $pizzaDetails) && $value > 0) {
            // If it does, add the pizza name and quantity to $orderDetails
            $pizzaName = $pizzaDetails[$key]['name']; //make new array with the pizza names (accesd by $key which is marg fung etc and then the name key which stores the names )
            $orderDetails[$pizzaName] = $value;  //new array with the previous array as key assigned to the amounts of the pizzas that are ordered 
    }}

    try {
        foreach ($orderDetails as $key => $amount_ordered){
            $sql ="INSERT INTO ordered_pizzas (Pizzas, order_id, Amount, customer_id) VALUES (:pizzas, :order_id, :Amount, :customer_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindparam(':pizzas', $key, PDO::PARAM_STR);
            $stmt->bindparam(':Amount', $amount_ordered, PDO::PARAM_INT);
            $stmt->bindparam(':order_id', $last_id2, PDO::PARAM_INT);
            $stmt->bindparam(':customer_id', $customer_id, PDO::PARAM_STR);
            $stmt->execute();
        }

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $username = $_SESSION["name"];

    
    try{
        $stmt = $pdo->prepare("SELECT * from customers WHERE name = :username ");
        $stmt->execute([':username' => $username]);
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
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
    echo "Your name: " . $info['name'] . "<br> <br>";
    echo "Your adress: " . $info['address'] . "<br> <br>";
    echo "Your postal code: " . $info['postal_code'] . "<br> <br>";
    echo "Your location: " . $info['city'] . "<br> <br>";
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
} else {
    echo "<h1>Log in to order!</h1>". "<br>";
    echo "<a href='index.php'>Go back to homepage</a>";
}
?>
<footer> 
    <?php $year = date('Y'); echo "<h5 class='footh5'>©JH All rights reserved."."  " .$year."</h5>"; ?>
</footer>
</body>
</html>

