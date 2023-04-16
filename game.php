<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hledání Pokladu</title>
    <link rel="stylesheet" href="style/game.css">
    <script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
</head>
<body>
    <div class="poleLength">
        <form>
            <label for="poleLength">Zadejte velikost pole:</label>
            <input type="number" name="poleLengthX" id="poleLengthX" min="5" max="20" value="10">
            <input type="number" name="poleLengthY" id="poleLengthY" min="5" max="20" value="10">
            <input type="submit" value="Začít hrát">
        </form>    
    </div>

    <div class="done">
        <h1>Gratulujeme</h1>
        <p>Našel jsi poklad na poli o velikosti <span id="poleLength"></span></p>
        <p>Kliknul jsi celkem <span id="pocet"></span></p>
        <button><a href="game.php"> Zkusit znovu </a></button>
        <button><a href="leaderboard.php">Výsledky</a></button>
    </div>



    <div class="gameArea">

    </div>

    <img src="files/Matav1.png" class="Matav1">

    <script src="script/game.js"></script>
</body>
</html>