<!DOCTYPE html>
<html>
    <head>

    </head>
    <?php 
$naam = $adres = $postcode = $plaats = $besteldatum = $bezorgen_afhalen = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["naam"])){
        $naam_empty = "U moet een naam invullen!";
    } else{
        $naam = checkinp($_POST["naam"]);
    }

    if(empty($_POST["adres"])){
        $adres_empty = "U moet een adres invullen!";
    } else{
        $adres = checkinp($_POST["adres"]);
    }

    if(empty($_POST["postcode"])){
        $postcode_empty = "U moet een postcode invullen!";
    } else{
        $postcode = checkinp($_POST["postcode"]);
    }

    if(empty($_POST["plaats"])){
        $plaats_empty = "U moet een plaats invullen!";
    } else{
        $plaats = checkinp($_POST["plaats"]);
    }

    if (empty($_POST["bezorgen-afhalen"])){
        $bezorgen_afhalen_empty = "U moet afhalen of bezorgen selecteeren";
    } else{
        $bezorgen_afhalen = checkinp($_POST["bezorgen-afhalen"]);
    }

    }
 function checkinp ($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
      }
?>
    <body> 
        <h1>Input your things thanks :3</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            Naam: <input type="text" name="naam"><br><br>
            Adres: <input type="text" name="adres"><br><br>
            Postcode: <input type="text" name="postcode"><br><br>
            Plaats: <input type="text" name="plaats"><br><br>
            Bezorgen: <input type="radio" name="bezorgen-afhalen" value="bezorgen"> afhalen: <input type="radio" name="bezorgen-afhalen" value="afhalen"><br><br>
            Datum: <input type="time" name="datum">
            <input type="submit">

        </form>
        <?php 
        echo "<h3>These are your things:</h3> <br>";
        echo "Dit is je naam: " .$naam. "<br>";
        echo "Dit is je adres: ". $adres. "<br>";
        echo "Dit is je postcode: ".$postcode. "<br>";
        echo "Dit is je plaats: ".$plaats. "<br>";
        echo "Bezorgen of afhalen: ".$bezorgen_afhalen. "<br>";
        
        ?>
   
    </body>
</html>
