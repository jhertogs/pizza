<!DOCTYPE html>
<html>
    <head>
        <title>Pizza di php</title>
    </head>
    
    <body> 
        <h1>Input your things thanks </h1>
        <form  action="echos.php" method="post">
            Naam: <input type="text" name="naam" required><br><br>
            Adres: <input type="text" name="adres" required><br><br>
            Postcode: <input type="text" name="postcode" required><br><br>
            Plaats: <input type="text" name="plaats" resquired><br><br>
            Bezorgen: <input type="radio" name="bezorgen-afhalen" value="bezorgen"> afhalen: <input type="radio" name="bezorgen-afhalen" value="afhalen"><?php $bezorgen_afhalen_empty =""; echo $bezorgen_afhalen_empty; ?><br><br>
            Datum: <input type="datetime-local" name="datum" required><br><br>
        <h3>the pizza's</h3>
         
            Pizza margherita: <input type="number" min="0" max="10" name="marg"><br><br>
            Pizza funghi: <input type="number" min="0" max="10" name="fung"><br><br>
            Pizza marina: <input type="number" min="0" max="10" name="mari"><br><br>
            Pizza hawaii: <input type="number" min="0" max="10" name="hawi"><br><br>
            Pizza quattro formaggi: <input type="number" min="0" max="10" name="quat"><br><br>
            <input type="submit" name="submit">

        </form>
       
    </body>
    
</html>
