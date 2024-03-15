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
    <div class="formdiv" action="inlogpagina.php">
        <form  method="POST">
            <label for="name">Name:</label>
            <input  type="text" minlength="0" maxlength="20" id="name" class="inlog-input" required name="username">
            <label for="Pass">Password:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Pass" class="inlog-input" required name="password">
            <input  class="inlog-input" type="submit"name="submit3">
        </form>
    </div>
     
    <?php 
    

    $servername = "localhost";
    $Username = "root";
    $Password = "";
    $dbname = "PizzaDB";

    if (isset($_POST["submit3"])) {
        try{
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $Username, $Password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve user input
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

        }
            if (!empty($username) && !empty($password)) {
                $sql = "INSERT INTO users (Username, Password) VALUES (:username, :hash)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
                
                $stmt->execute();
                header("Location: inlogpagina.php");
                    exit();
        } else {
            $error_message = "invalid username";
        }
    }

if (isset($error_message)){
    echo $error_message;
}
    
    ?>
    </body>
</html>