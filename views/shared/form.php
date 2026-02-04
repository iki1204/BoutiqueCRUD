<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <?php foreach ($fields as $field) : ?>
            <div>
                <label for="<?= htmlspecialchars($field) ?>"><?= htmlspecialchars($labels[$field] ?? $field) ?></label>
                <input
                    type="text"
                    id="<?= htmlspecialchars($field) ?>"
                    name="<?= htmlspecialchars($field) ?>"
                    value="<?= htmlspecialchars((string) ($values[$field] ?? '')) ?>"
                >
            </div>
        <?php endforeach; ?>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="<?= htmlspecialchars($cancelRoute ?? '/') ?>">Cancelar</a>
    </div>
</form>
