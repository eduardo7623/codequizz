<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeQuiz - Editor JavaScript</title>
    <link rel="stylesheet" href="css/codequiz.css">
</head>
<body>
<?php $pagina = 'editor'; include 'includes/nav.php'; ?>

<main class="pagina">
    <div class="pagina-topo">
        <h1>Editor de JavaScript</h1>
        <p>Escreva o código, execute no navegador e veja na hora se passou nos testes.</p>
    </div>

    <div class="editor">
        <aside>
            <div class="desafios" id="lista"></div>
            <div class="enunciado">
                <h2 id="titulo-desafio"></h2>
                <p id="enunciado"></p>
            </div>
            <div class="enunciado">
                <div class="barra"><i id="progresso" style="width:0"></i></div>
                <p id="progresso-texto" style="margin-top:8px"></p>
            </div>
        </aside>

        <section class="area">
            <label for="codigo" class="etiqueta">Seu código</label>
            <textarea id="codigo" spellcheck="false" autocomplete="off"></textarea>
            <div class="acoes">
                <button class="botao" id="executar" type="button">Executar</button>
                <button class="botao botao-contorno" id="resetar" type="button">Recomeçar</button>
                <small>Ctrl + Enter também executa</small>
            </div>
            <div class="saida" id="saida" aria-live="polite"></div>
        </section>
    </div>
</main>

<script src="js/editor.js"></script>
</body>
</html>
