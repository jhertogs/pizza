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
    <h1>Please fill in your name and password</h1>
    
     
    <?php 
    

    $servername = "localhost";
    $Username = "root";
    $Password = "";
    $dbname = "PizzaDB";
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit3"])) {
        try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $Username, $Password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }   catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
        }
            // Retrieve user input
            $username = $_POST['username'];
            $password = $_POST['password'];
            $adress = $_POST['adress'];
            $postcode = $_POST['postcode'];
            $place = $_POST['place'];

            $hash = password_hash($password, PASSWORD_DEFAULT);
        
       
            $sql = "SELECT * FROM customers WHERE name = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            //echo var_dump($user);

            if (empty($user)) {
                $sql = "INSERT INTO customers (name, Password, address, postal_code, city) VALUES (:username, :hash, :adress, :postcode, :city)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
                $stmt->bindParam(':adress', $adress, PDO::PARAM_STR);
                $stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
                $stmt->bindParam(':city', $place, PDO::PARAM_STR);
                
                $stmt->execute();
                header("Location: inlogpagina.php");
                exit();
                } else {
                    $error_message= " This username or password already exists!!!!";
                } 
    }
    ?>
    <div class="formdiv" >
        <form  method="POST" action="registerpagina.php">
            <label for="name">Name:</label>
            <input  type="text" minlength="0" maxlength="20" id="name" class="inlog-input" required name="username">

            <label for="Pass">Password:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Pass" class="inlog-input" required name="password">

            <label for="Adres">Adress:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Adres" class="inlog-input" required name="adress">

            <label for="Postcode">Postcode:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Postcode" class="inlog-input" required name="postcode">

            <label for="Place">Place:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Place" class="inlog-input" required name="place">

            <input  class="inlog-input" type="submit" name="submit3">
        </form>
    </div>
    <?php
    
        if (isset($error_message)){
            echo $error_message;
        }
    ?>
    </body>
</html>