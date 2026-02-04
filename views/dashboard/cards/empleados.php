<div class="card">
    <h3><?= htmlspecialchars($cardData['label']) ?></h3>
    <p><strong><?= (int) $cardData['count'] ?></strong> registros</p>
    <a class="btn" href="<?= htmlspecialchars($cardData['route']) ?>">Ir a módulo</a>
</div>
