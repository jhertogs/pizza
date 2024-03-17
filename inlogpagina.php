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
    <nav><h2>Pizzaria di preprocessore 🍕</h2> <a class='registlink' href='registerpagina.php'>Register</a></nav>
    <h1>Please fill in your name and password</h1>
    <div class="formdiv" action="inlogpagina.php">
        <form  method="POST">
            <label for="name">Name:</label>
            <input  type="text" minlength="0" maxlength="20" id="name" class="inlog-input" required name="username">
            <label for="Pass">Password:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Pass" class="inlog-input" required name="password">
            <input  class="inlog-input" type="submit"name="submit2">
        </form>
    </div>
     
    <?php 
    session_start();
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);

    $servername = "localhost";
    $Username = "root";
    $Password = "";
    $dbname = "PizzaDB";

    if (isset($_POST["submit2"])) {
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
            
        
            // Check if username and password are not empty
            if (!empty($username) && !empty($password)) {
                // Prepare SQL statement to retrieve user information
                $stmt = $pdo->prepare("SELECT * FROM customers WHERE name = :username");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo var_dump($user);
                //$hash= password_hash($user['Password'], PASSWORD_DEFAULT);
                
        
                // Verify if the user exists and the password is correct
                if ($user && password_verify($password, $user['Password'])) {
                    // Set session variables to indicate user is logged in
                    $_SESSION['User_id'] = $user['User_id'];
                    $_SESSION['Username'] = $user['Username'];

                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = "Invalid username or password";
                }
            } else {
                $error_message = "Username and password cannot be empty";
            }
        }
        
    

    }
    if (isset($error_message)) {
        echo $error_message. " " ;
        echo "<a href='registerpagina.php'>Register</a>";
    }
    
    ?>
    </body>
</html>