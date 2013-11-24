<html>
    <head>
        <title>Cambiar password</title>
    </head>
    <form action="recuperarpassword" method="post">
        E-mail<input type="text" name="txt_emailrecupear" id="txt_emailrecupear">  
        <input type="submit" value="Recupear Contraseña"/>
    </form>
    <?php
        if(isset($error)) echo "$error";
    ?>
</html> 