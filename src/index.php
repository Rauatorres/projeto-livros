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
        <a href="index.php" id="header">
            <h1>Projeto Livros</h1>
        </a>
    </header>
    <div id="login-box">
        <h2>Login</h2>
        <hr>
        <form action="login.php" method="post">
            <label for="username">Nome</label>
            <input type="text" id="username" name="username">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Logar">
            <a href="register_page.php" id="register">Criar conta</a>
        </form>
    </div>
</body>
</html>