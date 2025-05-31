<div id="modalAjuda" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('modalAjuda').style.display='none'">×</span>
        <h2><?php echo isset($titulo_ajuda) ? $titulo_ajuda : 'Ajuda'; ?></h2>
        <p><?php echo isset($descricao_ajuda) ? $descricao_ajuda : ''; ?></p>
        <ul>
            <?php if (!empty($itens_ajuda)): ?>
                <?php foreach ($itens_ajuda as $item): ?>
                    <li><strong><?php echo $item['titulo']; ?></strong>: <?php echo $item['descricao']; ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <p><?php echo isset($observacao_ajuda) ? $observacao_ajuda : ''; ?></p>
    </div>
</div>
