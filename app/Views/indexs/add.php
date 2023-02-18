<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>
<?php if (!empty($indexs) && is_array($indexs)): ?>
    <ul>
        <?php foreach($indexs as $idx) : ?>
            <li><?= esc($idx['name']) ?></li>
        <?php endforeach ?>
</ul>
    <?php else:?>
        <h4>No indexs</h4>
<?php endif ?>


<form action="/indexs/add" method="post">
    <?= csrf_field() ?>

    <label for="title">Indexs Name</label>
    <input type="input" name="name" /><br />
    <label for="title">Title</label>
    <input type="input" name="title" /><br />
    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
</form>