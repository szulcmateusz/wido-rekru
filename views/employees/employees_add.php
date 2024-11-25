<div class="container">
    <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="row">
            <!-- Pole Name -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Imię i nazwisko pracownika</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Wprowadź imię i nazwisko"
                           required>
                </div>
            </div>

            <!-- Pole Email -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Adres e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Wprowadź adres e-mail"
                           required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pole Phone -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="phone" class="form-label">Numer telefonu</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Wprowadź numer telefonu"
                           required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary">Dodaj pracownika</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#dt-table').DataTable();
    });
</script>