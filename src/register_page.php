<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login_register_screen.css">
</head>
<body>
    <header>
        <a href="index.php" id="header"><h1>Projeto Livros</h1></a>
    </header>
    
    <div id="register-box">
        <h2>Cadastrar</h2>
        <hr>
        <form action="register.php" method="post" id="register-form">
            <label for="username">Nome</label>
            <input type="text" id="username" name="username">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <input type="submit" value="Cadastrar" id="register-button">
            <a href="index.php" id="login">Voltar para a tela de login</a>
        </form>
    </div>
</body>
</html>