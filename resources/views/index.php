<!doctype html>
<html class="no-js" lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pexel TeamSpeak 3 server - štatistiky</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<?php part('browserupgrade') ?>

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <?php part('pageheader') ?>
    <?php part('pagedrawer') ?>
    <main class="mdl-layout__content">
        <div class="page-content">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                <div class="mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                    <div
                        style="background: url('http://i.imgur.com/UnNm7lS.png') no-repeat center center;background-size: cover; width: 100%; height: 17em;"></div>
                    <article style="padding-top: 1em">
                        <h3>Štatistiky?</h3>

                        <p>Tu môžeš nájsť rôzne štatistiky o našom team speak 3 serveri. Sme prví, ktorí sa do takéhoto
                            projektu pustili a snažíme sa ho robiť čo najlepšie! Preto prosím ospravedlňte akékoľvek
                            chyby. Ak máte akékoľvek nápady alebo pripomienky, neváhajte kontaktovať server admina
                            <b>dobrakmato</b> na našom TeamSpeak serveri.</p>

                        <p>Štatistiky sa generujú raz za deň a to o 3:00 v noci.</p>

                        <h3>Dostupné pohľady</h3>
                        <?php foreach ($reports as $report): ?>
                            <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect"
                               href="<?= href($report->getSlug() . '.html') ?>"><?= $report->getName() ?></a><br/><br/>
                        <?php endforeach; ?>

                        <h3>Aktuálnosť</h3>

                        <p>Táto verzia štatistík pre TeamSpeak 3 server Pexel.eu bola
                            vygenerovaná <b><?= date('j.n.Y H:i:s') ?></b>.</p>
                    </article>
                </div>
            </div>
        </div>
        <?php part('footer') ?>
    </main>
</div>

<?php part('ga') ?>
</body>
</html>