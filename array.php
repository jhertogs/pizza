<?php 

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

$sql = "SELECT code, name, price FROM pizzas";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $pizzaDetails[$row['code']] = ['name' => $row['name'], 'price' => $row['price']];
    }
}
$conn->close();

/*

||old array, new array (above) now dynamically stores whatever pizzas are stored in the database||

$pizzaDetails = [
    'marg' => ['name' => 'Pizza Margherita', 'price' => 12.50],
    'fung' => ['name' => 'Pizza Funghi', 'price' => 12.50],
    'mari' => ['name' => 'Pizza Marina', 'price' => 13.95],
    'hawi' => ['name' => 'Pizza Hawaii', 'price' => 11.50],
    'quat' => ['name' => 'Pizza Quattro Formaggi', 'price' => 14.50],
    'je_dikke_moeder' => ['name' => 'Je Dikke Moeder', 'price' => 100000.00],
];


*/

?>