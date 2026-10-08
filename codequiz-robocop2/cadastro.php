```php
<?php
session_start();

$erro = '';
$ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $erro = 'Digite um e-mail válido.';

    } elseif (strlen($senha) < 6) {

        $erro = 'A senha precisa ter pelo menos 6 caracteres.';

    } elseif ($nome === '') {

        $erro = 'Digite seu nome.';

    } else {

        // Guarda os dados na sessão
        $_SESSION['usuario'] = [
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT)
        ];

        $ok = 'Conta criada com sucesso!';

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>CodeQuiz - Criar conta</title>

    <link rel="stylesheet" href="css/codequiz.css">

</head>

<body>

    <main class="pagina">

        <div class="caixa-form">

            <h1>Criar conta</h1>

            <p class="subtitulo">
                Crie sua conta e comece a aprender programação.
            </p>


            <?php if ($erro): ?>

                <div class="aviso erro">
                    <?= htmlspecialchars($erro) ?>
                </div>

            <?php endif; ?>


            <?php if ($ok): ?>

                <div class="aviso ok">
                    <?= htmlspecialchars($ok) ?>
                </div>

            <?php endif; ?>


            <form method="POST">

                <label for="nome">
                    Nome
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($nome ?? '') ?>"
                    required
                >


                <label for="email">
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email ?? '') ?>"
                    required
                >


                <label for="senha">
                    Senha
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    minlength="6"
                    required
                >


                <button type="submit" class="botao">
                    Criar conta
                </button>

            </form>


            <p class="rodape">

                Já tem conta?

                <a href="login.php">
                    Entrar
                </a>

            </p>

        </div>

    </main>

</body>

</html>
```
