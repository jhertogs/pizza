<!DOCTYPE html>
<html>
    <head>
        <title>Pizza di php</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Fredericka+the+Great&display=swap" rel="stylesheet">

        
    </head>
    
    <body> 
        <nav><h2>Pizzaria di preprocessore</h2> </nav>
        
        <h1 class='formtitle'>Input your things thanks </h1>
        <form  action="echos.php" method="post">
        <h3>the pizza's</h3>
        <div class='formdiv'>
            <div class="pizzadiv">
                <p>Pizza margherita:</p>
                <img src="./imagess/pizza-margherita.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€12.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="marg" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p>Pizza funghi: </p>
                <img src="./imagess/pizza-funghi.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€12.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="fung" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p>Pizza marina: </p>
                <img src="./imagess/pizza-marina.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€13.95 per pizza.</p>
                    <input type="number" min="0" max="10" name="mari" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p>Pizza hawaii: </p>
                <img src="./imagess/pizza-hawaii.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€11.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="hawi" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p>Pizza quattro formaggi: </p>
                <img src="./imagess/pizza-formaggi.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€14.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="quat" class="pizza-inp"><br><br>
                </div>
            </div>
        </div>

            Naam: <input type="text" name="naam" required><br><br>
            Adres: <input type="text" name="adres" required><br><br>
            Postcode: <input type="text" name="postcode" required><br><br>
            Plaats: <input type="text" name="plaats" resquired><br><br>
            Bezorgen: <input type="radio" name="bezorgen-afhalen" value="bezorgen"> afhalen: <input type="radio" name="bezorgen-afhalen" value="afhalen" checked="checked"><?php $bezorgen_afhalen_empty =""; echo $bezorgen_afhalen_empty; ?><br><br>
            Datum: <input type="datetime-local" name="datum" required><br><br>
            <input type="submit" name="submit" class="submit-btn">
            
        
        </form>
    </body>
    
</html>
