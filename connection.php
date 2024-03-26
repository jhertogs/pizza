<?php 
$servername = "localhost";
$Username = "xXGOD_OF_P1ZZAXx";
$Password = "917YrC6P!";
$dbname = "PizzaDB";

try{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $Username, $Password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e) {
echo $sql . "<br>" . $e->getMessage();
}
?>