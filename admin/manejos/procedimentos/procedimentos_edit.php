<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Procedimento</title>
</head>
<body>
    <button class="voltar-btn" onclick="window.history.back();">← Voltar</button>

    <h1>Editar Procedimento</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
        <label for="nome">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo htmlspecialchars($row['descricao']); ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>