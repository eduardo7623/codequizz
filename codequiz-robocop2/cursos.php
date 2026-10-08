<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeQuiz - Cursos</title>
    <link rel="stylesheet" href="css/codequiz.css">
</head>
<body>
<?php $pagina = 'cursos'; include 'includes/nav.php'; ?>

<main class="pagina">
    <div class="pagina-topo">
        <h1>Escolha um curso e comece hoje</h1>
        <p>Cada curso reúne explicações, exemplos e quizzes para você praticar.</p>
    </div>

    <?php
    // 'url' => null significa que a página ainda não existe
    $cursos = [
        ['HTML', '🌐', 'Estrutura de páginas web.', null, 'Iniciante'],
        ['CSS', '🎨', 'Cores, layout e responsividade.', null, 'Iniciante'],
        ['JavaScript', '⚡', 'Lógica e interatividade no navegador.', 'editor.php', 'Iniciante'],
        ['PHP', '🐘', 'Programação no servidor, formulários e login.', 'paginaphp.php', 'Intermediário'],
        ['Python', '🐍', 'Lógica de programação com sintaxe simples.', null, 'Iniciante'],
        ['SQL', '🗄️', 'Consultas e bancos de dados.', null, 'Intermediário'],
    ];
    ?>
    <div class="grade">
        <?php foreach ($cursos as [$nome, $icone, $desc, $url, $nivel]): ?>
            <div class="cartao<?= $url ? '' : ' em-breve' ?>">
                <span class="icone"><?= $icone ?></span>
                <h2><?= $nome ?></h2>
                <span class="etiqueta"><?= $nivel ?></span>
                <p><?= $desc ?></p>
                <?php if ($url): ?>
                    <a href="<?= $url ?>" class="botao">Começar</a>
                <?php else: ?>
                    <span class="etiqueta">Em breve</span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
