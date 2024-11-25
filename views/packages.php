<div class="container">
    <h1>Lista pakietów</h1>
    <table id="dt-table" class="display" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Opis</th>
            <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($packages as $package): ?>
            <tr>
                <td><?= htmlspecialchars($package['id']) ?></td>
                <td><?= htmlspecialchars($package['name']) ?></td>
                <td><?= htmlspecialchars($package['description']) ?></td>
                <td><?= htmlspecialchars($package['price']) ?> zł</td>
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