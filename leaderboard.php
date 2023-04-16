<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include 'connection.php';
    session_start();
    //echo $_SESSION['user_id']; //kontrola zda se id uživatele přenáší
    
    $sql = "SELECT * FROM leaderboard WHERE id_user = {$_SESSION['user_id']}";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<th>PoleX</th><th>PoleY</th><th>Clicks</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<td>".$row["poleX"]."</td><td>".$row["poleY"]."</td><td>".$row["clicks"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Zatím žádné záznamy";
    }
    ?>
</body>
</html>
