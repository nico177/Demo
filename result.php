<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>

<?php
    $anzahl = $_SESSION['korrekt'];
    $_SESSION['frageNummer'] = 0;
    $_SESSION['korrekt'] = 0;
    $_SESSION['array'] = array(0);
    echo "Du hast " .$anzahl. " von 10 richtig <br><br><br>";
    $cookie_name = "user";
    setcookie($cookie_name, $anzahl, time() + (86400 * 30), "/");

    if($_COOKIE["$cookie_name"] > $anzahl){
        echo "Du hast dich leider verschlechtert<br><br>";
    }elseif($_COOKIE["$cookie_name"] < $anzahl){
        echo "Glückwunsch! Du hast dich verbessert!<br><br>";
    }else{
        echo "Du bist gleich gut geblieben<br><br>";
    }
    ?>
    
    <p class="result"><?php  echo "Beim letzten Mal hattest du ".$_COOKIE["$cookie_name"]." von 10 richtig";  ?></p>

    
    

<form  action="index.php" method="post">
        <input class="button" type="submit" name="antwort" value="Neustart">
</form>