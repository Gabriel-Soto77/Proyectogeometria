<?php
/**
 * includes/footer.php
 * Pie de página, Bootstrap 5 JS y scripts de Prism.js.
 */
?>
</main>

<footer class="text-center text-muted small py-3">
    <?= h(APP_NAME) ?> &middot; <?= h(ALUMNO_NOMBRES) ?> &middot; <?= h(ALUMNO_SEMESTRE) ?> &middot; <?= h(ALUMNO_TURNO) ?> &middot; <?= date('Y') ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
<script>
// Botón "Copiar enlace" (página 3)
document.querySelectorAll('[data-copiar]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var campo = document.querySelector(btn.getAttribute('data-copiar'));
        if (!campo) return;
        navigator.clipboard.writeText(campo.value).then(function () {
            var texto = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
            setTimeout(function () { btn.innerHTML = texto; }, 1500);
        });
    });
});
</script>
</body>
</html>
