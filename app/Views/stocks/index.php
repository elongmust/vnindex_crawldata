<a class="add_stock btn btn-primary" href="/stocks/add"><i class="fas fa-plus"></i> Add stock</a>
<h2>Danh sách các mã CP:</h2>
<?php if (!empty($stocks) && is_array($stocks)): ?>
    <ul>
        <?php foreach($stocks as $stock) : ?>
            <li>
                <a href="/stocks/<?= esc($stock['name']) ?>"><?= esc($stock['name']) ?></a>
        </li>
        <?php endforeach ?>
</ul>
    <?php else:?>
        <h4>No Stocks</h4>
<?php endif ?>
