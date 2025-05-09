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

// Verificar se a sessão do usuário está ativa
if (isset($_SESSION['usuario'])) {
    $usuarioNome = $_SESSION['usuario']; // Nome do usuário na sessão
    $sql = "SELECT * FROM tecnicos WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuarioNome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Pegar o usuário
        $user = $result->fetch_assoc();
        $nome = $user['nome'];
        $permissao_id = $user['permissao_id'];
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Sessão expirada. Faça login novamente.";
}

$conn->close(); 

// Suponha que $permissao_id já esteja definido
$nomePermissao = 'Sem permissão';
if (isset($permissao_id)) {
    if ($permissao_id == 1) {
        $nomePermissao = 'Líder Técnico';
    } elseif ($permissao_id == 2) {
        $nomePermissao = 'Técnico';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONODA HELP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Ícones -->
    <link rel="stylesheet" href="../Style/Style.css">  
    <link rel="stylesheet" href="../Style/Responsive.css">    
    <link rel="stylesheet" href="../Style/sair.css"> 
    <link rel="stylesheet" href="../Style/efeitos.css">  
    <link rel="stylesheet" href="../Style/darkMode.css">  
    <script src="../JavaScript/darkMode.js" defer></script> 
    <script src="../JavaScript/index.js" defer></script>    
    <link rel="icon" href="../adress/a.png" type="image/x-icon"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> 
</head>

<body>
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="logo">
            <h4 class="m-0">
                <img src="../adress/Sonoda Ponto.ico" alt="logo">  
                <span class="text-primary">SONODA HELP</span>
            </h4>
        </div>
        <div>
            <div>
            <span class="name-container">
            <strong><?php echo $nomePermissao; ?></strong> | 
            <strong><?php echo isset($nome) ? $nome : 'Usuário'; ?></strong>
            <button id="themeToggle" class="theme-toggle" title="Alterar tema">
                <i class="fas fa-sun"></i>
            </button>
            <form action="..\Login\login.php" method="POST" style="display:inline;"> 
            <button type="submit" class="logout-button" title="Sair">
                <i class="fas fa-sign-out-alt"></i> 
            </button>
            </form>
        </span>
            </div>            
        </div>
    </div>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="position: relative;">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="instaladores.php" class="nav-link active"><i class="fas fa-home"></i> Home</a></li> 
                <li class="nav-item">
                    <a href="#" class="nav-link" id="video-link" onclick="toggleMenu('video', event)">
                        <i class="fas fa-video"></i> Vídeo 
                        <i class="fas fa-chevron-down" id="video-arrow"></i>
                    </a>
                    <ul id="video-submenu" class="nav flex-column" style="display: none;">
                        <li class="nav-item"><a href="../Videos/Videos_OFF.php" class="nav-link" onclick="keepMenuOpen(event)">Sistema Offline</a></li>
                        <li class="nav-item"><a href="../Videos/Video_Web.php" class="nav-link" onclick="keepMenuOpen(event)">Sistema Web</a></li>
                        <li class="nav-item"><a href="../Videos/Videos_AcadAcesso.html" class="nav-link" onclick="keepMenuOpen(event)">Demais Sistemas</a></li>
                    </ul>
                </li> 
                <li class="nav-item">
                    <a href="#" class="nav-link" id="relogios-link" onclick="toggleMenu('relogios', event)">
                        <i class="fas fa-clock"></i> Relógios 
                        <i class="fas fa-chevron-down" id="relogios-arrow"></i>
                    </a>
                    <ul id="relogios-submenu" class="nav flex-column" style="display: none;">
                        <li class="nav-item"><a href="../Rep/Control_id.html" class="nav-link" onclick="keepMenuOpen(event)">Control ID</a></li>
                        <li class="nav-item"><a href="../Rep/Smartpoint.html" class="nav-link" onclick="keepMenuOpen(event)">Smart Point</a></li>
                        <li class="nav-item"><a href="../Rep/Miniprint.html" class="nav-link" onclick="keepMenuOpen(event)">Miniprint</a></li> 
                        <li class="nav-item"><a href="../Rep/Printpoint2.html" class="nav-link" onclick="keepMenuOpen(event)">PrintPoint 2</a></li>
                        <li class="nav-item"><a href="../Rep/Printpoint3.html" class="nav-link" onclick="keepMenuOpen(event)">PrintPoint 3</a></li>
                        <li class="nav-item"><a href="../Rep/Outros.html" class="nav-link" onclick="keepMenuOpen(event)">Outros</a></li>
                    </ul>
                </li> 
                <li class="nav-item">
                    <a href="#" class="nav-link" id="checklist-link" onclick="toggleMenu('checklist', event)">
                        <i class="fas fa-check"></i> Checklist 
                        <i class="fas fa-chevron-down" id="checklist-arrow"></i>
                    </a>
                    <ul id="checklist-submenu" class="nav flex-column" style="display: none;">
                        <li class="nav-item"><a href="../Treinamento/Sistema_OFF.html" class="nav-link" onclick="keepMenuOpen(event)">Sistema Offline</a></li>
                        <li class="nav-item"><a href="../Treinamento/Sistema_WEB.html" class="nav-link" onclick="keepMenuOpen(event)">Sistema Web</a></li>
                        <li class="nav-item"><a href="../Treinamento/Sistema_acad_acess_escola.html" class="nav-link" onclick="keepMenuOpen(event)">Demais Sistemas</a></li>
                        <li class="nav-item"><a href="../Treinamento/treinamento_geral.html" class="nav-link" onclick="keepMenuOpen(event)">Treinamento Geral</a></li>
                    </ul>
                </li>  
                <li class="nav-item"><a href="../Sidebar/Resoluçao.html" class="nav-link"><i class="fas fa-lightbulb"></i> Resoluções</a></li> 
                <li class="nav-item"><a href="../Sidebar/comercial.html" class="nav-link"><i class="fas fa-coins"></i> Comercial</a></li>
                <li class="nav-item"><a href="../Sidebar/calculadora.html" class="nav-link"><i class="fas fa-calculator"></i> Calculadora</a></li>  
                <li class="nav-item"><a href="../Sidebar/atualizações.php" class="nav-link"><i class="fas fa-sync"></i> Atualizações</a></li>                     
                <li class="nav-item"><a href="https://sonodaponto.com.br/pis/" target="_blank" class="nav-link"><i class="fas fa-file-alt"></i> Gerar PIS</a></li> 
            </ul>
            
            <!-- "Mensagens" fixado na parte inferior da sidebar -->
            <div class="position-absolute" style="bottom: 5px; margin-right: -5px;">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="../Sidebar/Mensagens.html" class="nav-link"><i class="fas fa-comment"></i> Mensagens</a></li>
                </ul>
            </div>
        </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>  
</body>
</html>
