<div class="top-bar">
    <?php
        $voltar_para = isset($_GET['from']) ? $_GET['from'] : 'index.php';
        $voltar_para = htmlspecialchars($voltar_para); // segurança extra
    ?>
    <button class="btn" onclick="window.location.href='<?php echo $voltar_para; ?>'">Voltar</button>
    <h1><?php echo $titulo_pagina; ?></h1>
    <button class="btn" onclick="document.getElementById('modalAjuda').style.display='block'">Ajudar</button>
</div>
