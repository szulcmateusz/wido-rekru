<div class="container">
    <?php if (!$employee): ?>
        <p>Brak pracownika o ID <?= $employeeId ?></p>
    <?php else: ?>
        <h1>Klienci pracownika <?= $employee['name'] ?></h1>
        <table id="dt-table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa Klienta</th>
                <th>Nazwa pakietu</th>
                <th>Osoby kontaktowe</th>
                <th>Utworzony</th>
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
                    <td><?= htmlspecialchars($client['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function () {
        $('#dt-table').DataTable();
    });
</script>