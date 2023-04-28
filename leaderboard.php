<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/leaderboard.css">
</head>
<body>
    <?php    
   include 'connection.php';
   session_start();
   $user_id = $_SESSION['user_id'];
   
   $sql = "SELECT DISTINCT poleX, poleY FROM leaderboard WHERE id_user = $user_id";
   $result = $connect->query($sql);
   
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $poleX = $row['poleX'];
           $poleY = $row['poleY'];

           $sql2 = "SELECT * FROM leaderboard WHERE id_user = $user_id AND poleX = $poleX AND poleY = $poleY";
           $result2 = $connect->query($sql2);
   
           $best_clicks = 400; //vzhledem k tomu že pole může mít maximálně 400 políček, tak toto je maximální počet tahů 
           $worst_clicks = 0;
           $total_clicks = 0;
           $count = 0;
   
           while($row2 = $result2->fetch_assoc()) {
               $clicks = $row2['clicks'];
               if ($clicks < $best_clicks) {
                   $best_clicks = $clicks;
               }
               if ($clicks > $worst_clicks) {
                   $worst_clicks = $clicks;
               }
               $total_clicks += $clicks;
               $count++;
           }
           $avg_clicks = $total_clicks / $count;
           echo "<div class='box'>";
           echo "<h2>Velikost: $poleX x $poleY</h2>";
           echo "<p>Nejlepší počet tahů: $best_clicks</p>";
           echo "<p>Průměrný počet tahů: " . round($avg_clicks, 1) . "</p>";
           echo "<p>Nejhorší počet tahů: $worst_clicks</p>";
           echo "<p>Celkový počet her: $count</p>";
           echo "</div>";
       }
   } else {
       echo "Zatím nemáte žádné statistiky.";
   }
    ?>

<a href="game.php"><button>Hrát</button></a>
</body>
</html>
