<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia VAV</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topo">
    <h1>💊 Farmácia VAV</h1>
    <nav>
        <a href="index.php" class="<?= $pagina_atual === 'index.php' ? 'ativo' : '' ?>">Estoque</a>
        <a href="cadastro.php" class="<?= $pagina_atual === 'cadastro.php' ? 'ativo' : '' ?>">Cadastrar</a>
    </nav>
</header>
<main class="conteudo">
