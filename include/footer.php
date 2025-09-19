<div class="footer">
    <div class="footer-left">
        Usuário: <?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Desconhecido'; ?>
    </div>
    <div class="footer-right">
        Nível de acesso:
        <?php
            if (isset($_SESSION['nivel_acesso'])) {
                switch ($_SESSION['nivel_acesso']) {
                    case 0:
                        echo 'Administrador';
                        break;
                    case 1:
                        echo 'Docente';
                        break;
                    case 2:
                        echo 'Auxiliar';
                        break;
                    case 3:
                        echo 'Aluno';
                        break;
                    default:
                        echo 'Desconhecido';
                }
            } else {
                echo 'Desconhecido';
            }
        ?>
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

