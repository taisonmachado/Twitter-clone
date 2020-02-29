<?php

    require_once('db.class.php');

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $usuario_existe = false;
    $email_existe = false;

    //verifica se o usuário já existe
    $sql = "select * from usuarios where usuario = '$usuario'";
    if($resultado_id = mysqli_query($link, $sql)){
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['usuario'])){
            $usuario_existe = true;
        }
    }
    else{
        echo "erro ao tentar localizar registro do usuário";
    }

    //verifica se o email já existe
    $sql = "select * from usuarios where email = '$email'";
    if($resultado_id = mysqli_query($link, $sql)){
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['email'])){
            $email_existe = true;
        }
    }
    else{
        echo "erro ao tentar localizar registro do email";
    }

    if($usuario_existe || $email_existe){

        $retorno_get = '';

        if($usuario_existe){
            $retorno_get .= "erro_usuario=1&";
        }
        
        if($email_existe){
            $retorno_get .= "erro_email=1&";
        }

        header('Location: inscrevase.php?'.$retorno_get);
        die();
    }

    $sql = "insert into usuarios(usuario, email, senha) values ('$usuario', '$email', '$senha')";

    if(mysqli_query($link, $sql)){
        echo "usuario registrado com sucesso";
    }else{
        echo "erro ao registrar usuário";
    }
?>