<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Dostupné štatistiky</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="<?= href('') ?>">Domov</a>
        <?php foreach ($reports as $report): ?>
            <a class="mdl-navigation__link"
               href="<?= href($report->getSlug() . '.html') ?>"><?= $report->getName() ?></a>
        <?php endforeach; ?>
    </nav>
</div>