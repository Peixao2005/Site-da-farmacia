<?php
require_once 'config/conexao.php';
require_once 'includes/header.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php?erro=ID+inválido");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header("Location: index.php?erro=Produto+não+encontrado");
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $fabricante = trim($_POST['fabricante'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';

    if ($nome === '' || $fabricante === '' || $preco === '' || $estoque === '') {
        $erro = 'Preencha todos os campos!';
    } else {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, fabricante = ?, preco = ?, estoque = ? WHERE id = ?");
        $stmt->execute([$nome, $fabricante, $preco, (int)$estoque, $id]);
        header("Location: index.php?msg=Produto+atualizado+com+sucesso!");
        exit;
    }
}
?>

<h2>Editar Produto</h2>

<?php if ($erro): ?>
    <div class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="form-grupo">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </div>
        <div class="form-grupo">
            <label>Fabricante</label>
            <input type="text" name="fabricante" value="<?= htmlspecialchars($produto['fabricante']) ?>" required>
        </div>
        <div class="form-grupo">
            <label>Preço</label>
            <input type="number" step="0.01" min="0" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
        </div>
        <div class="form-grupo">
            <label>Estoque</label>
            <input type="number" min="0" name="estoque" value="<?= htmlspecialchars($produto['estoque']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primario">Salvar alterações</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
