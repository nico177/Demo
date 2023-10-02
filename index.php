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

    <h1>Allgemeinwissende Quiz</h1>
</head>
<body>
    <?php   
        if(!isset($_SESSION["korrekt"])){
        $_SESSION["korrekt"] = 0;
        $_SESSION["g"] = 0;
        }

        
        
        $number = $_SESSION["g"] +1;
        echo "Das ist Frage: ".$number." von 10 <br>";

        $sql = "SELECT * FROM answer ORDER BY ID DESC LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $rowa = mysqli_fetch_assoc($result); 
        $zahl = $rowa['id'];
        

        if($_SESSION["g"] > 9) {
            header("location:result.php");
        }else{
           
        }


        $rand = random_int(1, 20);
        $sql = "SELECT * FROM questions WHERE id = '$rand';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $antwort = $row['antwort'];

        
        $text = $row['text1'];

        $sql2 = "INSERT INTO answer(antwort, nummer,  texte) VALUES ('$antwort', '$zahl','$text')";
        if ($conn->query($sql2) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "SELECT * FROM answer WHERE id = '$zahl';";
        $result = mysqli_query($conn, $sql);
        $rowaa = mysqli_fetch_assoc($result);    
        

        

        
        echo "<br> Antwort von der letzten Frage: " .$rowaa['antwort']. " <br><br>";
        echo $rowaa['texte']. "<br><br>";
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

    <meter class="meter" value="<?php echo $_SESSION["g"]; ?>" min="0" max="10">
        
    </meter>



    <?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['antwort'] == $rowaa['antwort']){
        $_SESSION["korrekt"]++;
        $_SESSION["g"]++;
        
    }else{
        $_SESSION["g"]++;
        
        
    }
    
    

    }

    ?>
</body>
</html>

