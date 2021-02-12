
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
    <header>
        <a href="main.php" id="home-title" class="header-tabs">Projeto Livros</a>
        <div id="header-config-tabs">
            <a href="#" class="header-tabs">Configurar Biblioteca</a>
            <a href="#" class="header-tabs">Configurações de Conta</a>
        </div>
    </header>
    <nav>
        <ul id="selection-list">
            <li>
                <div id="categorias-container" onmouseover="showCategorias()" onmouseout="hideCategorias()">
                    <div class="selection-items" id="categorias-selection">Categorias</div>
                    <div class="items-box" id="categorias-box">
                        <a href="" class="items">Todas</a>
                        <a href="" class="items">Teste</a>
                    </div>
                </div>
            </li>
            <li>
                <div id="livros-container" onmouseover="showLivros()" onmouseout="hideLivros()">
                    <div class="selection-items" id="livros-selection">Livros</div>
                    <div class="items-box" id="livros-box">
                            <a href="" class="items">Todos</a>
                            <a href="" class="items">Teste</a>
                    </div>
                </div>
            </li>
            <li>
                <div id="autores-container" onmouseover="showAutores()" onmouseout="hideAutores()">
                    <div class="selection-items" id="autores-selection">Autores</div>
                    <div class="items-box" id="autores-box">
                            <a href="" class="items">Todos</a>
                            <a href="" class="items">Teste</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <section>
        <div id="add-buttons-box">
            <a href="" class="add-buttons" id="add-livro"><i class="fas fa-plus"></i><span>Adicionar Livro</span> </a>
            <a href="" class="add-buttons" id="add-categoria"><i class="fas fa-plus"></i><span>Adicionar Categoria</span> </a>
            <a href="" class="add-buttons" id="add-autor"><i class="fas fa-plus"></i><span>Adicionar Autor</span></a>
        </div>
    </section>
</body>
</html>