<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Configurações</title>
</head>
<body>
    <h1>Configurações do Sistema</h1>

    <h2>Opções de Acessibilidade</h2>
    <form method="POST">
        <label for="acessibilidade">Modo de acessibilidade:</label>
        <select name="acessibilidade" id="acessibilidade">
            <option value="padrão" <?php echo (isset($_SESSION['acessibilidade']) && $_SESSION['acessibilidade'] === 'padrão') ? 'selected' : ''; ?>>Padrão</option>
            <option value="alto-contraste" <?php echo (isset($_SESSION['acessibilidade']) && $_SESSION['acessibilidade'] === 'alto-contraste') ? 'selected' : ''; ?>>Alto Contraste</option>
            <option value="fonte-grande" <?php echo (isset($_SESSION['acessibilidade']) && $_SESSION['acessibilidade'] === 'fonte-grande') ? 'selected' : ''; ?>>Fonte Grande</option>
        </select>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
