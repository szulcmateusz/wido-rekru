<h1>Statystyki</h1>
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ilość Klientów</h5>
                <p class="card-text fs-4"><?= $countClients ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ilość pracowników</h5>
                <p class="card-text fs-4"><?= $countEmployees ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ilość pakietów</h5>
                <p class="card-text fs-4"><?= $countPackages ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Wartość wszystkich umów</h5>
                <p class="card-text fs-4"><?= $totalValue ?> zł</p>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <h2 class="text-center">Info</h2>
    <ul>
        <li>Aby dodać Klienta wejdź w: <b>Lista klientów -> Dodaj Klienta</b></li>
        <li>Aby dodać pracownika wejdź w: <b>Lista pracowników -> Dodaj pracownika</b></li>
        <li>Aby zobaczyć Klientów danego pracownika wejdź w: <b>Lista pracowników -> klienci</b> (przy danym
            kliencie)
        <li>Można wygenerować przykładowych pracowników oraz klientów - <b>Sekcja menu "Dev"</b></li>
        <li>Klikając w tabeli na nazwisko osoby kontaktowej wyświetlisz dane kontaktowe.</li>
    </ul>
</div>