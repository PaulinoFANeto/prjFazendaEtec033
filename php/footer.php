<div class="footer">
    <div class="footer-left">
        Usuário: <?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Desconhecido'; ?>
    </div>
    <div class="footer-right">
        Nível de acesso: <?php echo isset($_SESSION['nivel_acesso']) ? htmlspecialchars($_SESSION['nivel_acesso']) : 'Desconhecido'; ?>
    </div>
</div>

<script>
window.onclick = function(event) {
    const modal = document.getElementById('modalAjuda');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
