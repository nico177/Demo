<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
    $name = $_SESSION['korrekt'];
    $_SESSION['g'] = 0;
    $_SESSION['korrekt'] = 0;
    echo "Du hast " .$name. " von 10 richtig";
    
?>
<form  action="index.php" method="post">
        <input class="button" type="submit" name="antwort" value="Neustart">
</form>