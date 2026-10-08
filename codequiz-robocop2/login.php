<?php
session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $erro = 'Digite um e-mail válido.';

    } elseif ($senha === '') {

        $erro = 'Digite sua senha.';

    } elseif (!isset($_SESSION['usuario'])) {

        $erro = 'Nenhuma conta foi cadastrada nesta sessão.';

    } else {

        $usuario = $_SESSION['usuario'];

        if (
            $email === $usuario['email'] &&
            password_verify($senha, $usuario['senha'])
        ) {

            $_SESSION['logado'] = true;
            $_SESSION['usuario_nome'] = $usuario['nome'];

            header('Location: index.php');
            exit;

        } else {

            $erro = 'E-mail ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CodeQuiz - Entrar</title>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <main class="container">

        <div class="form-box">

            <h1>Entrar</h1>

            <p>Entre na sua conta para continuar aprendendo.</p>

            <?php if ($erro): ?>

                <p class="erro">
                    <?= htmlspecialchars($erro) ?>
                </p>

            <?php endif; ?>

            <form method="post">

                <label for="email">E-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required
                >

                <label for="senha">Senha</label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >

                <button type="submit">
                    Entrar
                </button>

            </form>

            <p>
                Ainda não possui uma conta?
                <a href="cadastro.php">Criar conta</a>
            </p>

        </div>

    </main>

</body>

</html>
