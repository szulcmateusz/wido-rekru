<div class="text-center">
    <h4>Generowanie klientów</h4>
    <?php if (isset($flashMessage)): ?>
        <div class="alert alert-dark" role="alert">
            <?= $flashMessage ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <input type="number" name="amount" placeholder="Liczba rekordów.">
        <button class="btn btn-secondary btn-small" type="submit">Generuj</button>
    </form>
</div>