

<h2>List available Stocks: </h2>
<?php if (!empty($stocks) && is_array($stocks)): ?>
    <ul>
        <?php foreach($stocks as $stock) : ?>
            <li>
                <a href="/stocks/<?= esc($stock['name']) ?>"><?= esc($stock['name']) ?></a> <a href="/crawl/<?= esc($stock['name']) ?>">Crawl Data</a>
        </li>
        <?php endforeach ?>
</ul>
    <?php else:?>
        <h4>No Stocks</h4>
<?php endif ?>
