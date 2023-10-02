<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php 
        include_once 'connect.php'

    ?>  

    <h1>Allgemeinwissende Quiz</h1>
</head>
<body>
    <?php   
        $sql = "SELECT * FROM answer ORDER BY ID DESC LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $rowa = mysqli_fetch_assoc($result); 
        $zahl = $rowa['id'];
        $frageNummer = $rowa['frageNummer'];
        $korrekt = $rowa['korrekt'];

        if($frageNummer < 10) {
            
        }else{
            echo "Glückwunsch du hast " .$korrekt. " von 10 korrekt!<br><br><br><br><br>";
        }


        $rand = random_int(1, 20);
        $sql = "SELECT * FROM questions WHERE id = '$rand';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $antwort = $row['antwort'];

        if($frageNummer < 10) {
            $frageNummer++;
        }else{
            $frageNummer = 1;
            $korrekt = 0;
            
            
        }


      
        



        $text = $row['text1'];

        $sql2 = "INSERT INTO answer(antwort, nummer, frageNummer, korrekt, texte) VALUES ('$antwort', '$zahl', '$frageNummer','$korrekt','$text')";
        if ($conn->query($sql2) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "SELECT * FROM answer WHERE id = '$zahl';";
        $result = mysqli_query($conn, $sql);
        $rowaa = mysqli_fetch_assoc($result);    
        

        if($frageNummer == 1){

        }else{
        echo "<br> Antwort von der letzten Frage: " .$rowaa['antwort']. " <br><br>";
        echo $rowaa['texte']. "<br><br>";
        }
        echo $row['frage']. "<br><br><br>";
       

        

        

        
?>


    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" type="submit" name="antwort" value="<?php echo $row['antwort1']; ?>">
    </form>
    
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" type="submit" name="antwort" value="<?php echo $row['antwort2']; ?>">
    </form>

    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" type="submit" name="antwort" value="<?php echo $row['antwort3']; ?>">
    </form>

    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" type="submit" name="antwort" value="<?php echo $row['antwort4']; ?>">
    </form>
    <?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['antwort'] == $rowaa['antwort']){
        $korrekt++;
        
        $sql3 = "UPDATE answer SET korrekt = '$korrekt' WHERE nummer = $zahl;";
        if ($conn->query($sql3) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            
            
        }
    }else{
        
    }
    
    

    }

    ?>
</body>
</html>

