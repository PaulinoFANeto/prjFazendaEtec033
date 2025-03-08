<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal - Sistema de Fazenda</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="editar-container">
        <h2>Editar Animal</h2>
        <?php
            include 'buscar_animal.php';
        ?>
        <form action="atualizar_animal.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
            <label for="animal_name">Nome do Animal:</label>
            <input type="text" id="animal_name" name="animal_name" value="<?php echo $animal['animal_name']; ?>" required>
            <label for="animal_type">Tipo de Animal:</label>
            <input type="text" id="animal_type" name="animal_type" value="<?php echo $animal['animal_type']; ?>" required>
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>