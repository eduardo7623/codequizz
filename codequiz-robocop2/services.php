<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeQuiz - Services</title>
    <link rel="stylesheet" href="css/codequiz.css">
</head>
<body>
<?php $pagina = 'services'; include 'includes/nav.php'; ?>

<main class="pagina">
    <div class="pagina-topo">
        <h1>Tudo o que você usa para aprender</h1>
        <p>Conteúdo, prática e acompanhamento no mesmo lugar.</p>
    </div>

    <?php
    $servicos = [
        ['📚', 'Cursos', 'Aulas curtas sobre HTML, CSS, JavaScript, PHP e mais.', 'cursos.php', 'Ver cursos', true],
        ['🎯', 'Quiz', 'Responda perguntas e receba feedback na hora.', 'quiz.php', 'Fazer um quiz', true],
        ['⌨️', 'Editor interativo', 'Escreva JavaScript e rode testes direto no navegador.', 'editor.php', 'Abrir editor', true],
        ['⭐', 'Planos', 'Do plano grátis ao vitalício: escolha o seu.', 'assinaturas.php', 'Comparar planos', true],
        ['🏆', 'Ranking', 'Compare sua pontuação com outros alunos.', '#', 'Em breve', false],
        ['💬', 'Suporte', 'Dúvidas ou sugestões? Fale com a equipe.', 'contato.php', 'Falar com a gente', true],
    ];
    ?>
    <div class="grade">
        <?php foreach ($servicos as [$icone, $nome, $desc, $url, $acao, $ativo]): ?>
            <div class="cartao<?= $ativo ? '' : ' em-breve' ?>">
                <span class="icone"><?= $icone ?></span>
                <h2><?= $nome ?></h2>
                <p><?= $desc ?></p>
                <?php if ($ativo): ?>
                    <a href="<?= $url ?>" class="botao"><?= $acao ?></a>
                <?php else: ?>
                    <span class="etiqueta"><?= $acao ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
