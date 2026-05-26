<?php
require_once 'config/conexao.php';
require_once 'includes/header.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $fabricante = trim($_POST['fabricante'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';

    if ($nome === '' || $fabricante === '' || $preco === '' || $estoque === '') {
        $erro = 'Preencha todos os campos!';
    } elseif (!is_numeric($preco) || $preco < 0) {
        $erro = 'Preço inválido!';
    } elseif (!is_numeric($estoque) || $estoque < 0) {
        $erro = 'Estoque inválido!';
    } else {
        $stmt = $pdo->prepare("INSERT INTO produtos (nome, fabricante, preco, estoque) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $fabricante, $preco, (int)$estoque]);
        header("Location: index.php?msg=Produto+cadastrado+com+sucesso!");
        exit;
    }
}
?>

<h2>Cadastrar Produto</h2>

<?php if ($erro): ?>
    <div class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<div class="form-card">
    <form method="POST">
        <div class="form-grupo">
            <label>Nome</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-grupo">
            <label>Fabricante</label>
            <input type="text" name="fabricante" required>
        </div>
        <div class="form-grupo">
            <label>Preço</label>
            <input type="number" step="0.01" min="0" name="preco" required>
        </div>
        <div class="form-grupo">
            <label>Estoque</label>
            <input type="number" min="0" name="estoque" required>
        </div>
        <button type="submit" class="btn btn-primario">Salvar</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
