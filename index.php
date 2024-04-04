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
        <nav>
            <h2>Pizzaria di preprocessore 🍕</h2>
                <div class="inlog-uitlog"> <a href='inlogpagina.php' class='inloglink'>Inloggen</a> <a href="logout.php" class='inloglink'>Uitloggen</a>
                    <?php session_start(); if(!empty($_SESSION['name'])){ if($_SESSION['name'] === "xXGOD_OF_P1ZZAXx") {echo"<a href='admin.php' class='inloglink'>Admin</a>";}} ?>
                </div>
        </nav>  
        <h1 class='formtitle'>Our quality pizza's! </h1>
            <?php
                $year = date('Y');
                $day = date("l");
                if ($day == "Monday") {
                    echo "<p class='kortingmsg'> Monday all pizza's 7,50$!</p>";

                    } elseif ($day == "Friday") {
                        echo "<p class='kortingmsg'> Friday all pizza's 15% discount (with orders above 20$)</p>";
                    }
            ?>
        <form class="form" action="order.php" method="post"> 
            <div class="centerformdiv">
                <div class="formdiv">
                    <?php 

                        include 'array.php';
                        foreach ($pizzaDetails as $key => $pizza) {
                            echo "<div class='pizzadiv'>";
                            echo"<p class='pizza-name'>" .$pizza['name'];
                            echo"</p>";
                            echo"<img src='./imagess/placeholder.jpg' class='pizza-imgs'>";
                            echo "<p class='lorem_p'>";
                            echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
                            echo "Sed at mi eget elit mattis imperdiet. Nunc tellus ligula, molestie dapibus tortor vel, varius vehicula leo.";
                            echo "Praesent eget enim nulla. Nunc cursus mi dui, non interdum dolor rutrum nec. Maecenas tristique feugiat libero, ac euismod turpis rhoncus eu.";   
                            echo "</p>";
                            echo"<div class='pizza-inp-div'>";
                            echo"<p class='pizza-price'>" .$pizza['price'];
                            echo"</p>";
                            echo"<input type='number' min='0' max='10' name='$key' class='pizza-inp'> <br><br> ";
                            echo"</div>";
                            echo"</div>";
                        }
                    ?>
                </div>
            </div>
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
        <footer>
            <?php echo "<h5 class='footh5'>©JH All rights reserved."."  " .$year."</h5>"; ?>
        </footer>
    </body>
</html>
