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
    <link rel="stylesheet" href="style/form.css">
</head>
<body>
    <div class="container">
    <form action="server.php" method="post" class="form">

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>
        
        <label>Confirm Password:</label>
        <input type="password" name="check_password"><br>

        <input type="submit" name="register" value="Register">

        <p>Already a member? <a href="login.php">Sign in</a></p>

    </form>


    <img src="files/Matav1.png" class="Matav1">
    </div>
    <script>
        $("form").submit(isFormValid);

        function isFormValid(event)
        {
            $(".error").remove();   
            $("br").remove();
            isInputFilled("email");  
            isInputFilled("password");         
            isInputFilled("check_password");  
            isPasswordValid("password", "check_password")   
            isEmailValid("email")                 

            if($(".error").length > 0){
                event.preventDefault();
                return;
            }

            $("form").unbind("submit");

        }    

        function isInputFilled(inputName){
            let input = $("input[name="+inputName+"]");
            if(input.val().trim() == "") {
                input.after("<span class='error'>Chybí povinné pole</span> <br>")    
            }
        }

        function isPasswordValid(password1 , password2){
            let input1 = $("input[name="+password1+"]");
            let input2 = $("input[name="+password2+"]");

            if(input1.val() != input2.val()){
                input2.after("<span class='error'>Hesla se neshodují</span> <br>");
            }

            if(input1.val().length < 8){
                input1.after("<span class='error'>Heslo musí mít minimálně 8 znaků</span> <br>");
            }else if(input1.val().length > 25){
                input1.after("<span class='error'>Heslo musí mít maximálně 25 znaků</span> <br>");
            }

            if(!input1.val().match(/[A-Z]/)){
                input1.after("<span class='error'>Heslo musí obsahovat alespoň jedno velké písmeno</span> <br>");
            }

            if(!input1.val().match(/[a-z]/)){
                input1.after("<span class='error'>Heslo musí obsahovat alespoň jedno malé písmeno</span> <br>");
            }


            if(!input1.val().match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)){
                input1.after("<span class='error'>Heslo musí obsahovat alespoň jeden speciální znak</span> <br>");
            }

            if(!input1.val().match(/[0-9]/)){
                input1.after("<span class='error'>Heslo musí obsahovat alespoň jedno číslo</span> <br>");
            }

            
        }

        function isEmailValid(email){
            let input = $("input[name="+email+"]");
            let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(!emailRegex.test(input.val())){
                input.after("<span class='error'>Email není validní</span> <br>");
            }
        }

    </script>
</body>
</html>