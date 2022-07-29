<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/stocks/add" method="post">
    <?= csrf_field() ?>
    <?php if (!empty($exchange) && is_array($exchange)) : ?>
        <select name="exchange_name" id="ex_id">
            <?php foreach ($exchange as $ex) : ?>
                <option value="<?= $ex['name'] ?>"><?= $ex['name'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="title">Title</label>
        <input type="input" name="name" /><br />
        <input type="submit" name="submit" value="submit " />
    <?php endif ?>
</form>