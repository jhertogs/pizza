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
    <nav><h2>Pizzaria di preprocessore 🍕</h2><div class="inlog-uitlog"> <a href="index.php" class='inloglink'>Home</a> <a href="logout.php" class='inloglink'>uitloggen</a></div> </nav>
    <h1> Admin page</h1>
    <div class="epicpiz"><img src='./imagess/piz.gif'></div>
    <h2 class="adminh2">The holy table of pizza's</h2>
    <?php
    session_start();
    include 'array.php';
    include 'connection.php';
    
    echo "<form method='POST'>";
    echo "<div class='admintable'>";
    echo "<table>";
    echo "<tr class='table'>";
    echo "<th class='table'>code</th>";
    echo "<th class='table'>name</th>";
    echo "<th class='table'>price</th>";
    echo "<th class='table'></th>";
    echo "</tr>";
     
    foreach ($pizzaDetails as $key => $pizza ){
    echo "<tr class='table'>";
    echo "<td class='table'>".$key."</td>";
    echo "<td class='table'>".$pizza['name']."</td>";
    echo "<td class='table'>".$pizza['price']."$"."</td>";
    echo "<td class='table'>"."<input type='submit' value='edit' class='edits' name='".$key."'>"."</td>";
    echo "</tr>";
} 
   
    echo "</table>";
    echo "</div>";
    echo "</form>";
    
    
    echo "<table>";
    echo "<tr class='table'>";
    echo "<th class='table'>Edit code</th>";
    echo "<th class='table'>Edit name</th>";
    echo "<th class='table'>Edit price</th>";
    echo "</tr>";
    echo "<form method='POST'>";
    foreach($pizzaDetails as $key => $pizza){
        if (isset($_POST[$key])){
            echo "<tr class='table'>";
            echo "<p>Edit"." ". $pizza['name']."</p>";
            echo "<td>"."<input type='text' name='code'>". "</td>";
            echo "<td><input type='text' name='pizname'></td>";
            echo "<td><input type='text' name='price'></td>";
            echo "<input type='submit' name='editsubmit'";
            echo "</tr>";
            echo "</form>";
            if (isset($_POST['editsubmit'])){
                echo var_dump($_POST['editsubmit']);
                $newCode = $_POST['code'];
                $newName = $_POST['pizname'];
                $newPrice = $_POST['price'];
                /*
                try{
                    $sql = "UPDATE your_table_name SET code = :new_code, name = :new_name, price = :new_price WHERE condition_to_select_specific_rows";
                    $stmt = $pdo->prepare();
                    $stmt->bindParam(':new_code', $newCode);
                    $stmt->bindParam(':new_name', $newName);
                    $stmt->bindParam(':new_price', $newPrice);
                    
                    

                }catch(PDOException $e) {
                 echo $sql . "<br>" . $e->getMessage();
                }*/
            }
        }
    }
    
   echo "</table>";
   
    ?>



</body>
    
</html>

