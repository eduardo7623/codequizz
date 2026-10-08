<?php
// Uso: $pagina = 'editor'; include 'includes/nav.php';
$pagina = $pagina ?? '';
$links = [
    'home'        => ['home.php', 'Início'],
    'cursos'      => ['cursos.php', 'Cursos'],
    'services'    => ['services.php', 'Services'],
    'quiz'        => ['quiz.php', 'Quiz'],
    'editor'      => ['editor.php', 'Editor'],
    'assinaturas' => ['assinaturas.php', 'Planos'],
    'contato'     => ['contato.php', 'Contato'],
];
?>
<header class="topo">
    <nav class="navbar">
        <a href="home.php" class="logo"><img src="./img/code-quiz.png" alt="CodeQuiz"></a>
        <ul>
            <?php foreach ($links as $chave => [$url, $texto]): ?>
                <li><a href="<?= $url ?>"<?= $chave === $pagina ? ' class="ativo" aria-current="page"' : '' ?>><?= $texto ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a href="cadastro.php" class="botao botao-sm">Criar conta</a>
    </nav>
</header>
