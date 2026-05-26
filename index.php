<?php
require_once 'config/conexao.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome ASC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Estoque de Produtos</h2>

<?php if (isset($_GET['msg'])): ?>
    <div class="alerta alerta-sucesso"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
    <div class="alerta alerta-erro"><?= htmlspecialchars($_GET['erro']) ?></div>
<?php endif; ?>

<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>

    <?php foreach ($produtos as $p): ?>
        <div class="card">
            <p><strong>Nome:</strong> <?= htmlspecialchars($p['nome']) ?></p>
            <p><strong>Fabricante:</strong> <?= htmlspecialchars($p['fabricante']) ?></p>
            <p><strong>Preço:</strong> R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
            <p><strong>Estoque:</strong> <?= $p['estoque'] ?></p>
            <div class="acoes">
                <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-editar">Editar</a>
                <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-excluir" onclick="return confirm('Excluir este produto?')">Excluir</a>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="tabela-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['fabricante']) ?></td>
                        <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                        <td><?= $p['estoque'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-editar">Editar</a>
                            <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-excluir" onclick="return confirm('Excluir este produto?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
