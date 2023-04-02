<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="styly.css">
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        print_r($_POST);
    ?>
    <form action="server.php" method="post">

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>
        
        <label>Confirm Password:</label>
        <input type="password" name="check_password"><br>

        <input type="submit" name="register" value="Register!">

    </form>
    <script>
        $("form").submit(isFormValid);

        function isFormValid(event)
        {
            $(".error").remove();   
            isInputFilled("email");  
            isInputFilled("password");         
            isInputFilled("check_password");                      
            
            //Když jsou chyby tak nepokračuj
            if($(".error").length > 0){
                event.preventDefault();
                return;
            }
            $("form").unbind("submit");

        }    
        function isInputFilled(inputName){
            let input = $("input[name="+inputName+"]");
            if(input.val().trim() == "")
                input.after("<span class='error'>Chybí povinný údaj! Blbče!</span>")

        }
</script>
</body>
</html>