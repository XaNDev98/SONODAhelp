<?php
    ob_start(); // Inicia o buffer de saída

    include '../Sidebar/layout.php';    

    // Configuração de conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sonodahelp";

    // Criar a conexão
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($mysqli->connect_error) {
        die("Conexão falhou: " . $mysqli->connect_error);
    }

    // Adicionar vídeo ao banco de dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura os dados do formulário
        $titulo = $mysqli->real_escape_string($_POST['titulo']);
        $link = $mysqli->real_escape_string($_POST['link']);
        $categoria = $_POST['categoria'];  // Captura a categoria do vídeo
        
        // Insere os dados na tabela de vídeos
        $sql = "INSERT INTO videosweb (titulo, link, categoria) VALUES ('$titulo', '$link', '$categoria')";
        
        if ($mysqli->query($sql) === TRUE) {
            // Redireciona para a página com a mensagem de sucesso
            header("Location: Video_Web.php?success=1");
            exit(); // Não se esqueça de chamar o exit() após o redirecionamento
        } else {
            // Exibe mensagem de erro se falhar
            echo "<div class='alert alert-danger' role='alert'>Erro ao adicionar vídeo: " . $mysqli->error . "</div>";
        }
    }

    // Exemplo de permissão (substitua com o valor real da permissão do usuário)
    $permissao_id = 1; // A permissão 1 é um exemplo. Isso pode vir de uma sessão ou banco de dados.
    
    // REMOVER VÍDEO
    if (isset($_GET['remover'])) {
        $id = intval($_GET['remover']);
        $stmt = $mysqli->prepare("DELETE FROM videosweb WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Evita reenvio do GET após F5
        header("Location: Video_Web.php");
        exit;
    }
?>

<!-- Main Content -->
<div class="content container-fluid">
    <h5 class="font-weight-bold">VÍDEOS - SISTEMA WEB</h5><br>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="#" id="prob_web" data-toggle="tab" onclick="showTab('prob_WEB')">WEB</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="Marca_ponto" data-toggle="tab" onclick="showTab('marcacaoponto')">MARCAÇÃO DE PONTO</a>
        </li>
    </ul>

    <!-- CAMPO DE PESQUISA -->
    <div class="d-flex justify-content-center mb-4">
        <input type="text" class="form-control w-50" id="search-input" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-primary ml-2" onclick="searchContent()">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <div class="tab-content">
        <!-- Conteúdos WEB --> 
        <?php if ($permissao_id == 1): ?>
        <!-- Formulário de Adição de Vídeo (apenas para líder) -->
        <div class="card p-3 mb-4">
            <form method="POST" action="Video_Web.php" class="form-inline">
                <input type="text" name="titulo" class="form-control mr-2 mb-2" placeholder="Título do vídeo" required>
                <input type="text" name="link" class="form-control mr-2 mb-2" placeholder="Link do vídeo" required>
                
                <!-- Novo campo de categoria -->
                <select name="categoria" class="form-control mr-2 mb-2" required>
                    <option value="WEB">WEB</option>
                    <option value="MARCAÇÃO DE PONTO">MARCAÇÃO DE PONTO</option>
                </select>
                
                <button type="submit" class="btn btn-success mb-2">Adicionar Vídeo</button>
            </form>
        </div>
        <?php endif; ?>
        
        <div id="prob_WEB" class="tab-pane active">
            <div id="web" class="tab-pane active"> 
                <div class="command-item" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span style="text-align: center; flex: 1;"><strong>APRESENTAÇÃO SISTEMA WEB</strong></span>
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-primary btn-sm" onclick="copyText('https://www.youtube.com/watch?v=SyJWv-8hkAs', this)"> 
                            <i class="fas fa-copy copy-icon"></i>
                        </button>
                        <button class="btn btn-primary btn-sm ml-2" onclick="window.open('https://www.youtube.com/watch?v=SyJWv-8hkAs', '_blank')"> 
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                </div>

                <!-- Vídeos dinâmicos do banco -->
                <div class="command-list mt-4">
                    <?php
                        // Selecionar vídeos com base na categoria 'WEB'
                        $result = $mysqli->query("SELECT * FROM videosweb WHERE categoria = 'WEB' ORDER BY id DESC");
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <div class="command-item mb-3">
                        <span><strong><?= htmlspecialchars($row['titulo']) ?></strong></span>
                        <div class="d-flex">
                            <!-- Botão Copiar -->
                            <button class="btn btn-primary btn-sm" onclick="copyText('<?= htmlspecialchars($row['link']) ?>', this)">
                                <i class="fas fa-copy copy-icon"></i>
                            </button>
                
                            <!-- Botão Play -->
                            <button class="btn btn-primary btn-sm ml-2" onclick="window.open('<?= htmlspecialchars($row['link']) ?>', '_blank')">
                                <i class="fas fa-play"></i>
                            </button>
                        
                            <?php if ($permissao_id == 1): ?>
                
                                <!-- Botão Remover -->
                                <a href="Video_Web.php?remover=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Tem certeza que deseja remover este vídeo?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        
        <div id="marcacaoponto" class="tab-pane">
            <!-- Similar ao código para WEB, mas com a categoria 'MARCAÇÃO DE PONTO' -->
            <div class="command-list mt-4">
                <?php
                    // Selecionar vídeos com base na categoria 'MARCAÇÃO DE PONTO'
                    $result = $mysqli->query("SELECT * FROM videosweb WHERE categoria = 'MARCAÇÃO DE PONTO' ORDER BY id DESC");
                    while ($row = $result->fetch_assoc()):
                ?>
                <div class="command-item mb-3">
                    <span><strong><?= htmlspecialchars($row['titulo']) ?></strong></span>
                    <div class="d-flex">
                        <!-- Botão Copiar -->
                        <button class="btn btn-primary btn-sm" onclick="copyText('<?= htmlspecialchars($row['link']) ?>', this)">
                            <i class="fas fa-copy copy-icon"></i>
                        </button>
            
                        <!-- Botão Play -->
                        <button class="btn btn-primary btn-sm ml-2" onclick="window.open('<?= htmlspecialchars($row['link']) ?>', '_blank')">
                            <i class="fas fa-play"></i>
                        </button>
                    
                        <?php if ($permissao_id == 1): ?>
                            <!-- Botão Remover -->
                            <a href="Video_Web.php?remover=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Tem certeza que deseja remover este vídeo?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Função para copiar texto
function copyText(text, btn) {
    navigator.clipboard.writeText(text).then(function() {
        btn.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
    });
}

// Função para buscar conteúdo
function searchContent() {
    var input = document.getElementById('search-input');
    var filter = input.value.toLowerCase();
    var items = document.querySelectorAll('.command-item');

    items.forEach(function(item) {
        var title = item.querySelector('span').textContent.toLowerCase();
        if (title.indexOf(filter) > -1) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
