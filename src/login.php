<?php

// Recebendo o nome de usuário e a senha através do método post
$username = $_POST['username'];
$password = $_POST['password'];

// Conexão com banco de dados
try{
    // Conexão com o banco específico do usuário
    $userDB = new PDO("mysql:dbname=".$username.";host=localhost", "root", "");
    $userDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Conexão com o banco de login
    $loginDB = new PDO("mysql:dbname=projeto_livros_usuarios;host=localhost", "root", "");
    $loginDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $loginDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    // Verificação de senha

    // a) capturando a senha do usuário registrado no banco de dados de usuários e transformando em uma string - $userPassword
    $gettingUserPassword = $loginDB->prepare("SELECT PASSWD FROM USUARIO WHERE USERNAME = :username");
    $gettingUserPassword->bindValue(":username", $username);
    $gettingUserPassword->execute();
    $userPasswordList = $gettingUserPassword->fetch(PDO::FETCH_ASSOC);
    $userPassword = $userPasswordList['PASSWD'];
    // b) verificando se a senha digitada ($password) é igual à senha capturada do banco de dados de usuários ($userPassword)
    if ($userPassword == $password){
        echo "Login realizado com sucesso!";
        header("Location: main.php");
    }else{
        throw new PDOexception('Senha incorreta');
    }

}catch (PDOexception $e){
    $errorMessage = $e->getMessage();
    if ($errorMessage == "SQLSTATE[HY000] [1049] Unknown database '".$username."host=localhost'"){
        echo "Não foi possível fazer login - Usuário não identificado";
    }elseif ($errorMessage == 'Senha incorreta'){
        echo "Não foi possível fazer login - $errorMessage";
    }else{
        echo "Não foi possível fazer login - ".$e->getMessage();
    }
}catch (Exception $e){
    echo "Erro - ".$e->getMessage();
}

