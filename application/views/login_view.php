<html>
    <head>
        <title>LOGIN</title>
    </head>
    <form action="login/autenticacion" method="post">
    nombre <input type="text" name="usr_nombre" id="usr_nombre"/><br/>
    password<input type ="password" name="usr_password" id="usr_password"/><br/>
    <select name="usr_rol" id="usr_rol">
        <option>administrador</option>
        <option>colaborador</option>
        <option>auditor</option>
    </select><br/>
    <input type="submit" value="enviar"/>
    </form>
    
    <?php
        if($this->session->flashdata('usuario_incorrecto')){
            
        }
    ?>
    <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
    <a href="login/recuperarpassword">Recueparar password</a>
</html>