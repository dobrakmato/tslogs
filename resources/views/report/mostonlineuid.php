<!doctype html>
<html class="no-js" lang="sk">
<?php part('htmlhead') ?>
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
                    <article>
                        <?php part('breadcrumbs') ?>
                        <h3><?= $report->getName() ?></h3>

                        <p>Nasleduje tabuľka zobrazujúca najviac aktívnych (najdlhšie online) používateľov.</p>

                        <table class="mdl-data-table mdl-shadow--2dp sortable">
                            <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">Používateľ</th>
                                <th class="mdl-data-table__cell--non-numeric">Čas online</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($clients as $key => $value): ?>
                                <?php $c = $clientsProfiles[$key]; ?>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric"><?= cleanoutput($c->nickname); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?= formatTime($value); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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