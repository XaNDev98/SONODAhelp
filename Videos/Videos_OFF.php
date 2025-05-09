<?php
ob_start();
include '../Sidebar/layout.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sonodahelp";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $mysqli->real_escape_string($_POST['titulo']);
    $link = $mysqli->real_escape_string($_POST['link']);
    $categoria = $mysqli->real_escape_string($_POST['categoria']);

    $sql = "INSERT INTO videosoff (titulo, link, categoria) VALUES ('$titulo', '$link', '$categoria')";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: Videos_OFF.php?success=1");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Erro ao adicionar vídeo: " . $mysqli->error . "</div>";
    }
}

$permissao_id = 1;

if (isset($_GET['remover'])) {
    $id = intval($_GET['remover']);
    $stmt = $mysqli->prepare("DELETE FROM videosoff WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: Videos_OFF.php");
    exit;
}
?>

<!-- HTML -->
<div class="content container-fluid">
    <h5 class="font-weight-bold">VÍDEOS - SISTEMA OFF</h5><br>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab_off">OFF</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab_outros">OUTROS</a>
        </li>
    </ul>

    <div class="d-flex justify-content-center mb-4">
        <input type="text" class="form-control w-50" id="search-input" placeholder="Buscar...">
        <button class="btn btn-primary ml-2" onclick="searchContent()">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <?php if ($permissao_id == 1): ?>
    <div class="card p-3 mb-4">
        <form method="POST" action="Videos_OFF.php" class="form-inline">
            <input type="text" name="titulo" class="form-control mr-2 mb-2" placeholder="Título do vídeo" required>
            <input type="text" name="link" class="form-control mr-2 mb-2" placeholder="Link do vídeo" required>
            <select name="categoria" class="form-control mr-2 mb-2" required>
                <option value="OFF">OFF</option>
                <option value="OUTROS">OUTROS</option>
            </select>
            <button type="submit" class="btn btn-success mb-2">Adicionar Vídeo</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="tab-content">
        <!-- TAB OFF -->
        <div class="tab-pane fade show active" id="tab_off">
            <div class="command-list mt-4">
                <?php
                $result = $mysqli->query("SELECT * FROM videosoff WHERE categoria = 'OFF' ORDER BY id DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                <div class="command-item mb-3">
                    <span><strong><?= htmlspecialchars($row['titulo']) ?></strong></span>
                    <div class="d-flex">
                        <button class="btn btn-primary btn-sm" onclick="copyText('<?= htmlspecialchars($row['link']) ?>', this)">
                            <i class="fas fa-copy copy-icon"></i>
                        </button>
                        <button class="btn btn-primary btn-sm ml-2" onclick="window.open('<?= htmlspecialchars($row['link']) ?>', '_blank')">
                            <i class="fas fa-play"></i>
                        </button>
                        <?php if ($permissao_id == 1): ?>
                        <a href="Videos_OFF.php?remover=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Remover este vídeo?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- TAB OUTROS -->
        <div class="tab-pane fade" id="tab_outros">
            <div class="command-list mt-4">
                <?php
                $result = $mysqli->query("SELECT * FROM videosoff WHERE categoria = 'OUTROS' ORDER BY id DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                <div class="command-item mb-3">
                    <span><strong><?= htmlspecialchars($row['titulo']) ?></strong></span>
                    <div class="d-flex">
                        <button class="btn btn-primary btn-sm" onclick="copyText('<?= htmlspecialchars($row['link']) ?>', this)">
                            <i class="fas fa-copy copy-icon"></i>
                        </button>
                        <button class="btn btn-primary btn-sm ml-2" onclick="window.open('<?= htmlspecialchars($row['link']) ?>', '_blank')">
                            <i class="fas fa-play"></i>
                        </button>
                        <?php if ($permissao_id == 1): ?>
                        <a href="Videos_OFF.php?remover=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Remover este vídeo?')">
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
// Copiar texto
function copyText(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        btn.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
    });
}

// Pesquisar vídeos
function searchContent() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const items = document.querySelectorAll('.command-item');
    items.forEach(item => {
        const title = item.querySelector('span').textContent.toLowerCase();
        item.style.display = title.includes(input) ? '' : 'none';
    });
}
</script>
