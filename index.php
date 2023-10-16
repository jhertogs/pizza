<!DOCTYPE html>
<html>
    <head>
        <title>Pizza di php</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    
    <body> 
        <nav> </nav>
        <div class='formdiv'>
        <h1 class='formtitle'>Input your things thanks </h1>
        <form  action="echos.php" method="post">
        <h3>the pizza's</h3>
         
            <div class="pizzadiv">Pizza margherita: <input type="number" min="0" max="10" name="marg"><br><br> </div>
            <div class="pizzadiv">Pizza funghi: <input type="number" min="0" max="10" name="fung"><br><br></div>
            <div class="pizzadiv">Pizza marina: <input type="number" min="0" max="10" name="mari"><br><br></div>
            <div class="pizzadiv">Pizza hawaii: <input type="number" min="0" max="10" name="hawi"><br><br></div>
            <div class="pizzadiv">Pizza quattro formaggi: <input type="number" min="0" max="10" name="quat"><br><br></div>
        
            Naam: <input type="text" name="naam" required><br><br>
            Adres: <input type="text" name="adres" required><br><br>
            Postcode: <input type="text" name="postcode" required><br><br>
            Plaats: <input type="text" name="plaats" resquired><br><br>
            Bezorgen: <input type="radio" name="bezorgen-afhalen" value="bezorgen"> afhalen: <input type="radio" name="bezorgen-afhalen" value="afhalen" checked="checked"><?php $bezorgen_afhalen_empty =""; echo $bezorgen_afhalen_empty; ?><br><br>
            Datum: <input type="datetime-local" name="datum" required><br><br>
            <input type="submit" name="submit" class="submit-btn">
            

        </form>
        </div>
    </body>
    
</html>
