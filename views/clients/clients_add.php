<div class="container">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nazwa firmy</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Wprowadź nazwę firmy"
                           required>
                </div>
                <div class="mb-3">
                    <label for="package_id" class="form-label">Pakiet</label>
                    <select class="form-select" id="package_id" name="package_id" required>
                        <option value="" selected>Wybierz pakiet</option>
                        <?php foreach ($packages as $package): ?>
                            <option value="<?= $package['id'] ?>"><?= $package['name'] ?> - <?= $package['price'] ?>
                                PLN
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="employees" class="form-label">Opiekunowie</label>
                    <select class="form-select" id="employees" name="employees[]" multiple>
                        <?php foreach ($employees as $employee): ?>
                            <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-white">Przytrzymaj Ctrl, aby wybrać wielu opiekunów.</small>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Osoby kontaktowe</label>
            <div id="contact-fields">
                <div class="row contact-input">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="contact_names[]" placeholder="Imię i nazwisko">
                    </div>
                    <div class="col-md-4">
                        <input type="email" class="form-control" name="contact_emails[]" placeholder="E-mail">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_phones[]" placeholder="Telefon">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-contact">Dodaj osobę kontaktową</button>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj firmę</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#dt-table').DataTable();
    });

    document.getElementById('add-contact').addEventListener('click', function () {
        const container = document.getElementById('contact-fields');
        const newField = document.createElement('div');
        newField.className = 'row contact-input';
        newField.innerHTML = `
                <div class="col-md-5">
                    <input type="text" class="form-control" name="contact_names[]" placeholder="Imię i nazwisko">
                </div>
                <div class="col-md-4">
                    <input type="email" class="form-control" name="contact_emails[]" placeholder="E-mail">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="contact_phones[]" placeholder="Telefon">
                </div>
            `;
        container.appendChild(newField);
    });
</script>