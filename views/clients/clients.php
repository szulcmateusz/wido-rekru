<div class="container">
    <h1>Wszyscy klienci</h1>
    <?php if (isset($flashMessage)): ?>
        <div class="alert alert-dark" role="alert">
            <?= $flashMessage ?>
        </div>
    <?php endif; ?>
    <div class="text-center">
        <a class="btn btn-secondary" href="/?page=clients_add">Dodaj Klienta</a>
    </div>
    <table id="dt-table" class="display" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa Klienta</th>
            <th>Nazwa pakietu</th>
            <th>Osoby kontaktowe</th>
            <th>Opiekunowie</th>
            <th>Utworzony</th>
            <th>Opcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client['client_id']) ?></td>
                <td><?= htmlspecialchars($client['client_name']) ?> </td>
                <td><?= htmlspecialchars($client['package_name']) ?></td>
                <td>
                    <?php if (!empty($client['contact_persons'])): ?>
                        <?php
                        $contacts = explode(';', $client['contact_persons']);
                        foreach ($contacts as $contact):
                            list($name, $email, $phone) = explode('|', $contact);
                            ?>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $name ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="mailto:<?= $email ?>">Mail: <?= $email ?></a>
                                    </li>
                                    <li><a class="dropdown-item" href="tel:<?= $phone ?>">Telefon: <?= $phone ?></a>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!empty($client['client_employees'])): ?>
                        <?php
                        $employees = explode(';', $client['client_employees']);
                        foreach ($employees as $employee):
                            list($name, $id) = explode('|', $employee);
                            ?>
                            <a href="/?page=clients&employeeId=<?= htmlspecialchars($id) ?>" class="btn btn-link text-white">
                                <?= htmlspecialchars($name) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($client['created_at']) ?></td>
                <td>
                    <form method="POST" action="/?page=clients" class="d-inline-block">
                        <input type="hidden" name="client_id" value="<?= htmlspecialchars($client['client_id']) ?>">
                        <button class="btn btn-warning btn-sm" type="submit" onclick="return confirm('Czy na pewno chcesz usunąć tego klienta?')">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="contactDetailsModal" tabindex="-1" aria-labelledby="contactDetailsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactDetailsModalLabel">Szczegóły kontaktu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>E-mail:</strong> <span id="contactEmail"></span></p>
                <p><strong>Telefon:</strong> <span id="contactPhone"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#dt-table').DataTable();
    });
</script>