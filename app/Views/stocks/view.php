<script type="text/javascript" src="https://unpkg.com/lightweight-charts@1.0.0-rc.3/dist/lightweight-charts.standalone.production.js"></script>
<div id="loading">Crawling - Please wait</div>

<div id="dulieu">
    <h2 class="cattitle">Thông tin giao dịch</h2>
    <div class="dl-title clearfix">
        <div id="symbolbox"><?= $stockinfo['name'] ?></div>
        <div id="namebox" class="dlt-ten">
            <h1>&nbsp;<?= $stockinfo['full_stock_name'] ?></h1>
        </div>
    </div>

    <div class="logo_intro clearfix">
        <div class="avartar"><img src="<?= $stockinfo['logo_img_path'] ?>" /></div>
        <div class="companyIntro"><?= $stockinfo['stock_desc'] ?></div>
    </div>

    <div class="dl-thongtin clearfix">
        <div class="dlt-left">
            <div class="bonus_log"><?= $stockinfo['log_bonus'] ?></div>
        </div>
        <div class="dlt-right">
            <div id="chart"></div>
        </div>
    </div>
    <div class="st_log">
        <span class="txt_dt"> Dữ Liệu Lịch Sử </span>
        <a href="#" class="btn btn-success" onclick="crawlData('<?= esc($stockinfo['name']) ?>');">Crawl Data</a>
    </div>



    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Ngày</th>
                <th scope="col">Giá điều chỉnh</th>
                <th scope="col">Giá đóng cửa</th>
                <th scope="col">Giá bình quân</th>
                <th scope="col">Thay đổi (+/-%)</th>
                <th scope="col">KL khớp lệnh</th>
                <th scope="col">GT khớp lệnh</th>
                <th scope="col">GL thỏa thuân</th>
                <th scope="col">GT thỏa thuận</th>
                <th scope="col">Giá TC</th>
                <th scope="col">Giá mở cửa</th>
                <th scope="col">Giá cao nhất</th>
                <th scope="col">Giá thấp nhất</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['stocks'] as $stock) : ?>
                <tr>
                    <th scope="row"><?= $stock['date'] ?></th>
                    <td><?= $stock['gia_dieu_chinh'] ?></td>
                    <td><?= $stock['gia_dong_cua'] ?></td>
                    <td><?= $stock['gia_binh_quan'] ?></td>
                    <td><?= $stock['thay_doi'] ?></td>
                    <td><?= $stock['khoi_luong_gd'] ?></td>
                    <td><?= $stock['gia_tri_gd'] ?></td>
                    <td><?= $stock['khoi_luong_tt'] ?></td>
                    <td><?= $stock['gia_tri_tt'] ?></td>
                    <td><?= $stock['gia_tham_chieu'] ?></td>
                    <td><?= $stock['gia_mo_cua'] ?></td>
                    <td><?= $stock['gia_cao_nhat'] ?></td>
                    <td><?= $stock['gia_thap_nhat'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $data['pager']->links() ?>

    <script type="text/javascript">
        var chart = LightweightCharts.createChart(document.getElementById("chart"), {
            width: 1100,
            height: 600
        });
        var lineSeries = chart.addLineSeries();
        lineSeries.setData(<?= $c_data ?>);
        chart.timeScale().fitContent();
    </script>

    <div style="display: none;">
        <div id="csrf_token"><?= csrf_token() ?></div>
        <div id="csrf_hash"><?= csrf_hash() ?></div>
    </div>