<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>
<h2>Add new Stock</h2>
<form action="/stocks/add" method="post">
    <?= csrf_field() ?>
    <?php if (!empty($exchange) && is_array($exchange)) : ?>
        <select class="form-select mb-3" name="exchange_name" id="ex_id" aria-label=".form-select-lg example">
            <?php foreach ($exchange as $ex) : ?>
                <option value="<?= $ex['name'] ?>"><?= $ex['name'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="title">Title</label>
        <input type="input" name="name" /><br />
        <input type="submit" name="submit" value="submit " class="btn btn-primary"/>
    <?php endif ?>
</form>