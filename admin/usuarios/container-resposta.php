<?php if (isset($_SESSION["resposta"]) && isset($_SESSION["erro"])): ?>
    <div class="container-erro <?= ($_SESSION["erro"] == true) ? "erro" : "sucesso" ?> ativo">
        <p><?= $_SESSION["resposta"] ?></p>
    </div>
<?php endif;
unset($_SESSION["resposta"]);
unset($_SESSION["erro"]);
return; ?>