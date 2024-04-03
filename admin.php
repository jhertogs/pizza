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
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    echo "<div class='admintable'>";
    echo "<form method='POST'>";
    echo "<input type='submit' name='ADD' value='ADD_PIZZA'>";
    echo "</form>";
    echo "</div>";

    
    if( isset($_POST['ADD']) ){
        echo "<div class='admintable'>";
        echo "<form method='POST'>";
        echo "<table>";

        echo "<tr class='table'>";
        echo "<th class='table'>code</th>";
        echo "<th class='table'>name</th>";
        echo "<th class='table'>price</th>";
        echo "</tr>";

        echo "<tr class='table'>";
        echo "<p>Add new pizza</p>";
        echo "<td><input type='text' name='addcode'></td>";
        echo "<td><input type='text' name='addname'></td>";
        echo "<td><input type='text' name='addprice'></td>";
        echo "<td><input type='submit' name='submit_add'></td>";
        echo "</tr>";

        echo "</table>";
        echo "</form>";
        echo"</div>";



        
        
    }
    if (isset($_POST['submit_add'])){
            $addCode = checkInput($_POST['addcode']);
            $addName = checkInput($_POST['addname']);
            $addPrice = checkInput($_POST['addprice']);
            $addCode = trim($addCode);


            $sql_check = "SELECT COUNT(*) FROM pizzas WHERE code = :code";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':code', $addCode, PDO::PARAM_STR);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
            if ($count > 0) {
                echo "<p class='error'>Error: Pizza code already exists. Please choose a different code.</p>";
            } else {
         
        try{
            $sql="INSERT INTO pizzas (code, name, price) VALUES (:code, :name, :price)";
            $stmt= $pdo->prepare($sql);
            $stmt->bindParam(':code', $addCode, PDO::PARAM_STR);
            $stmt->bindParam(':name', $addName, PDO::PARAM_STR);
            $stmt->bindParam(':price', $addPrice, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: update.php");
            
        }catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                echo "<p class='error'>Error: Pizza code already exists. Please choose a different code.</p>";
            } else {
                echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
            }
            // Output additional debugging information
            echo "<p class='error'>Debugging: " . $addCode . ", " . $addName . ", " . $addPrice . "</p>";
            echo "<pre>" . print_r($_POST, true) . "</pre>";
         }
        }
    }
    //will finish pizza add fucntion later

    echo "<form method='POST'>";
    echo "<div class='admintable'>";
    echo "<table>";
    echo "<tr class='table'>";
    echo "<th class='table'>code</th>";
    echo "<th class='table'>name</th>";
    echo "<th class='table'>price</th>";
    echo "<th class='table'>edit pizzas</th>";
    echo "</tr>";
     

    //makes tables with all the codes, names and prices of the pizzas in pizzaDetails array
    //input type submit is all the codes of the pizzaDetails array
    foreach ($pizzaDetails as $key => $pizza ){
    echo "<tr class='table'>";
    echo "<td class='table'>".$key."</td>";
    echo "<td class='table'>".$pizza['name']."</td>";
    echo "<td class='table'>".$pizza['price']."$"."</td>";
    echo "<td class='table'>"."<input type='submit' value='".$key."' class='edits' name='".$key."'>"."</td>";
    
}
   
    echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "</form>";

    echo "<div class='admintable'>";
    echo "<form method='POST'>";
    foreach($pizzaDetails as $key => $pizza){
        //check which submit button is pressed (so which key in $_POST has been set)
        if (isset($_POST[$key])){
            $oldcode = checkInput($_POST[$key]); //stores the previous code of the selected pizza the admin  wants to edit
            echo "<table>";
            echo "<tr class='table'>";
            echo "<th class='table'>Edit code</th>";
            echo "<th class='table'>Edit name</th>";
            echo "<th class='table'>Edit price</th>";
            echo "</tr>";

            echo "<tr class='table'>";
            echo "<p>Edit"." ". $pizza['name']."</p>";
            echo "<td>"."<input type='hidden' name='oldcode' value='".$oldcode."'><input type='text' name='code'>". "</td>";
            echo "<td><input type='text' name='pizname'></td>";
            echo "<td><input type='text' name='price'></td>";
            echo "<input type='submit' name='REMOVE' value='REMOVE'". $pizza['name']. ">";
            
            
            echo "<input type='submit' name='editsubmit'>"; 
            echo "</tr>";
            echo "</form>";
        }
    }       

    
    if( isset($_POST['REMOVE']) ){
        $oldcode = checkInput($_POST['oldcode']); // Retrieve old code of selected pizza admin wants to edit
       try{
           $sql="DELETE FROM pizzas WHERE code = :old_code ";
           $stmt= $pdo->prepare($sql);
           $stmt->bindParam(':old_code', $oldcode, PDO::PARAM_STR);
           $stmt->execute();
           header("Location: update.php");
           exit();
       }catch(PDOException $e) {
           echo $sql . "<br>" . $e->getMessage();
          }
       }

    if (isset($_POST['editsubmit'])){
        $oldcode = checkInput($_POST['oldcode']); // Retrieve old code of selected pizza admin wants to edit
        $newCode = checkInput($_POST['code']);
        $newName = checkInput($_POST['pizname']);
        $newPrice = checkInput($_POST['price']);
        if (!empty($newCode && $newName && $newPrice) && is_numeric($newPrice)){
            try{
                $sql = "UPDATE pizzas SET code = :new_code, name = :new_name, price = :new_price WHERE code = :old_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindparam(':old_code', $oldcode, PDO::PARAM_STR);
                $stmt->bindParam(':new_code', $newCode, PDO::PARAM_STR);
                $stmt->bindParam(':new_name', $newName, PDO::PARAM_STR);
                $stmt->bindParam(':new_price', $newPrice, PDO::PARAM_INT);
                $stmt->execute();
                header("Location: update.php");
            }catch(PDOException $e) {
             echo $sql . "<br>" . $e->getMessage();
            }
        }else{
            echo "<p class='idiot'>INVALID INPUT!!!! -_-</p>";
            
        }
    }
   echo "</table>";
   echo "</div>";
   
    ?>



</body>
    
</html>

