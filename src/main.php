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
    if ($userPassword != $password){
        throw new PDOexception('Senha incorreta');
    }

    

}catch (PDOexception $e){
    $errorMessage = $e->getMessage();
    if ($errorMessage == "SQLSTATE[HY000] [1049] Unknown database '".$username."host=localhost'" || $errorMessage == "SQLSTATE[HY000] [1049] Unknown database '".$username."'"){
        echo "Não foi possível fazer login - Usuário não identificado";
    }elseif ($errorMessage == 'Senha incorreta'){
        echo "Não foi possível fazer login - $errorMessage";
    }else{
        echo "Não foi possível fazer login - ".$e->getMessage();
    }
}catch (Exception $e){
    echo "Erro - ".$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/main_header_nav.css">
    <link rel="stylesheet" href="css/main_content.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <script src="js/main_style.js"></script>
</head>
<body>
    <?php
        // Criando as tabelas caso elas não existam
        $creatingTablesUserDB = $userDB->exec("CREATE TABLE IF NOT EXISTS CATEGORIA(
                                                    ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                    NOME varchar(100) NOT NULL,
                                                    ID_CATEGORIA int NULL,
                                                    FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIA(ID)
                                                );
                                                CREATE TABLE IF NOT EXISTS LIVRO(
                                                    ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                    TITULO varchar(100) NOT NULL,
                                                    AUTOR varchar(100) NOT NULL,
                                                    DESCRICAO text NULL,
                                                    ID_CATEGORIA int NULL,
                                                    FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIA(ID)
                                                );
                                                CREATE TABLE IF NOT EXISTS SUBDIVISAO(
                                                    ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                    NOME varchar(100) NULL,
                                                    PAG_INICIAL int NULL,
                                                    PAG_FINAL int NULL,
                                                    DESCRICAO text NULL,
                                                    ID_LIVRO int NOT NULL,
                                                    ID_SUBDIVISAO int NULL,
                                                    FOREIGN KEY (ID_LIVRO) REFERENCES LIVRO(ID),
                                                    FOREIGN KEY (ID_SUBDIVISAO) REFERENCES SUBDIVISAO(ID)
                                                )");

    ?>
    <header>
        <a href="main.php" id="home-title" class="header-tabs">Projeto Livros</a>
        <div id="header-config-tabs">
            <a href="#" class="header-tabs">Configurar Biblioteca</a>
            <a href="#" class="header-tabs">Configurações de Conta</a>
        </div>
    </header>

    <?php
        // Extraindo as categorias, os livros e os autores do banco de dados
        $selectCategorias = $userDB->prepare("SELECT NOME FROM CATEGORIA ORDER BY NOME");
        $selectLivros = $userDB->prepare("SELECT TITULO FROM LIVRO ORDER BY TITULO");
        $selectAutores = $userDB->prepare("SELECT DISTINCT AUTOR FROM LIVRO ORDER BY AUTOR");
        $selectCategorias->execute();
        $selectLivros->execute();
        $selectAutores->execute();
        $categorias = $selectCategorias->fetchAll(PDO::FETCH_ASSOC);
        $livros = $selectLivros->fetchAll(PDO::FETCH_ASSOC);
        $autores = $selectAutores->fetchAll(PDO::FETCH_ASSOC);
    ?>                                            

    <nav>
        <ul id="selection-list">
            <li>
                <div id="categorias-container" onmouseover="showCategorias()" onmouseout="hideCategorias()">
                    <div class="selection-items" id="categorias-selection">Categorias</div>
                    <div class="items-box" id="categorias-box">
                        <a href="" class="items">Todas</a>
                        <?php
                            // aba categorias
                            for($index = 0; $index < count($categorias); $index++){
                                echo '<a href="" class="items">'.$categorias[$index]['NOME'].'</a>';
                            }
                        ?>
                    </div>
                </div>
            </li>
            <li>
                <div id="livros-container" onmouseover="showLivros()" onmouseout="hideLivros()">
                    <div class="selection-items" id="livros-selection">Livros</div>
                    <div class="items-box" id="livros-box">
                        <a href="" class="items">Todos</a>
                        <?php
                            // aba livros
                            for($index = 0; $index < count($livros); $index++){
                                echo '<a href="" class="items">'.$livros[$index]['TITULO'].'</a>';
                            }
                        ?>
                    </div>
                </div>
            </li>
            <li>
                <div id="autores-container" onmouseover="showAutores()" onmouseout="hideAutores()">
                    <div class="selection-items" id="autores-selection">Autores</div>
                    <div class="items-box" id="autores-box">
                            <a href="" class="items">Todos</a>
                            <?php
                                // aba autores
                                for($index = 0; $index < count($autores); $index++){
                                    echo '<a href="" class="items">'.$autores[$index]['AUTOR'].'</a>';
                                }
                            ?>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <section>
        <div id="add-buttons-box">
            <a href="" class="add-buttons" id="add-livro"><i class="fas fa-plus"></i><span>Adicionar Livro</span> </a>
            <a href="" class="add-buttons" id="add-categoria"><i class="fas fa-plus"></i><span>Adicionar Categoria</span> </a>
            <!-- <a href="" class="add-buttons" id="add-autor"><i class="fas fa-plus"></i><span>Adicionar Autor</span></a> -->
        </div>
    </section>
</body>
</html>