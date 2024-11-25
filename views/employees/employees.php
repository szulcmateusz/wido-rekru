<div class="container">
    <h1>Pracownicy</h1>
    <?php if (isset($flashMessage)): ?>
        <div class="alert alert-dark" role="alert">
            <?= $flashMessage ?>
        </div>
    <?php endif; ?>
    <div class="text-center">
        <a class="btn btn-secondary" href="/?page=employee_add">Dodaj pracownika</a>
    </div>
    <table id="dt-table" class="display" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Pracownik</th>
            <th>E-mail</th>
            <th>Telefon</th>
            <th>Utworzony</th>
            <th>Opcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= htmlspecialchars($employee['id']) ?></td>
                <td><?= htmlspecialchars($employee['name']) ?></td>
                <td><a class="text-white" href="<?= htmlspecialchars($employee['email']) ?>"><?= htmlspecialchars($employee['email']) ?></a></td>
                <td><a class="text-white" href="tel:<?= htmlspecialchars($employee['phone']) ?>"><?= htmlspecialchars($employee['phone']) ?></a></td>
                <td><?= htmlspecialchars($employee['created_at']) ?></td>
                <td>
                    <a class="btn btn-secondary btn-sm" href="/?page=clients&employeeId=<?=$employee['id']?>">Klienci</a>
                    <form method="POST" action="/?page=employees" class="d-inline-block">
                        <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee['id']) ?>">
                        <button class="btn btn-warning btn-sm" type="submit" onclick="return confirm('Czy na pewno chcesz usunąć tego pracownika?')">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dt-table').DataTable();
    });
</script>