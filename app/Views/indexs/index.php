<script type="text/javascript" src="https://unpkg.com/lightweight-charts@1.0.0-rc.3/dist/lightweight-charts.standalone.production.js"></script>

<a class="add_stock btn btn-primary" href="/stocks/add"><i class="fas fa-plus"></i> Add stock</a>
<h2>Danh sách các mã CP:</h2>
<div class="container">
    <div class="row">
        <div class="col-8">
            <?php if (!empty($indexs) && is_array($indexs)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Mã CP</th>
                            <th scope="col">Giá điều chỉnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($indexs as $idx) : ?>
                            <tr>
                                <th scope="row"><a href="/indexs/<?= esc($idx['name']) ?>"><?= esc($idx['title']) ?></a></th>
                                <td> xxx </td>
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <h4>No Stocks</h4>
                <?php endif ?>
        </div>
        <div class="col-4">
            US dowjon stocks data
        </div>
    </div>
</div>