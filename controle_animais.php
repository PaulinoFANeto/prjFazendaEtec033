<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Animais - Sistema de Fazenda</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="controle-container">
        <h2>Controle de Animais</h2>
        <form action="php/incluir_animais.php" method="POST">
            <label for="animal_name">Nome do Animal:</label>
            <input type="text" id="animal_name" name="animal_name" required>
            <label for="animal_type">Tipo de Animal:</label>
            <input type="text" id="animal_type" name="animal_type" required>
            <button type="submit">Adicionar</button>
        </form>
        <h3>Lista de Animais</h3>
        <?php include("php/listar_animais.php"); ?>
    </div>
</body>
</html>


