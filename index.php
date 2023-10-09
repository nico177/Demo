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
    <?php 
        
        include_once 'connect.php'

    ?>  

    <h1>Allgemeinwissen Quiz</h1>
</head>
<body>
    <?php   
        if(!isset($_SESSION["korrekt"])){
        $_SESSION["korrekt"] = 0;
        $_SESSION["frageNummer"] = 1;
        }

        if(!isset($_SESSION["array"])){
            $_SESSION["array"]= array(0);
            }


        
        
        


        
        
        
        $number = $_SESSION["frageNummer"];
        echo "Das ist Frage: ".$number." von 10 <br>";
        
    ?>
    
    
    <?php

        $sql = "SELECT * FROM answer ORDER BY ID DESC LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $rowa = mysqli_fetch_assoc($result); 
        $zahl = $rowa['id'];
        

        if($_SESSION["frageNummer"] > 9) {
            header("location:result.php");
        }else{
           
        }
        $array = $_SESSION["array"];
        $array2 = implode(',', $array);
        $sql = "SELECT * FROM questions WHERE id NOT IN (".implode(',', $array).") ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $antwort = $row['antwort'];
        $idwert = $row['id'];
        array_push($array,$idwert);
        $_SESSION["array"] = $array;
        $text = $row['text1'];

        $sql2 = "INSERT INTO answer(antwort, nummer,  texte) VALUES ('$antwort', '$zahl','$text')";
        if ($conn->query($sql2) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "SELECT * FROM answer WHERE id = '$zahl';";
        $result = mysqli_query($conn, $sql);
        $rowaa = mysqli_fetch_assoc($result);    
        

        

        if($_SESSION["frageNummer"] == 1){
            
        }else{
            echo "<br> Antwort von der letzten Frage: " .$rowaa['antwort']. " <br><br>";
            echo $rowaa['texte']. "<br><br>";
        }
        


        echo "<br>".$row['frage']. "<br><br><br>";
       

        

        

        
?>      
    <meter class="meter" value="<?php echo $_SESSION["frageNummer"]; ?>" min="0" max="10">
    </meter>


    <div class="fragen">
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" id="frage1" type="submit" name="antwort" value="<?php echo $row['antwort1']; ?>">
    </form>
    
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" id="frage2" type="submit" name="antwort" value="<?php echo $row['antwort2']; ?>">
    </form>

    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" id="frage3" type="submit" name="antwort" value="<?php echo $row['antwort3']; ?>">
    </form>

    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="button" id="frage4" type="submit" name="antwort" value="<?php echo $row['antwort4']; ?>">
    </form>
    </div>
    
    


    <?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $_SESSION["frageNummer"]++;
    if($_POST['antwort'] == $rowaa['antwort']){
        $_SESSION["korrekt"]++;
        
        
    }else{
        
        
        
    }
    
    

    }

    ?>
</body>
</html>

