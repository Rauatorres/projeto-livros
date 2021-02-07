<?php

// Conexão com banco de dados
try{
    $db = new PDO("mysql:host=localhost", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch (PDOexception $e){
    echo "Não foi possível conectar ao banco de dados - ".$e->getMessage();
}catch (Exception $e){
    echo "Erro - ".$e->getMessage();
}

// Recebendo o nome de usuário e a senha através do método post
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

//Fazendo cadastro
try{
    // Inserindo O usuário 
    $userRegisterDB = "USE PROJETO_LIVROS_USUARIOS;";
    $db->exec($userRegisterDB);
    $addUser = $db->prepare("INSERT INTO USUARIO(USERNAME, PASSWD, EMAIL)
                            VALUES(:user, :passwd, :email);");
    $addUser->bindValue(":user", $username);
    $addUser->bindValue(":passwd", $password);
    $addUser->bindValue(":email", $email);
    $addUser->execute();
    $creatingUserDatabase = "CREATE DATABASE $username;
                                USE $username;
                            ";
    $db->exec($creatingUserDatabase);
    echo "Usuário registrado com sucesso!";
    header("Location: main.php");
}catch (PDOexception $e){
    $usernameQuery = $db->prepare("SELECT * FROM USUARIO WHERE USERNAME = :username");
    $usernameQuery->bindValue(':username', $username);
    $usernameQuery->execute();
    $usernameExists = $usernameQuery->fetch();
    if ($usernameExists){
        echo "O nome de usuário já existe";
    }else{
        $emailQuery = $db->prepare("SELECT * FROM USUARIO WHERE EMAIL = :email");
        $emailQuery->bindValue(':email', $email);
        $emailQuery->execute();
        $emailExists = $usernameQuery->fetch();
        if ($emailExists){
            echo "Já existe um usuário cadastrado neste email";
        }else{
            echo "Caracteres de nome de usuário inválido";
        }
    }
}


