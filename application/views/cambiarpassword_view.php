<html>
    <head>
        <title>Cambiar password</title>
    </head>
    <form action="cambiarpassword" method="post">

    password<input type ="password" name="password_actual" id="password_actual"/><br/>
    nuevo password<input type="password" name="nuevo1" id="pass_nuevo1"/><br/>
    repita el password <input type="password" name="nuevo2" id="pass_nuevo2"/><br/>
    <input type="submit" value="enviar"/>
    </form>
    <?php
        if(isset($error))echo $error;
        if(isset($error2)) echo $error2;
            
        
    ?>
</html>