<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>
<?php if (!empty($exchange) && is_array($exchange)): ?>
    <ul>
        <?php foreach($exchange as $ex) : ?>
            <li><?= esc($ex['name']) ?></li>
        <?php endforeach ?>
</ul>
    <?php else:?>
        <h4>No exchanges</h4>
<?php endif ?>


<form action="/stocks/exchange" method="post">
    <?= csrf_field() ?>

    <label for="title">Exchange Name</label>
    <input type="input" name="name" /><br />
    <input type="submit" name="submit" value="Create news Exchange" />
</form>