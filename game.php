<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hledání Pokladu</title>
    <link rel="stylesheet" href="style/game.css">
</head>
<body>
    <div class="poleLength">
        <form>
            <label for="poleLength">Zadejte velikost pole:</label>
            <input type="number" name="poleLengthX" id="poleLengthX" min="5" max="20" value="10">
            <input type="number" name="poleLengthY" id="poleLengthY" min="5" max="20" value="10">
            <input type="submit" value="Zvolit velikost">
        </form>    
    </div>



    <div class="gameArea">

    </div>




    <script src="script/game.js"></script>
</body>
</html>