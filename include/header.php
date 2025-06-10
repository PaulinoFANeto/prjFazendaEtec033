<div class="top-bar">
    <!-- Foi alterado esse arquivo por conta que a forma como estava sendo feito o redirecionamento estava desnecessáriamente longo -Leandro -->
    <!-- Usando a função history.back() ele retorna exatamente para a página que ele saiu, sem necessidade de passar o id toda vez -Leandro -->
    <button class="btn" onclick="history.back()">Voltar</button>
    <h1><?php echo $titulo_pagina; ?></h1>
    <button class="btn" onclick="document.getElementById('modalAjuda').style.display='block'">Ajudar</button>
</div>