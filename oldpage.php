<?php 
/* 
$bezorg_msg= $bezorgen_afhalen_empty= $korting_msg= $naam = $adres = $postcode = $plaats = $datum = $bezorgen_afhalen = "";




if(isset($_POST["submit"])){
    $totalprice = 0.00;
    $day = date("l");
    $pizzas = array(
        "piz_marg"=> 12.50,
        "piz_fung" => 12.50,
        "piz_mari" => 13.95,
        "piz_hawi" => 11.50,
        "piz_quat" => 14.50
    );

        foreach ($pizzas as $pizzanames => $pizzaprices ){
            
            if ($_POST[$pizzas]){
              
            }
        }
}


if(isset($_POST["submit"])){
    $naam = checkinp($_POST["naam"]);
    $adres = checkinp($_POST["adres"]);
    $postcode = checkinp($_POST["postcode"]);
    $plaats = checkinp($_POST["plaats"]);
    $datum = checkinp($_POST["datum"]);
    if(isset($_POST["bezorgen-afhalen"]) && $_POST["bezorgen-afhalen"] == "bezorgen"){
        $bezorgen = 5.00;
        $bezorg_msg="(+ 5$ bezorg kosten)";
    }

        $amount_marg = floatval($_POST["marg"]);
        $amount_fung = floatval($_POST["fung"]);
        $amount_mari = floatval($_POST["mari"]);
        $amount_hawi = floatval($_POST["hawi"]);
        $amount_quat = floatval($_POST["quat"]);
        if($day == "Monday"){
            $price_margs = $amount_marg * 7.50;
            $price_fungis = $amount_fung * 7.50;
            $price_maris = $amount_mari * 7.50;
            $price_hawis = $amount_hawi * 7.50;
            $price_quats = $amount_quat * 7.50; 
            $totalprice = $price_fungis + $price_hawis + $price_margs + $price_maris + $price_quats;
            $korting_msg = "<p> <font color=green> Maandag alle pizza's 7,50$!</font></p>";
        }  
        else{
            $price_margs = $amount_marg * $piz_marg;
            $price_fungis = $amount_fung * $piz_fung;
            $price_maris = $amount_mari * $piz_mari;
            $price_hawis = $amount_hawi * $piz_hawi;
            $price_quats = $amount_quat * $piz_quat;
            $totalprice = $price_fungis + $price_hawis + $price_margs + $price_maris + $price_quats;
            $korting_msg = "<p><font color=red> Geen kortingen deze dag.</font></p>";
        }
        $totalprice = $price_fungis + $price_hawis + $price_margs + $price_maris + $price_quats + $bezorgen;
        if(($day == "Friday")&& ($totalprice > 20)){
            $price_margs = ($amount_marg*$piz_marg)-(($amount_marg * $piz_marg)/100)*15;
            $price_fungis = ($amount_fung*$piz_fung)-(($amount_fung * $piz_fung)/100)*15;
            $price_maris = ($amount_mari*$piz_mari)-(($amount_mari * $piz_mari)/100)*15;
            $price_hawis = ($amount_hawi*$piz_hawi)-(($amount_hawi * $piz_hawi)/100)*15;
            $price_quats = ($amount_quat*$piz_quat)-(($amount_quat * $piz_quat)/100)*15;
            $totalprice = $price_fungis + $price_hawis + $price_margs + $price_maris + $price_quats;
            $korting_msg = "<p><font color=green>Vrijdag alle pizza's 15% korting!</font></p>";
            
        }
    }



 function checkinp ($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
      }

        echo "<h3>These are your things:</h3> <br>";
        echo $korting_msg. "<br>";
        echo "Dit is je naam: " .$naam. "<br>";
        echo "Dit is je adres: ".$adres. "<br>";
        echo "Dit is je postcode: ".$postcode. "<br>";
        echo "Dit is je plaats: ".$plaats. "<br>";
        echo "Bezorgen of afhalen: ".$bezorgen_afhalen. "<br>";
        echo "Dit is je datum: ".$datum. " ". $day ."<br>";
        echo "<br><br>";
        echo "<h3>These are your pizza's: </h3>". "<br>";
        echo "You ordered". " " .number_format($amount_marg,2,",","."). " "."Pizza margherita(s)". " "  ."Price:". " " .number_format($price_margs,2,",","."). "<br><br>";
        echo "You ordered". " " .number_format($amount_fung,2,",","."). " "."Pizza fungi(s)". " "  ."Price:". " " .number_format($price_fungis,2,",",".")."<br><br>";
        echo "You ordered". " ".number_format($amount_mari,2,",","."). " "."Pizza marina(s)".  " "  ."Price:". " " .number_format($price_maris,2,",",".")."<br><br>";
        echo "You ordered". " " .number_format($amount_hawi,2,",",".")." " ."Pizza hawaii(s)". " "  ."Price:". " " .number_format($price_hawis,2,",",".")."<br><br>";
        echo "You ordered". " " .number_format($amount_quat,2,",",".")." " ."Pizza quattro formaggi(s)". " " ."Price:". " " .number_format($price_quats,2,",",".")."<br><br>";
        echo "Total price:". " ". number_format($totalprice,2,",","."). " $bezorg_msg";
*/
        ?>
