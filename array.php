<?php 

include 'connection.php';

try {
    $sql = "SELECT code, name, price FROM pizzas";
    $stmt = $pdo->query($sql);

    $pizzaDetails = [];
    if ($stmt->rowCount() > 0) {
        //this loop works becuase fetch fetches only 1 row at a time and returns FALSE if there are no more
        //rows to fetch so it will fetch all the rows and then stop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pizzaDetails[$row['code']] = ['name' => $row['name'], 'price' => $row['price']];
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
unset($pdo);

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