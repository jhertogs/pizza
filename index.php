<!DOCTYPE html>
<html lang="en">
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
        <nav><h2>Pizzaria di preprocessore 🍕</h2> <div class="inlog-uitlog"> <a href='inlogpagina.php' class='inloglink'>Inloggen</a> <a href="logout.php" class='inloglink'>Uitloggen</a></div></nav>  
        <h1 class='formtitle'>Our quality pizza's! </h1>
        <?php $day = date("l");

                if ($day == "Monday") {
                    echo "<p class='kortingmsg'> Monday all pizza's 7,50$!</p>";

                } elseif ($day == "Friday") {
                    echo "<p class='kortingmsg'> Friday all pizza's 15% discount (with orders above 20$)</p>";

                }
        ?>
        <form  action="ai.php" method="post"> 
            <div class="formdiv">
            <?php 

                include 'array.php';
                foreach ($pizzaDetails as $key => $pizza) {
                    echo "<div class='pizzadiv'>";
                    echo"<p class='pizza-name'>" .$pizza['name'];
                    echo"</p>";
                    echo"<img src='./imagess/placeholder.jpg' class='pizza-imgs'>";
                    echo"<div class='pizza-inp-div'>";
                    echo"<p class='pizza-price'>" .$pizza['price'];
                    echo"</p>";
                    echo"<input type='number' min='0' max='10' name='$key' class='pizza-inp'> <br><br> ";
                    echo"</div>";
                    echo"</div>";
                }
            ?>
            </div>



        <!-- 
        <body> 
        <nav><h2>Pizzaria di preprocessore 🍕</h2> </nav>
        <h1 class='formtitle'>Our quality pizza's! </h1>
        <form  action="ai.php" method="post">

        <div class='formdiv'>
            <div class="pizzadiv">
                <p class="pizza-name">Pizza margherita:</p>
                <img src="./imagess/pizza-margherita.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€12.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="marg" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p class="pizza-name">Pizza funghi: </p>
                <img src="./imagess/pizza-funghi.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€12.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="fung" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p class="pizza-name">Pizza marina: </p>
                <img src="./imagess/pizza-marina.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€13.95 per pizza.</p>
                    <input type="number" min="0" max="10" name="mari" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p class="pizza-name">Pizza hawaii: </p>
                <img src="./imagess/pizza-hawaii.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€11.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="hawi" class="pizza-inp"><br><br>
                </div>
            </div>

            <div class="pizzadiv">
                <p class="pizza-name">Pizza quattro formaggi: </p>
                <img src="./imagess/pizza-formaggi.jpg" class="pizza-imgs">
                <div class="pizza-inp-div">
                    <p class="pizza-price">€14.50 per pizza.</p>
                    <input type="number" min="0" max="10" name="quat" class="pizza-inp"><br><br>
                </div>
            </div>
        </div>
        -->        
    <hr>
    <div class=info-center>
        <div class="user-info-form">
        <h3 class="h3"> Fill in to proceed.</h3>
            
           <div>
                <p class="inline">Deliver:</p> <input type="radio" name="bezorgen" value="bezorgen" required> <p class="inline">Pick up:</p> <input type="radio" name="bezorgen" value="afhalen"><br><br>
           </div>
           <div>
                <p class="inline">Date:</p> <input type="datetime-local" name="datum" required><br><br>
           </div>
           <div>
                <input type="submit" name="submit" class="submit-btn">
           </div>
        </div>
    </div>
        
 </form>
</body>
    
</html>
