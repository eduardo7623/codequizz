```php
<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

$nome = $_SESSION['usuario_nome'];
$email = $_SESSION['usuario']['email'];

// Valores iniciais
$xp = 0;
$energia = 5;
$medalhas = 0;
$progresso = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CodeQuiz - Minha Conta</title>

    <link rel="stylesheet" href="css/usuario.css">
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <main class="usuario-container">

        <section class="perfil">

            <div class="avatar">
                👤
            </div>

            <div>
                <h1>Olá, <?= htmlspecialchars($nome) ?>!</h1>
                <p><?= htmlspecialchars($email) ?></p>
            </div>

        </section>


        <section class="estatisticas">

            <div class="card">
                <span>⭐</span>
                <h2><?= $xp ?></h2>
                <p>XP</p>
            </div>

            <div class="card">
                <span>⚡</span>
                <h2><?= $energia ?></h2>
                <p>Energia</p>
            </div>

            <div class="card">
                <span>🏆</span>
                <h2><?= $medalhas ?></h2>
                <p>Medalhas</p>
            </div>

            <div class="card">
                <span>📊</span>
                <h2><?= $progresso ?>%</h2>
                <p>Progresso</p>
            </div>

        </section>


        <section class="progresso">

            <h2>Meu progresso</h2>

            <p>Progresso dos cursos</p>

            <div class="barra">
                <div class="barra-preenchida"
                     style="width: <?= $progresso ?>%;">
                </div>
            </div>

            <p><?= $progresso ?>% concluído</p>

        </section>


        <section class="acoes">

            <h2>Minha conta</h2>

            <a href="cursos.php">
                📚 Meus cursos
            </a>

            <a href="quiz.php">
                🧠 Fazer quiz
            </a>

            <a href="editor.php">
                💻 Editor
            </a>

            <a href="logout.php">
                🚪 Sair da conta
            </a>

        </section>

    </main>

</body>

</html>
```
