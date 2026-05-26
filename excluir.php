<?php
require_once 'config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php?erro=ID+inválido");
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM produtos WHERE id = ?");
$stmt->execute([$id]);

if (!$stmt->fetch()) {
    header("Location: index.php?erro=Produto+não+encontrado");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php?msg=Produto+excluído+com+sucesso!");
exit;
