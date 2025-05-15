<div class="footer">
    <div class="footer-left">
        Usuário: <?php echo htmlspecialchars($_SESSION['usuario']); ?>
    </div>
    <div class="footer-right">
        Nível de acesso: <?php echo htmlspecialchars($_SESSION['nivel_acesso']); ?>
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
