<?php
session_start();

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sonodahelp"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o valor de 'username' e 'password' do formulário, ou um valor vazio se não existir
    $usuario = $_POST['username'] ?? '';
    $senha = $_POST['password'] ?? '';

    // Converte para minúsculas e armazena em variáveis
    $usuarioLower = strtolower($usuario);

    // Prepara a consulta para verificar o usuário e senha (ignora maiúsculas/minúsculas)
    $sql = "SELECT * FROM tecnicos WHERE (LOWER(email) = ? OR LOWER(nome) = ?) AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $usuarioLower, $usuarioLower, $senha); // Passa a variável convertida para minúsculas
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário e a senha são válidos
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['usuario'] = $user['nome']; // Armazenar nome do usuário na sessão
        $_SESSION['permissao_id'] = $user['permissao_id']; // Armazenar permissões na sessão
        header("Location: ../Sidebar/instaladores.php"); // Redireciona para a página desejada
        exit();
    } else {
        // Se usuário ou senha forem inválidos
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login - Sonoda</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <img src="img/logo.png" alt="Logo Sonoda" class="logo">
        <h2>Login - Sonoda</h2>
        <form method="POST">
            <div class="input-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite seu usuário ou e-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <?php if (isset($erro)): ?>
                <p class="erro" style="color: red;"><?= $erro; ?></p>
            <?php endif; ?>
            <div class="remember-container">
                <input type="checkbox" id="rememberMe">
                <label for="rememberMe">Lembrar senha</label>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-admin">Entrar</button>
            </div>
        </form>
    </div> 
</body>
</html>
